<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Utility\Hash;
use Exception;

/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 *
 * @method \App\Model\Entity\Booking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookingsController extends MovieAuthBaseController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('MovieSchedules');
        $this->loadModel('Movies');
        // ログインユーザー情報を取り出す→本来はログインユーザーを取り出す
        // 今回は仮ユーザーとして各自で登録するユーザーIDが1の情報を使用
        // なので、今回レビューを行う際はまずユーザーを一人登録してください。

        $this->set('authuser', $this->Auth->user());
    }

    /**
     * 一般ユーザーがアクセスできるのをaddSeatアクションのみに指定
     * 予約したユーザーのみ、その予約確認画面にアクセス・キャンセル可能ユーザーに指定
     */
    public function isAuthorized($user)
    {
        // 登録ユーザー全員が予約可
        if ($this->request->getParam('action') === 'addSeat') {
            return true;
        }
        // 予約の所有者は確認画面にアクセス・キャンセル可能
        if (in_array($this->request->getParam('action'), ['seatConfirmation', 'seatCancel'])) {
            $bookingId = (int)$this->request->getParam('pass.0');
            if ($this->Bookings->isOwnedBy($bookingId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'MovieSchedules'],
        ];
        $bookings = $this->paginate($this->Bookings);

        $this->set(compact('bookings'));
    }

    /**
     * View method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $booking = $this->Bookings->get($id, [
            'contain' => ['Users', 'MovieSchedules'],
        ]);

        $this->set('booking', $booking);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // 管理者画面
    public function add()
    {

        $booking = $this->Bookings->newEntity();
        if ($this->request->is('post')) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $users = $this->Bookings->Users->find('list', ['limit' => 200]);
        $schedules = $this->Bookings->MovieSchedules->find('list', ['limit' => 200]);
        $this->set(compact('booking', 'users', 'schedules'));
    }

    // 座席予約のユーザー操作画面
    public function addSeat($schedule_id)
    {
        // セッションを取得する（p50から遷移された場合に選択していた座席を取得）
        $add_seat_session = $this->getRequest()->getSession();

        $this->viewBuilder()->setLayout('main');
        // MovieSchedulesに存在しないIDのURLを直接入力されたときの処理
        try {
            // $schedules_idの$movie_scheduleを取得する
            $movie_schedule = $this->MovieSchedules->get($schedule_id);
        } catch (Exception $e) {
            $this->Flash->set(__('現在公開されていない映画を選択したため、リダイレクトしました。再度映画を選択して予約してください。'));
            // ※ページが作成されたら映画スケジュール画面をリダイレクト先にする。action先は未定。
            return $this->redirect(['controller' => 'MoviesInfo', 'action' => 'schedule']);
        }
        // ログインユーザーID
        // 本来はログインユーザーIDを取得するため認証認可完了したらこっちを使う
        $login_user_id = $this->Auth->user('id');
        //$login_user_id = $this->Users->get(1)->id;
        // 予約済座席の一覧を配列として取得する。
        $booked_id_seats = $this->Bookings->findBookingSeats($schedule_id);
        // Hashを用いることで連想配列→配列に変換
        $booked_seats_array = Hash::extract($booked_id_seats, '{n}.seat_number');
        $booked_id_array = Hash::extract($booked_id_seats, '{n}.user_id');
        // ログインユーザーの仮予約の配列
        $booked_temporary = $this->Bookings->findBookedTemporary(
            //本来はログインユーザーIDを取得するため認証認可完了したらこっちを使う
            $login_user_id
            //$this->Users->get(1)->id
        );

        // ログインユーザーの仮予約を取り出す。
        foreach ($booked_temporary as $booked_tmp) {
            $created_format = new Time($booked_tmp['created']);
            // 予約が昨日以前にされたものだったら削除
            if (!($created_format->wasWithinLast("15 minutes"))) {
                $booked_tmp_delete = $this->Bookings->get($booked_tmp['id']);
                $this->Bookings->delete($booked_tmp_delete);
                $this->Flash->set(__('仮予約から15分経過した予約を削除いたしました。再度予約をお願いします。'));
                return $this->redirect(['controller' => 'MoviesInfo', 'action' => 'schedule']);
            }
        }

        // 映画が予約済だった場合、映画上映フラグが立っていない→上映されていない映画を選択した場合は予約ページにリダイレクト
        if (in_array($login_user_id, $booked_id_array) || !($movie_schedule->is_playable)) {
            // ※ページが作成されたら映画スケジュール画面をリダイレクト先にする。action先は未定。
            $this->redirect(['controller' => 'MoviesInfo', 'action' => 'schedule']);
            $this->Flash->set(__('選択した劇場はすでに予約済か、中止となっている場合がございます。再度上映スケジュールページからご希望の上映を選択してください。'));
        }

        $booking = $this->Bookings->newEntity();

        // P50からキャンセルボタンで遷移した場合の席番号の取得
        // 初期化
        $cancel_user_seat = "0";
        if ($add_seat_session->check('seat_number')) {
            $cancel_user_seat = $add_seat_session->read('seat_number');
            $add_seat_session->delete('seat_number');
        }
        if ($this->request->is('post')) {
            // POST送信時に予約済の座席を選択していた場合は座席予約ページにリダイレクトする。
            $my_booking_seat = $this->request->getData('seat_number');
            $booked_seats_post_time = $this->Bookings->findBookingSeats($schedule_id);
            $booked_seats_post_time_array = Hash::extract($booked_seats_array, '{n}.seat_number');
            if (in_array($my_booking_seat, $booked_seats_post_time_array)) {
                $this->Flash->error(__('選択した座席はすでに他のお客様が予約済みです。別の席を選択してください。'));
                return $this->redirect($this->request->referer());
            }
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                return $this->redirect(['action' => 'seat_confirmation', $booking->id]);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }

        $this->set(compact(
            'booking',
            'movie_schedule',
            'booked_seats_array',
            'cancel_user_seat',
        ));
    }

    // ユーザー確認画面
    public function seatConfirmation($id)
    {
        $this->viewBuilder()->setLayout('main');
        try {
            $booking = $this->Bookings->get($id, [
                'contain' => ['Users', 'MovieSchedules'],
            ]);
            $movie_id = $booking->movie_schedule['movie_id'];
            $movie_info = $this->Movies->get($movie_id);
            $schedule_id = $booking->movie_schedule['id'];
        } catch (Exception $e) {
            $this->Flash->set(__('予約されていない状態で確認画面を閲覧したため、リダイレクトしました。上映スケジュールページから再度予約してください。'));
            return $this->redirect(['controller' => 'MoviesInfo', 'action' => 'schedule']);
        }
        $this->set(compact('booking', 'movie_info'));
    }

    // 基本設計P51でキャンセルボタンを押した時の処理
    public function seatCancel($booking_id)
    {
        try {
            $cancel_booking = $this->Bookings->get($booking_id);
            $cancel_booking_movie = $cancel_booking['schedule_id'];
            $cancel_booking_seat = $cancel_booking['seat_number'];
            // キャンセル前に予約した座席番号を取得し、セッションに格納
            $session = $this->getRequest()->getSession('seat_number');
            $session->write('seat_number', $cancel_booking_seat);
            $this->Bookings->delete($cancel_booking);
            return $this->redirect((['action' => 'add_seat', $cancel_booking_movie]));
        } catch (Exception $e) {
            $this->Flash->set(__('正常にキャンセル処理ができませんでした。カスタマーセンターまでお問い合わせください。'));
            // ※トップページが作成されたら映画スケジュール画面をリダイレクト先にする。action先は未定。
            return $this->redirect(['controller' => 'MoviesInfo', 'action' => 'schedule']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $booking = $this->Bookings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $users = $this->Bookings->Users->find('list', ['limit' => 200]);
        $schedules = $this->Bookings->MovieSchedules->find('list', ['limit' => 200]);
        $schedule_id = $booking->movie_schedule['id'];
        $this->set(compact('booking', 'users', 'schedules', 'schedule_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
