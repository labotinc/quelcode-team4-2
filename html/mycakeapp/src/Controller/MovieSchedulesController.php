<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * MovieSchedules Controller
 *
 * @property \App\Model\Table\MovieSchedulesTable $MovieSchedules
 *
 * @method \App\Model\Entity\MovieSchedule[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MovieSchedulesController extends MovieAuthBaseController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Movies'],
        ];
        $movieSchedules = $this->paginate($this->MovieSchedules);

        $this->set(compact('movieSchedules'));
    }

    /**
     * View method
     *
     * @param string|null $id Movie Schedule id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $movieSchedule = $this->MovieSchedules->get($id, [
            'contain' => ['Movies'],
        ]);

        $this->set('movieSchedule', $movieSchedule);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $movieSchedule = $this->MovieSchedules->newEntity();
        if ($this->request->is('post')) {
            $movieSchedule = $this->MovieSchedules->patchEntity($movieSchedule, $this->request->getData());
            if ($this->MovieSchedules->save($movieSchedule)) {
                $this->Flash->success(__('The movie schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The movie schedule could not be saved. Please, try again.'));
        }
        $movies = $this->MovieSchedules->findScreeningsNotEnd();
        $this->set(compact('movieSchedule', 'movies'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Movie Schedule id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $movieSchedule = $this->MovieSchedules->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $movieSchedule = $this->MovieSchedules->patchEntity($movieSchedule, $this->request->getData());
            if ($this->MovieSchedules->save($movieSchedule)) {
                $this->Flash->success(__('The movie schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The movie schedule could not be saved. Please, try again.'));
        }
        $movies = $this->MovieSchedules->Movies->find('list', ['limit' => 200]);
        $this->set(compact('movieSchedule', 'movies'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Movie Schedule id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $movieSchedule = $this->MovieSchedules->get($id);
        if ($this->MovieSchedules->delete($movieSchedule)) {
            $this->Flash->success(__('The movie schedule has been deleted.'));
        } else {
            $this->Flash->error(__('The movie schedule could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
