<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Prices Controller
 *
 * @property \App\Model\Table\PricesTable $Prices
 *
 * @method \App\Model\Entity\Price[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PricesController extends MovieAuthBaseController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $prices = $this->paginate($this->Prices);

        $this->set(compact('prices'));
    }

    /**
     * View method
     *
     * @param string|null $id Price id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $price = $this->Prices->get($id, [
            'contain' => [],
        ]);

        $this->set('price', $price);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $price = $this->Prices->newEntity();
        if ($this->request->is('post')) {
            $price = $this->Prices->patchEntity($price, $this->request->getData());
            if ($this->Prices->save($price)) {
                $this->Flash->success(__('The price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The price could not be saved. Please, try again.'));
        }
        $this->set(compact('price'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Price id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $price = $this->Prices->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $price = $this->Prices->patchEntity($price, $this->request->getData());
            if ($this->Prices->save($price)) {
                $this->Flash->success(__('The price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The price could not be saved. Please, try again.'));
        }
        $this->set(compact('price'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Price id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $price = $this->Prices->get($id);
        if ($this->Prices->delete($price)) {
            $this->Flash->success(__('The price has been deleted.'));
        } else {
            $this->Flash->error(__('The price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
