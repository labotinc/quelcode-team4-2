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
        $this->loadModel('CreditCards');
        $this->loadModel('Users');
        $this->loadModel('Prices');
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
        $priceName = $this->Prices->findUser($price);
        // == end ============


        // 割引(discount_id)
        // 割引取り出すのむずい。後からやる


        if ($this->request->is('post')) {

            // Bookings_id⬇︎
            var_dump($booking_id);

            // カードのid
            var_dump($_POST['cardInfoId']);

            // 価格(price_id)
            var_dump($priceName[0]['price']);

            // 割引(discount_id) 今は　1　にしとこう

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
