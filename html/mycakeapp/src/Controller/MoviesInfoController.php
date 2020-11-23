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

        $todayxData = date("Y-m-d");
        $MovieList = $this->Movies->find('all')
            ->where([
                // screening_start_dateとcreening_end_dateで$ajaxDataが上映期間に入っているか判定。
                'screening_start_date <=' =>  $todayxData,
                'screening_end_date >=' =>  $todayxData,
            ])
            ->toArray();


        $onThatDayMovieSchedules = $this->MovieSchedules->find('all')
            ->select(['id', 'movie_id', 'screening_start_datetime'])
            ->where([
                'is_playable' => 1
            ])
            ->toArray();

        $this->set(compact('weekDate', 'weekValue', 'MovieList', 'onThatDayMovieSchedules'));
    }

    function ajaxMovieSchedules()
    {
        $this->autoRender = FALSE;
        if ($this->request->is('ajax')) {
            $onThatDayMovieSchedules = $this->MovieSchedules->find('all')
                ->select(['id', 'movie_id', 'screening_start_datetime'])
                ->where([
                    'is_playable' => 1
                ])
                ->toArray();

            echo json_encode($onThatDayMovieSchedules, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    function ajaxMovieList()
    {
        $this->autoRender = FALSE;
        if ($this->request->is('ajax')) {
            // $ajaxDataはクリックされた日付
            $ajaxData = date("Y-m-d", $_GET['time']);

            $MovieList = $this->Movies->find('all')
                ->where([
                    // screening_start_dateとcreening_end_dateで$ajaxDataが上映期間に入っているか判定。
                    'screening_start_date <=' =>  $ajaxData,
                    'screening_end_date >=' =>  $ajaxData,
                ])
                ->toArray();
            echo json_encode($MovieList, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
