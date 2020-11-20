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


        // その日にやる映画を取り出す

        $Movies = $this->Movies->find('all')
            ->select(['title', 'total_minutes_with_trailer', 'screening_end_date'])
            ->where([
                'screening_start_date <=' => '2020-11-21',
                'screening_start_date >=' => '2020-11-21'
            ])
            ->toArray();



        $MovieSchedules = $this->MovieSchedules->find('all')
            ->select(['movie_id'])
            ->toArray();

        $MovieList[] = $Movies + $MovieSchedules;

        // print_r($Movies);
        // print("======================================================");
        // print_r($MovieSchedules);
        // print("======================================================");
        // var_dump($MovieList);




        $this->set(compact('weekDate', 'weekValue', 'today', 'MovieList'));
    }

    function ajaxTest()
    {
        $this->autoRender = FALSE;
        if ($this->request->is('ajax')) {
            $ajaxData = date("Y-m-d", $_GET['time']);

            $MovieList = $this->Movies->find('all')
                // ->contain(['MovieSchedules'])
                ->join([
                    'table' => 'movie_schedules',
                    'type' => 'INNER',
                    'conditions' => 'Movies.id = movie_schedules.movie_id',
                ])
                ->select([
                    'title' => 'Movies.title',
                    'thumbnail_path' => 'Movies.thumbnail_path',
                    'total_minutes_with_trailer' => 'Movies.total_minutes_with_trailer',
                    'screening_end_date' => 'Movies.screening_end_date',
                ])
                ->where([
                    'Movies.screening_start_date <=' =>  $ajaxData,
                    'Movies.screening_end_date >=' =>  $ajaxData
                ])
                ->toArray();
            echo json_encode($MovieList, JSON_UNESCAPED_UNICODE);


            // その日の始まり。
            $ajaxActiveTime = date("Y-m-d 00:00:00", $_GET['time']);
            // その日の終わり
            $ajaxActiveTimeEND = date("Y-m-d 23:59:59", $_GET['time']);

            // $MovieSchedules = $this->MovieSchedules->find('all')
            //     ->select([
            //         'MovieSchedules.screening_start_datetime'
            //     ])->where([
            //         'MovieSchedules.screening_start_datetime >=' => $ajaxActiveTime,
            //         'MovieSchedules.screening_start_datetime <=' => $ajaxActiveTimeEND
            //     ])->toArray();


            // $MovieSchedules = $this->MovieSchedules->find('all')
            //     ->contain(['Movies'])
            //     ->where([
            //         'MovieSchedules.screening_start_datetime >=' => $ajaxActiveTime,
            //         'MovieSchedules.screening_start_datetime <=' => $ajaxActiveTimeEND
            //     ])->toArray();

            // JSON_UNESCAPED_UNICODEで文字化け回避
            // echo json_encode($MovieSchedules, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
