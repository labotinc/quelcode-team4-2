<?php

namespace App\Controller;

use App\Controller\AppController;

// 今のところappcontrollerを継承
class MoviesInfoController extends AppController
{


    public function index()

    {
        $this->layout = 'main';
        $week = array("日", "月", "火", "水", "木", "金", "土", "日", "月", "火", "水", "木", "金", "土");
        $countWeek = count($week);
        $today = date("Y-m-d H:i:s");

        for ($i = 0; $i < $countWeek; $i++) {
            $timestamp = strtotime((string)$i . 'day ' . $today);
            $weekNumber = ((int)$week[date("w")]) + $i;
            $weekDate[] = date("m月d日" . "(" . $week[$weekNumber] . ")", $timestamp);
        }
        $this->set(compact('weekDate'));
    }
}
