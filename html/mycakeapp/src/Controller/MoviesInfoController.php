<?php

namespace App\Controller;

use App\Controller\AppController;


use Cake\Event\Event; // added.
use Exception; // added.

// 今のところappcontrollerを継承
class MoviesInfoController extends AppController
{
    // 初期化処理
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Movies');
        $this->loadModel('MovieSchedules');

        // レイアウトをmainに変更
        $this->viewBuilder()->setLayout('main');
    }

    public function index()
    {


        // 'conditions' => ['movie_id' => 1]])->toArray();
        // var_dump($MovieSchedules);

        // var_dump($_POST);
        if ($this->request->is('post')) {
        }

        $ajaxActiveTime = date("Y-m-d 00:00:00", 1605771688);
        $ajaxActiveTimeEND = date("Y-m-d", 1605771688);


        $MovieSchedules = $this->MovieSchedules->find('all')
            // ->contain(['Movies'])
            ->where([
                'MovieSchedules.screening_start_datetime' => $ajaxActiveTimeEND
                // 'MovieSchedules.screening_start_datetime <=' => $ajaxActiveTime
            ])
            ->toArray();



        $this->set(compact('ajaxActiveTime', 'MovieSchedules'));
        // $this->set(compact('weekDate', 'today'));
    }

    function ajaxTest()
    {
        $this->autoRender = FALSE;
        if ($this->request->is('ajax')) {
            // いけた。これでajaxから値が届いた。
            // その日の始まり。
            $ajaxActiveTime = date("Y-m-d 00:00:00", $_GET['time']);
            // その日の終わり
            $ajaxActiveTimeEND = date("Y-m-d 23:59:59", $_GET['time']);

            $MovieSchedules = $this->MovieSchedules->find('all')
                ->contain(['Movies'])
                ->where([
                    'MovieSchedules.screening_start_datetime >=' => $ajaxActiveTime,
                    'MovieSchedules.screening_start_datetime <=' => $ajaxActiveTimeEND
                ])
                ->toArray();

            // $bidrequest = $this->Bidrequests->find('all', [
            // 	'conditions' => ['biditem_id' => $id],
            // 	'contain' => ['Users'],
            // 	'order' => ['price' => 'desc']
            // ])->first();


            echo json_encode($MovieSchedules);
            // echo json_encode($ajaxActiveTime);
            // echo json_encode($ajaxActiveTimeEND);
            // echo json_encode($_GET['time']);
        }
    }
}
