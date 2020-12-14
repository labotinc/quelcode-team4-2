<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

use Cake\Event\Event; // added.
use Exception; // added.

class MoviesInfoController extends MovieAuthBaseController
{
    // 初期化処理
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Users');
        $this->loadModel('Movies');
        $this->loadModel('MovieSchedules');
        $this->loadModel('Prices');
        $this->loadModel('Bookings');
        $this->loadModel('PaymentHistories');
        $this->loadModel('Prices');
        $this->loadModel('Discounts');
        $this->loadModel('CreditCards');
        $this->loadModel('SalesTaxes');
        $this->loadModel('CancellingAccountHistories');
        $this->loadModel('CancellingAccountCategories');

        // レイアウトをmainに変更
        $this->viewBuilder()->setLayout('main');
    }

    // 認証をしないページの設定
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // トップページは認証を行わない
        $this->Auth->allow(['index', 'pricelist']);
    }

    public function index()
    {
    }

    public function mypage()
    {
        $user_id = $this->Auth->user('id');
        // クレジットカードの登録している中の一枚のIDを表示
        $my_credit_card_number = $this->CreditCards->findCreditCard($user_id);
        if (!empty($my_credit_card_number)) {
            $my_credit_card_number = $my_credit_card_number[0]['card_number'];
        }
        /**
         * POST送信されてきた場合(退会ボタンが押下された場合)
         * 1. userエンティティの退会フラグを立てる
         * 2. creditcardエンティティのカード番号などを上書きして削除フラグを立てる
         * 3. cancellingAccountHistoryのnewEntityを作成する
         * 4. ユーザーの予約状況を確認し、予約があれば取り消す 
         * 5. 上記のエンティティを全て保存する
         */
        if ($this->request->is('post')) {
            // 1. user
            $user = $this->Users->get($user_id);
            $user = $user->setIdDeleted($user_id);

            // 2. creditcard
            $creditCards = $this->CreditCards->deleteCards($user_id);

            // 3. cancellingAccountHistory
            $entity = $this->CancellingAccountHistories->newEntity();
            $entity = $entity->setHistory($user_id);

            // 4. booking and paymentHistories
            $bookings = $this->Bookings->cancelBookings($user_id);
            $paymentHistories = $this->PaymentHistories->cancelPayments($user_id);

            // 5. 1~4を保存する
            if (
                $this->Users->save($user) &&  $this->CancellingAccountHistories->save($entity)
                && $this->CreditCards->saveMany($creditCards) && $this->Bookings->saveMany($bookings)
                &&  $this->PaymentHistories->saveMany($paymentHistories)
            ) {
                return $this->redirect(['controller' => 'users', 'action' => 'cancelCompleted']);
            } else {
                return $this->Flash->error('退会に失敗しました。ヘルプセンターにご連絡ください。');
            }
        }
        $this->set(compact('my_credit_card_number'));
    }

    public function pricelist()
    {
        // 割引テーブル
        $arrayDiscount = $this->Discounts->find('all')
            ->where([
                'is_applied' => true
            ])->order([
                'price' => 'desc'
            ])->toArray();

        // 料金テーブル
        $arrayPrices = $this->Prices->find('all')
            ->where([
                'is_applied' => true
            ])->order([
                'price' => 'desc'
            ])->toArray();

        $this->set(compact('arrayPrices', 'arrayDiscount'));
    }

    public function schedule()
    {
        // ================ 日付について start ================

        $week = array("日", "月", "火", "水", "木", "金", "土", "日", "月", "火", "水", "木", "金", "土");

        for ($i = 0; $i < 7; $i++) {
            $weekNumber = date("w") + $i;
            $weekDate[] = date("m月d日" . "(" . $week[$weekNumber] . ")", strtotime($i . " day"));
            $weekValue[] = strtotime($i . " day" . date("Ymd H:i:s"));
        }

        // ================ 日付について end ================


        // 映画テーブルを取り出す
        $MovieList = $this->Movies->find('all')
            ->where([
                // screening_start_dateとcreening_end_dateで$ajaxDataが上映期間に入っているか判定。
                'screening_start_date <=' =>  date("Y-m-d"),
                'screening_end_date >=' =>   date("Y-m-d"),
                'is_screened' => 1
            ])
            ->toArray();


        // 映画のスケジュールを取り出す
        $ThatDaySchedules = $this->MovieSchedules->find('all')
            ->select(['id', 'movie_id', 'screening_start_datetime'])
            ->where([
                'screening_start_datetime >=' => date("Y-m-d 00:00:00"),
                'screening_start_datetime <=' => date("Y-m-d 23:59:59"),
                'is_playable' => 1
            ])
            ->order([
                'screening_start_datetime' => 'asc'
            ])
            ->toArray();

        // 割引テーブル
        $firstDay = $this->Discounts->find('all')
            ->where([
                'is_applied' => true,
                'name like' => '%' . 'ファーストデイ割引' . '%'
            ])
            ->limit(1)
            ->toArray();

        $senior = $this->Discounts->find('all')
            ->where([
                'is_applied' => true,
                'name like' => '%' . '子供女性シニア割引' . '%'
            ])
            ->limit(1)
            ->toArray();


        $this->set(compact('weekDate', 'weekValue', 'MovieList', 'ThatDaySchedules', 'firstDay', 'senior'));
    }

    function ajaxMovieSchedules()
    {
        $this->autoRender = FALSE;
        if ($this->request->is('ajax')) {
            $ThatDaySchedules = $this->MovieSchedules->find('all')
                ->select(['id', 'movie_id', 'screening_start_datetime'])
                ->where([
                    'screening_start_datetime >=' => date("Y-m-d 00:00:00", $_GET['time']),
                    'screening_start_datetime <=' => date("Y-m-d 23:59:59", $_GET['time']),
                    'is_playable' => 1
                ])
                ->order([
                    'screening_start_datetime' => 'asc'
                ])
                ->toArray();

            echo json_encode($ThatDaySchedules, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    function ajaxMovieList()
    {
        $this->autoRender = FALSE;
        if ($this->request->is('ajax')) {
            // $ajaxDataはクリックされた日付
            // $ajaxData = date("Y-m-d", $_GET['time']);

            $MovieList = $this->Movies->find('all')
                ->where([
                    // screening_start_dateとcreening_end_dateで$ajaxDataが上映期間に入っているか判定。
                    'screening_start_date <=' =>  date("Y-m-d", $_GET['time']),
                    'screening_end_date >=' =>  date("Y-m-d", $_GET['time']),
                    'is_screened' => 1
                ])
                ->toArray();
            echo json_encode($MovieList, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    // 予約詳細ページ
    public function bookingDetails()
    {
        // 認証認可が追加されてから
        $authuser = $this->Auth->user();

        //本予約一覧
        $booked_main = $this->Bookings->findBookedMain(
            $authuser['id']
        );
        // 仮予約一覧
        $booked_temporary = $this->Bookings->findBookedTemporary(
            $authuser['id']
        );

        //本予約の処理
        $booked_main_details = [];
        foreach ($booked_main as $booked_main_value) {
            // 予約IDと座席番号を取得
            $booked_id = $booked_main_value['id'];
            $seat_number = $booked_main_value['seat_number'];
            // 映画情報の概要と詳細を取得
            $movie_schedule = $this->MovieSchedules->get($booked_main_value['schedule_id']);
            $movie_id = $movie_schedule['movie_id'];
            $movie_info = $this->Movies->get($movie_id);
            $thumbnail_path = $movie_info['thumbnail_path'];
            $movie_title = $movie_info['title'];
            // 開始日とその曜日を取得
            $screening_date = $movie_schedule->screening_start_datetime->format('m月d日');
            $screening_week = $movie_schedule->screening_start_week;
            // 開始時間、終了時間を取得
            $screening_start_time = $movie_schedule->screening_start_datetime->format('H:i');
            $screening_end_time = $movie_schedule->screening_start_datetime->addMinutes($movie_info->total_minutes_with_trailer)->format('H:i');
            // 支払情報を取得（支払いID、総計金額、割引項目）
            $payment = $this->PaymentHistories->findPaymentHistories($booked_main_value['id']);
            $payment_contents = $payment[0];
            $payment_id = $payment_contents['id'];
            $discount_name = $this->Discounts->get($payment_contents['discount_id'])->name;
            // 支払総計金額の項目取得とその計算
            $price_apply = $this->Prices->get($payment_contents['price_id'])->price;
            $discount_apply = $this->Discounts->get($payment_contents['discount_id'])->price;
            $sales_tax_apply = $this->SalesTaxes->get($payment_contents['sales_tax_id'])->rate;
            $total_price = number_format(($price_apply - $discount_apply) * (100 + $sales_tax_apply) / 100);
            // 映画の詳細に必要な情報を取り出し
            $booked_main_details[] = [
                'id' => $booked_id,
                'payment_id' => $payment_id,
                'seat_number' => $seat_number,
                'thumbnail_path' => $thumbnail_path,
                'movie_title' => $movie_title,
                'screening_date' => $screening_date,
                'screening_week' => $screening_week,
                'screening_start_time' => $screening_start_time,
                'screening_end_time' => $screening_end_time,
                'discount_name' => $discount_name,
                'total_price' => $total_price,
            ];
        }

        // 仮予約の処理
        // 映画詳細ページに必要な配列の空の配列を準備
        $booked_temporary_details = [];
        // ログインユーザーの仮予約を取り出す。
        foreach ($booked_temporary as $booked_tmp) {
            $created_format = new Time($booked_tmp['created']);
            // 予約が15分以上前にされたものだったら削除
            if (!($created_format->wasWithinLast("15 minutes"))) {
                $booked_tmp_delete = $this->Bookings->get($booked_tmp['id']);
                $this->Bookings->delete($booked_tmp_delete);
                return $this->Flash->set(__('仮予約から15分経過した予約を削除いたしました。再度予約をお願いします。'));
            }
            // 予約IDと座席番号を取得
            $booked_id = $booked_tmp['id'];
            $seat_number = $booked_tmp['seat_number'];
            // 映画情報の概要と詳細を取得
            $movie_schedule = $this->MovieSchedules->get($booked_tmp['schedule_id']);
            $movie_id = $movie_schedule['movie_id'];
            $movie_info = $this->Movies->get($movie_id);
            $thumbnail_path = $movie_info['thumbnail_path'];
            $movie_title = $movie_info['title'];
            // 開始日とその曜日を取得
            $screening_date = $movie_schedule->screening_start_datetime->format('m月d日');
            $screening_week = $movie_schedule->screening_start_week;
            // 開始時間、終了時間を取得
            $screening_start_time = $movie_schedule->screening_start_datetime->format('H:i');
            $screening_end_time = $movie_schedule->screening_start_datetime->addMinutes($movie_info->total_minutes_with_trailer)->format('H:i');
            // 映画の詳細に必要な情報を取り出し
            $booked_temporary_details[] = [
                'id' => $booked_id,
                'seat_number' => $seat_number,
                'thumbnail_path' => $thumbnail_path,
                'movie_title' => $movie_title,
                'screening_date' => $screening_date,
                'screening_week' => $screening_week,
                'screening_start_time' => $screening_start_time,
                'screening_end_time' => $screening_end_time,
            ];
        }

        $this->set(compact('booked_main_details', 'booked_temporary_details'));

        if ($this->request->is('post')) {
            if ($this->request->getData('payment_id')) {
                $booking_id_post = $this->request->getData('booking_id');
                $payment_id_post = $this->request->getData('payment_id');
                $info_booking = $this->Bookings->get($booking_id_post)->setIsCancelled();
                $info_payment = $this->PaymentHistories->get($payment_id_post)->setIsCancelled();
                // showAsDeletedはエンティティクラスのメソッド
                if ($this->Bookings->save($info_booking) && $this->PaymentHistories->save($info_payment)) {
                    return $this->redirect(['action' => 'deleteCompleted']);
                } else {
                    $this->Flash->error(__('削除に失敗しました')); // 一応例外処理を記入
                }
            } else {
                $booking_id_post = $this->request->getData('booking_id');
                $info_booking = $this->Bookings->get($booking_id_post)->setIsCancelled();
                // showAsDeletedはエンティティクラスのメソッド
                if ($this->Bookings->save($info_booking)) {
                    return $this->redirect(['action' => 'deleteCompleted']);
                } else {
                    $this->Flash->error(__('削除に失敗しました')); // 一応例外処理を記入
                }
            }
        }
    }

    // 予約キャンセル完了画面
    public function deleteCompleted()
    {
    }

    public function isAuthorized($user) // ここでの$userはログインユーザー情報
    {
        // 単一のアクションを追加したい場合
        if (
            $this->request->getParam('action') === 'schedule'
            || $this->request->getParam('action') === 'mypage'
            || $this->request->getParam('action') === 'bookingDetails'
            || $this->request->getParam('action') === 'deleteCompleted'
        ) { // ここで||を用いて複数アクションにすることもできる？
            return true;
        }
    }
}
