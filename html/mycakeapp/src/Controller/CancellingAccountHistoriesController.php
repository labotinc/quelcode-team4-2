<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * CancellingAccountHistories Controller
 *
 * @property \App\Model\Table\CancellingAccountHistoriesTable $CancellingAccountHistories
 *
 * @method \App\Model\Entity\CancellingAccountHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CancellingAccountHistoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'cancelling_account_categories'],
        ];
        $cancellingAccountHistories = $this->paginate($this->CancellingAccountHistories);

        $this->set(compact('cancellingAccountHistories'));
    }

    /**
     * View method
     *
     * @param string|null $id Cancelling Account History id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cancellingAccountHistory = $this->CancellingAccountHistories->get($id, [
            'contain' => ['Users', 'cancelling_account_categories'],
        ]);

        $this->set('cancellingAccountHistory', $cancellingAccountHistory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cancellingAccountHistory = $this->CancellingAccountHistories->newEntity();
        if ($this->request->is('post')) {
            $cancellingAccountHistory = $this->CancellingAccountHistories->patchEntity($cancellingAccountHistory, $this->request->getData());
            if ($this->CancellingAccountHistories->save($cancellingAccountHistory)) {
                $this->Flash->success(__('The cancelling account history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cancelling account history could not be saved. Please, try again.'));
        }
        $users = $this->CancellingAccountHistories->Users->find('list', ['limit' => 200]);
        $cancellingCategories = $this->CancellingAccountHistories->cancelling_account_categories->find('list', ['limit' => 200]);
        $this->set(compact('cancellingAccountHistory', 'users', 'cancellingCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cancelling Account History id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cancellingAccountHistory = $this->CancellingAccountHistories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cancellingAccountHistory = $this->CancellingAccountHistories->patchEntity($cancellingAccountHistory, $this->request->getData());
            if ($this->CancellingAccountHistories->save($cancellingAccountHistory)) {
                $this->Flash->success(__('The cancelling account history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cancelling account history could not be saved. Please, try again.'));
        }
        $users = $this->CancellingAccountHistories->Users->find('list', ['limit' => 200]);
        $cancellingCategories = $this->CancellingAccountHistories->cancelling_account_categories->find('list', ['limit' => 200]);
        $this->set(compact('cancellingAccountHistory', 'users', 'cancellingCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cancelling Account History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cancellingAccountHistory = $this->CancellingAccountHistories->get($id);
        if ($this->CancellingAccountHistories->delete($cancellingAccountHistory)) {
            $this->Flash->success(__('The cancelling account history has been deleted.'));
        } else {
            $this->Flash->error(__('The cancelling account history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
