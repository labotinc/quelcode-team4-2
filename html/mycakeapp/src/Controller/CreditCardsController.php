<?php

namespace App\Controller;

use App\Controller\AppController;
// use Cake\Utility\Security;
use Cake\Core\Configure;
// use Cake\Event\Event;

/**
 * CreditCards Controller
 *
 * @property \App\Model\Table\CreditCardsTable $CreditCards
 *
 * @method \App\Model\Entity\CreditCard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CreditCardsController extends AppController
{

    //public function beforeFilter(Event $event)
    //{
    //    $this->getEventManager()->off($this->Csrf);
    //}
    
    //public function initialize()
    //{
    //    parent::initialize();
    //    $this->loadComponent('Csrf');
    //    $this->loadComponent('Security');
    //}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        //$key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
        //$this->CreditCards->card_number = Security::decrypt($this->CreditCards->card_number, $key);
        //$this->CreditCards->holder_name = Security::decrypt($this->CreditCards->holder_name, $key);
        //$this->CreditCards->expiration_date = Security::decrypt($this->CreditCards->expiration_date, $key);
        $creditCards = $this->paginate($this->CreditCards);

        $this->set(compact('creditCards'));
    }

    /**
     * View method
     *
     * @param string|null $id Credit Card id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $creditCard = $this->CreditCards->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('creditCard', $creditCard);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $creditCard = $this->CreditCards->newEntity();
        $key = Configure::read('key');
        //$salt = Configure::read('salt');
        if ($this->request->is('post')) {
            $creditCard = $this->CreditCards->patchEntity($creditCard, $this->request->getData());
            // バリデーションエラーが起こらなかった場合
            if ($creditCard) {
                $method = "aes-256-cbc";
                $options = 0;
                $ivLength = openssl_cipher_iv_length($method);
                $IV = openssl_random_pseudo_bytes($ivLength);
                $creditCard['card_number'] = openssl_encrypt($creditCard['card_number'], $method, $key, $options, $IV);
                $creditCard['holder_name'] = openssl_encrypt($creditCard['holder_name'], $method, $key, $options, $IV);
                $creditCard['expiration_date'] = openssl_encrypt($creditCard['expiration_date'], $method, $key, $options, $IV);
                // cakephp3 
                //$key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
                //$creditCard['holder_name'] = Security::encrypt($creditCard['holder_name'], $key, null);
                //$creditCard['card_number'] = Security::encrypt($creditCard['card_number'], $key, null);
                //$creditCard['expiration_date'] = Security::encrypt($creditCard['expiration_date'], $key, null);
            }
            if ($this->CreditCards->save($creditCard)) {
                $this->Flash->success(__('The credit card has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The credit card could not be saved. Please, try again.'));
        }
        //$methods = openssl_get_cipher_methods();
        $users = $this->CreditCards->Users->find('list', ['limit' => 200]);
        $this->set(compact('creditCard', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Credit Card id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $creditCard = $this->CreditCards->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $creditCard = $this->CreditCards->patchEntity($creditCard, $this->request->getData());
            if ($this->CreditCards->save($creditCard)) {
                $this->Flash->success(__('The credit card has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The credit card could not be saved. Please, try again.'));
        }
        $users = $this->CreditCards->Users->find('list', ['limit' => 200]);
        $this->set(compact('creditCard', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Credit Card id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $creditCard = $this->CreditCards->get($id);
        if ($this->CreditCards->delete($creditCard)) {
            $this->Flash->success(__('The credit card has been deleted.'));
        } else {
            $this->Flash->error(__('The credit card could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
