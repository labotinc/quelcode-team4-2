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
        $this->set(compact('weekDate', 'weekValue', 'today'));
    }

    function ajaxTest()
    {
        $this->autoRender = FALSE;
        if ($this->request->is('ajax')) {
            // その日の始まり。
            $ajaxActiveTime = date("Y-m-d 00:00:00", $_GET['time']);
            // その日の終わり
            $ajaxActiveTimeEND = date("Y-m-d 23:59:59", $_GET['time']);

            $MovieSchedules = $this->MovieSchedules->find('all')
                ->contain(['Movies'])
                ->where([
                    'MovieSchedules.screening_start_datetime >=' => $ajaxActiveTime,
                    'MovieSchedules.screening_start_datetime <=' => $ajaxActiveTimeEND
                ])->toArray();

            // JSON_UNESCAPED_UNICODEで文字化け回避
            echo json_encode($MovieSchedules, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
