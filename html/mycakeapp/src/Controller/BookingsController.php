<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Exception;

/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 *
 * @method \App\Model\Entity\Booking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookingsController extends AppController
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
        $login_user_info = $this->set('authuser', $this->Users->get(1));
        // ※認証認可コントローラー完成次第下記に移行。
        // $login_user_info = $this->set('authuser', $this->Auth->user());
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

    // ユーザー操作画面
    public function addSeat($schedule_id)
    {

        $this->viewBuilder()->setLayout('main');
        // MovieSchedulesに存在しないIDのURLを直接入力されたときの処理
        try {
            // $schedules_idの$movie_scheduleを取得する
            $movie_schedule = $this->MovieSchedules->get($schedule_id);
        } catch (Exception $e) {
            $this->Flash->set(__('不正なURLのため、リダイレクトしました。上映スケジュールページからアクセスしてください。'));
            // ※トップページが作成されたら映画スケジュール画面をリダイレクト先にする。action先は未定。
            return $this->redirect(['controller' => 'moviesinfo', 'action' => 'index']);
        }

        $booking = $this->Bookings->newEntity();
        if ($this->request->is('post')) {
            //dd($this->request->getData());
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'seat_confirmation', $booking->id]);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $this->set(compact('booking', 'movie_schedule'));
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
        } catch (Exception $e) {
            $this->Flash->set(__('不正なURLのため、リダイレクトしました。上映スケジュールページから再度アクセスしてください。'));
            // ※トップページが作成されたら映画スケジュール画面をリダイレクト先にする。action先は未定。
            return $this->redirect(['controller' => 'moviesinfo', 'action' => 'index']);
        }

        $this->set(compact('booking', 'movie_info'));
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
        $this->set(compact('booking', 'users', 'schedules'));
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
