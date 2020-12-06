<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Booking;

/**
 * PaymentHistories Controller
 *
 * @property \App\Model\Table\PaymentHistoriesTable $PaymentHistories
 *
 * @method \App\Model\Entity\PaymentHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentHistoriesController extends MovieAuthBaseController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Prices');
        $this->loadModel('Bookings');
        $this->loadModel('Discounts');
        $this->loadModel('SalesTaxes');
        $this->loadModel('CreditCards');
        $this->loadModel('MovieSchedules');
        $this->loadModel('PaymentHistories');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bookings', 'CreditCards', 'Prices', 'Discounts', 'SalesTaxes'],
        ];
        $paymentHistories = $this->paginate($this->PaymentHistories);

        $this->set(compact('paymentHistories'));
    }

    public function method($booking_id)
    {
        $this->viewBuilder()->setLayout('main');
        $user_id = $this->Auth->user('id');
        // そもそもの欲しい情報とは

        // カード情報
        $cardInfos = $this->CreditCards->findCreditCardToPaymentHistories($user_id);

        $this->set(compact('cardInfos'));

        // パクリサイト https://gray-code.com/php/calc-age-from-birthday/ == strat ============
        // ユーザーの誕生日情報を取得
        $userInfos = $this->Users->findUser($user_id);
        // 生年月日からタイムスタンプを取得
        $birthday = strtotime($userInfos[0]['birthdate']);

        $birth_year = (int)date("Y", $birthday);
        $birth_month = (int)date("m", $birthday);
        $birth_day = (int)date("d", $birthday);

        // 現在の年月日を取得
        $now_year = (int)date("Y");
        $now_month = (int)date("m");
        $now_day = (int)date("d");

        // 年齢を計算
        $age = $now_year - $birth_year;

        // 「月」「日」で年齢を調整
        if ($birth_month === $now_month) {
            if ($now_day < $birth_day) {
                $age--;
            }
        } elseif ($now_month < $birth_month) {
            $age--;
        };

        if ($age > 22) {
            $price = '一般';
        } elseif ($age < 23 && $age > 18) {
            $price = '大学生';
        } elseif ($age < 19 && $age > 15) {
            $price = '高校生';
        } elseif ($age < 16 && $age > 6) {
            $price = '小中学生';
        } else {
            $price = '幼児';
        }
        $Price = $this->Prices->findUser($price);
        // == end ============

        // =================================== 割引判定 start ===================================
        // 割引(discount_id)
        // 　今はファーストデイと子供シニア割引き、割引なしのみDBに入っていると仮定

        // ファーストデイかどうかを取り出したいので日付を取り出して判定
        $Booking = $this->Bookings->findBookedScheduleId($booking_id);
        $bookingScheduleId = $Booking[0]['schedule_id'];

        $MovieSchedule = $this->MovieSchedules->findMovieSchedulesDate($bookingScheduleId);
        $movieScheduleDatetime = $MovieSchedule[0]['screening_start_datetime'];
        $dayStrtotime = strtotime($movieScheduleDatetime);
        $scheduleDay = (int)date("d", $dayStrtotime);

        // 1日だったらファーストディ
        if ($scheduleDay === 1) {
            $arrayDiscount[] = 'ファーストデイ割引';
        }
        $userSex = $userInfos[0]['sex'];
        // シニアは65歳以上を定義/ここで子供女性シニア割引
        if ($price === '小中学生' || $price == '幼児' || $userSex === 2 || $age >= 65) {
            $arrayDiscount[] = '子供女性シニア割引';
        }


        // $arrayDiscountに値が入っていたら
        if (isset($arrayDiscount)) {
            // ここでModelを呼び出し
            $Discount = $this->Discounts->findDiscount();
            for ($i = 0; $i < count($Discount); $i++) {
                for ($j = 0; $j < count($arrayDiscount); $j++) {
                    if ($Discount[$i]['name'] === $arrayDiscount[$j]) {
                        $discount[] = $Discount[$i];
                    }
                }
            }

            // ここで割引額が高い方を入れる
            $discountPrice = '';
            for ($x = 0; $x < count($discount); $x++) {
                if (empty($hoge2)) {
                    $discountPrice = $discount[$x];
                } elseif ($discount[$x]['price'] > $discountPrice['price']) {
                    $discountPrice = $discount[$x];
                }
            }
        } else {
            // 割引なしのidが3と仮定
            $discountPrice = 3;
        }

        // =================================== 割引判定 end ===================================

        // 税金(sales_tax_id)
        $salesTax = $this->SalesTaxes->findTax();


        if ($this->request->is('post')) {
            $data = [
                // 予約 id⬇︎
                'booking_id' => $booking_id,
                // カードのid
                'credit_card_id' => $_POST['cardInfoId'],
                // 価格(price_id)
                'price_id' => (string)$Price[0]['id'],
                // 割引(discount_id) 
                'discount_id' =>  $discountPrice,
                // 税金(sales_tax_id)
                'sales_tax_id' => (string)$salesTax[0]['id'],
                // falseでキャンセルはしていない。
                'is_cancelled' => false,
            ];

            $entity = $this->PaymentHistories->newEntity();
            $arrayPayment = $this->PaymentHistories->patchEntity($entity, $data);

            // とりあえずsaveOrFailにすることでエラーをはけた
            if ($this->PaymentHistories->saveOrFail($arrayPayment)) {
                $this->Flash->success(__('セーブ。'));
                // とりあえず、indexに飛ばしてる
                return $this->redirect(['action' => 'index']);
            }
        }
    }

    /**
     * View method
     *
     * @param string|null $id Payment History id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paymentHistory = $this->PaymentHistories->get($id, [
            'contain' => ['Bookings', 'CreditCards', 'Prices', 'Discounts', 'SalesTaxes'],
        ]);

        $this->set('paymentHistory', $paymentHistory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paymentHistory = $this->PaymentHistories->newEntity();
        if ($this->request->is('post')) {
            $paymentHistory = $this->PaymentHistories->patchEntity($paymentHistory, $this->request->getData());
            if ($this->PaymentHistories->save($paymentHistory)) {
                $this->Flash->success(__('The payment history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment history could not be saved. Please, try again.'));
        }
        $bookings = $this->PaymentHistories->Bookings->find('list', ['limit' => 200]);
        $credit_cards = $this->PaymentHistories->CreditCards->find('list', ['limit' => 200]);
        $prices = $this->PaymentHistories->Prices->find('list', ['limit' => 200]);
        $discounts = $this->PaymentHistories->Discounts->find('list', ['limit' => 200]);
        $sales_taxes = $this->PaymentHistories->SalesTaxes->find('list', ['limit' => 200]);
        $this->set(compact('paymentHistory', 'bookings', 'credit_cards', 'prices', 'discounts', 'sales_taxes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment History id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paymentHistory = $this->PaymentHistories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paymentHistory = $this->PaymentHistories->patchEntity($paymentHistory, $this->request->getData());
            if ($this->PaymentHistories->save($paymentHistory)) {
                $this->Flash->success(__('The payment history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment history could not be saved. Please, try again.'));
        }
        $bookings = $this->PaymentHistories->Bookings->find('list', ['limit' => 200]);
        $credit_cards = $this->PaymentHistories->CreditCards->find('list', ['limit' => 200]);
        $prices = $this->PaymentHistories->Prices->find('list', ['limit' => 200]);
        $discounts = $this->PaymentHistories->Discounts->find('list', ['limit' => 200]);
        $sales_taxes = $this->PaymentHistories->SalesTaxes->find('list', ['limit' => 200]);
        $this->set(compact('paymentHistory', 'bookings', 'credit_cards', 'prices', 'discounts', 'sales_taxes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paymentHistory = $this->PaymentHistories->get($id);
        if ($this->PaymentHistories->delete($paymentHistory)) {
            $this->Flash->success(__('The payment history has been deleted.'));
        } else {
            $this->Flash->error(__('The payment history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
