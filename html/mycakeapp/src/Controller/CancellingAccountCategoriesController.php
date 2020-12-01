<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CancellingAccountCategories Controller
 *
 * @property \App\Model\Table\CancellingAccountCategoriesTable $CancellingAccountCategories
 *
 * @method \App\Model\Entity\CancellingAccountCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CancellingAccountCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $cancellingAccountCategories = $this->paginate($this->CancellingAccountCategories);

        $this->set(compact('cancellingAccountCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Cancelling Account Category id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cancellingAccountCategory = $this->CancellingAccountCategories->get($id, [
            'contain' => [],
        ]);

        $this->set('cancellingAccountCategory', $cancellingAccountCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cancellingAccountCategory = $this->CancellingAccountCategories->newEntity();
        if ($this->request->is('post')) {
            $cancellingAccountCategory = $this->CancellingAccountCategories->patchEntity($cancellingAccountCategory, $this->request->getData());
            if ($this->CancellingAccountCategories->save($cancellingAccountCategory)) {
                $this->Flash->success(__('The cancelling account category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cancelling account category could not be saved. Please, try again.'));
        }
        $this->set(compact('cancellingAccountCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cancelling Account Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cancellingAccountCategory = $this->CancellingAccountCategories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cancellingAccountCategory = $this->CancellingAccountCategories->patchEntity($cancellingAccountCategory, $this->request->getData());
            if ($this->CancellingAccountCategories->save($cancellingAccountCategory)) {
                $this->Flash->success(__('The cancelling account category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cancelling account category could not be saved. Please, try again.'));
        }
        $this->set(compact('cancellingAccountCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cancelling Account Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cancellingAccountCategory = $this->CancellingAccountCategories->get($id);
        if ($this->CancellingAccountCategories->delete($cancellingAccountCategory)) {
            $this->Flash->success(__('The cancelling account category has been deleted.'));
        } else {
            $this->Flash->error(__('The cancelling account category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
