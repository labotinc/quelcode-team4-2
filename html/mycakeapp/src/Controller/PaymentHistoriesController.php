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
        // var_dump($user_id);


        // そもそもの欲しい情報とは
        // Bookings_id⬇︎
        var_dump($booking_id);

        // カード情報
        $cardInfo = $this->CreditCards->findCreditCardToPaymentHistories($user_id);
        var_dump($cardInfo);
        // 価格(price_id)

        // 割引(discount_id)

        // 税金(sales_tax_id)
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
