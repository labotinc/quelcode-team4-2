<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Utility\Hash;
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
        $add_seat_session = $this->getRequest()->getSession();
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
        // 予約済座席の一覧を配列として取得する。
        $booked_seats = $this->Bookings->findBookingSeats($schedule_id);
        $booked_seats_array = Hash::extract($booked_seats, '{n}.seat_number');
        $booking = $this->Bookings->newEntity();
        $cancel_user_seat = "0";
        // P51からキャンセルボタンで遷移した場合の席番号の取得
        if ($add_seat_session->check('seat_number')) {
            $cancel_user_seat = $add_seat_session->read('seat_number');
            $add_seat_session->delete('seat_number');
        }
        if ($this->request->is('post')) {
            // POST送信時に予約済の座席を選択していた場合は座席予約ページにリダイレクトする。
            $my_booking_seat = $this->request->getData('seat_number');
            $booked_seats_post_time = $this->Bookings->findBookingSeats($schedule_id);
            $booked_seats_post_time_array = Hash::extract($booked_seats, '{n}.seat_number');
            if (in_array($my_booking_seat, $booked_seats_post_time_array)) {
                $this->Flash->error(__('選択した座席はすでに他のお客様が予約済みです。別の席を選択してください。'));
                return $this->redirect($this->request->referer());
            }
            //dd($this->request->getData());
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                return $this->redirect(['action' => 'seat_confirmation', $booking->id]);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }


        $this->set(compact('booking', 'movie_schedule', 'booked_seats_array', 'cancel_user_seat'));
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
            $schedule_id = $booking->movie_schedule['id'];
        } catch (Exception $e) {
            $this->Flash->set(__('不正なURLのため、リダイレクトしました。上映スケジュールページから再度アクセスしてください。'));
            // ※トップページが作成されたら映画スケジュール画面をリダイレクト先にする。action先は未定。
            return $this->redirect(['controller' => 'moviesinfo', 'action' => 'index']);
        }

        $this->set(compact('booking', 'movie_info', 'schedule_id'));
    }

    // 基本設計P51でキャンセルボタンを押した時の処理
    public function seatCancel($booking_id)
    {
        try {
            $cancel_booking = $this->Bookings->get($booking_id);
            $cancel_booking_movie = $cancel_booking['schedule_id'];
            $cancel_booking_seat = $cancel_booking['seat_number'];
            // キャンセル前に予約した座席番号を取得し、セッションに格納
            $session = $this->getRequest()->getSession('seat_number');
            $session->write('seat_number', $cancel_booking_seat);
            $this->Bookings->delete($cancel_booking);
            return $this->redirect((['action' => 'add_seat', $cancel_booking_movie]));
        } catch (Exception $e) {
            $this->Flash->set(__('正常にキャンセル処理ができませんでした。カスタマーセンターまでお問い合わせください。'));
            // ※トップページが作成されたら映画スケジュール画面をリダイレクト先にする。action先は未定。
            return $this->redirect(['controller' => 'moviesinfo', 'action' => 'index']);
        }
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
        $schedule_id = $booking->movie_schedule['id'];
        $this->set(compact('booking', 'users', 'schedules', 'schedule_id'));
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
