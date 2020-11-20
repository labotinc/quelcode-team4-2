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
        // ================ 日付について start ================
        $today = date("Ymd H:i:s");
        $today_w = date("w");
        $week = array("日", "月", "火", "水", "木", "金", "土", "日", "月", "火", "水", "木", "金", "土");
        $countWeek = count($week) - (int)$today_w;

        for ($i = 0; $i < $countWeek; $i++) {
            $timestamp = strtotime((string)$i . 'day ' . $today);
            $weekNumber = $today_w + $i;
            $weekDate[] = date("m月d日" . "(" . $week[$weekNumber] . ")", $timestamp);
            $weekValue[] = $timestamp;
        }
        // ================ 日付について end ================
        // 1つの映画の複数のスケジュール（その日にやるやつを取りだそう）
        // $MovieSchedules = $this->MovieSchedules->find('all')
        //     ->contain(['Movies'])
        //     ->join([
        //         'table' => 'movies',
        //         'type' => 'INNER',
        //         'conditions' => 'movies.id = MovieSchedules.movie_id',
        //     ])->select([
        //         'id' => 'movies.id',
        //         'title' => 'movies.title',
        //         'screening_end_date' => 'movies.screening_end_date',

        //     ])
        //     // ->where(['movies.id' => 1])
        //     ->toArray();
        // var_dump($MovieSchedules);

        // ↑これで、selectして選べる


        $this->set(compact('weekDate', 'weekValue', 'today'));
    }

    function ajaxTest()
    {
        $this->autoRender = FALSE;
        if ($this->request->is('ajax')) {
            $ajaxData = date("Y-m-d", $_GET['time']);

            // $MovieList = $this->Movies->find('all')
            //     ->join([
            //         'table' => 'movie_schedules',
            //         'type' => 'INNER',
            //         'conditions' => 'Movies.id = movie_schedules.movie_id',
            //     ])
            //     ->select([
            //         'id' => 'Movies.title',
            //         'title' => 'Movies.title',
            //         'thumbnail_path' => 'Movies.thumbnail_path',
            //         'total_minutes_with_trailer' => 'Movies.total_minutes_with_trailer',
            //         'screening_end_date' => 'Movies.screening_end_date',
            //         'screening_start_datetime' => 'movie_schedules.screening_start_datetime',
            //     ])
            //     ->where([
            //         // 'Movies.id' =>  2,
            //         'Movies.screening_start_date <=' =>  $ajaxData,
            //         'Movies.screening_end_date >=' =>  $ajaxData
            //     ])
            //     ->toArray();
            // echo json_encode($MovieList, JSON_UNESCAPED_UNICODE);

            $MovieList = $this->Movies->find('all')
                ->where([
                    'screening_start_date <=' =>  $ajaxData,
                    'screening_end_date >=' =>  $ajaxData
                ])
                ->toArray();
            echo json_encode($MovieList, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }



    function ajaxHoge()
    {
        $this->autoRender = FALSE;
        if ($this->request->is('ajax')) {
            $Data = date("Y-m-d", $_GET['time']);

            $hoge = $this->Movies->find('all')
                ->select(['id'])
                ->where([
                    'screening_start_date <=' =>  $Data,
                    'screening_end_date >=' =>  $Data
                ])
                ->toArray();

            // その日の始まり。
            $ajaxActiveTime = date("Y-m-d 00:00:00", $_GET['time']);
            // その日の終わり
            $ajaxActiveTimeEND = date("Y-m-d 23:59:59", $_GET['time']);



            $age = $this->MovieSchedules->find('all')
                ->select(['movie_id', 'screening_start_datetime'])
                // ->where([
                //     'screening_start_date >=' =>  $ajaxActiveTime,
                //     'screening_end_date <=' =>   $ajaxActiveTimeEND
                // ])
                ->toArray();

            echo json_encode($age, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
