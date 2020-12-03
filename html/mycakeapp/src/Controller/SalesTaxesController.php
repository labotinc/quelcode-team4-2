<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SalesTaxes Controller
 *
 * @property \App\Model\Table\SalesTaxesTable $SalesTaxes
 *
 * @method \App\Model\Entity\SalesTax[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalesTaxesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $salesTaxes = $this->paginate($this->SalesTaxes);

        $this->set(compact('salesTaxes'));
    }

    /**
     * View method
     *
     * @param string|null $id Sales Tax id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesTax = $this->SalesTaxes->get($id, [
            'contain' => [],
        ]);

        $this->set('salesTax', $salesTax);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesTax = $this->SalesTaxes->newEntity();
        if ($this->request->is('post')) {
            $salesTax = $this->SalesTaxes->patchEntity($salesTax, $this->request->getData());
            if ($this->SalesTaxes->save($salesTax)) {
                $this->Flash->success(__('The sales tax has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales tax could not be saved. Please, try again.'));
        }
        $this->set(compact('salesTax'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Tax id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesTax = $this->SalesTaxes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesTax = $this->SalesTaxes->patchEntity($salesTax, $this->request->getData());
            if ($this->SalesTaxes->save($salesTax)) {
                $this->Flash->success(__('The sales tax has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales tax could not be saved. Please, try again.'));
        }
        $this->set(compact('salesTax'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Tax id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesTax = $this->SalesTaxes->get($id);
        if ($this->SalesTaxes->delete($salesTax)) {
            $this->Flash->success(__('The sales tax has been deleted.'));
        } else {
            $this->Flash->error(__('The sales tax could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
