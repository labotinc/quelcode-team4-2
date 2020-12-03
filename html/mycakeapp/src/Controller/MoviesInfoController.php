<?php

namespace App\Controller;

use App\Controller\AppController;


use Cake\Event\Event; // added.
use Exception; // added.

class MoviesInfoController extends MovieAuthBaseController
{
    // 初期化処理
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Movies');
        $this->loadModel('MovieSchedules');
        $this->loadModel('Prices');
        $this->loadModel('Discounts');
        $this->loadModel('CreditCards');

        // レイアウトをmainに変更
        $this->viewBuilder()->setLayout('main');
    }
    public function index()
    {
    }

    public function mypage()
    {
        $user_id = $this->Auth->user('id');
        $my_credit_card = $this->CreditCards->findCreditCard($user_id);
        $this->set(compact('my_credit_card'));
    }

    public function pricelist()
    {
        // 割引テーブル
        $arrayDiscount = $this->Discounts->find('all')
            ->where([
                'is_applied' => true
            ])->order([
                'price' => 'desc'
            ])->toArray();

        // 料金テーブル
        $arrayPrices = $this->Prices->find('all')
            ->where([
                'is_applied' => true
            ])->order([
                'price' => 'desc'
            ])->toArray();

        $this->set(compact('arrayPrices', 'arrayDiscount'));
    }

    public function schedule()
    {
        // ================ 日付について start ================

        $week = array("日", "月", "火", "水", "木", "金", "土", "日", "月", "火", "水", "木", "金", "土");

        for ($i = 0; $i < 7; $i++) {
            $weekNumber = date("w") + $i;
            $weekDate[] = date("m月d日" . "(" . $week[$weekNumber] . ")", strtotime($i . " day"));
            $weekValue[] = strtotime($i . " day" . date("Ymd H:i:s"));
        }

        // ================ 日付について end ================


        // 映画テーブルを取り出す
        $MovieList = $this->Movies->find('all')
            ->where([
                // screening_start_dateとcreening_end_dateで$ajaxDataが上映期間に入っているか判定。
                'screening_start_date <=' =>  date("Y-m-d"),
                'screening_end_date >=' =>   date("Y-m-d"),
                'is_screened' => 1
            ])
            ->toArray();


        // 映画のスケジュールを取り出す
        $ThatDaySchedules = $this->MovieSchedules->find('all')
            ->select(['id', 'movie_id', 'screening_start_datetime'])
            ->where([
                'screening_start_datetime >=' => date("Y-m-d 00:00:00"),
                'screening_start_datetime <=' => date("Y-m-d 23:59:59"),
                'is_playable' => 1
            ])
            ->order([
                'screening_start_datetime' => 'asc'
            ])
            ->toArray();

        // 割引テーブル
        $firstDay = $this->Discounts->find('all')
            ->where([
                'is_applied' => true,
                'name like' => '%' . 'ファーストデイ割引' . '%'
            ])
            ->limit(1)
            ->toArray();

        $senior = $this->Discounts->find('all')
            ->where([
                'is_applied' => true,
                'name like' => '%' . '子供女性シニア割引' . '%'
            ])
            ->limit(1)
            ->toArray();


        $this->set(compact('weekDate', 'weekValue', 'MovieList', 'ThatDaySchedules', 'firstDay', 'senior'));
    }

    function ajaxMovieSchedules()
    {
        $this->autoRender = FALSE;
        if ($this->request->is('ajax')) {
            $ThatDaySchedules = $this->MovieSchedules->find('all')
                ->select(['id', 'movie_id', 'screening_start_datetime'])
                ->where([
                    'screening_start_datetime >=' => date("Y-m-d 00:00:00", $_GET['time']),
                    'screening_start_datetime <=' => date("Y-m-d 23:59:59", $_GET['time']),
                    'is_playable' => 1
                ])
                ->order([
                    'screening_start_datetime' => 'asc'
                ])
                ->toArray();

            echo json_encode($ThatDaySchedules, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    function ajaxMovieList()
    {
        $this->autoRender = FALSE;
        if ($this->request->is('ajax')) {
            // $ajaxDataはクリックされた日付
            // $ajaxData = date("Y-m-d", $_GET['time']);

            $MovieList = $this->Movies->find('all')
                ->where([
                    // screening_start_dateとcreening_end_dateで$ajaxDataが上映期間に入っているか判定。
                    'screening_start_date <=' =>  date("Y-m-d", $_GET['time']),
                    'screening_end_date >=' =>  date("Y-m-d", $_GET['time']),
                    'is_screened' => 1
                ])
                ->toArray();
            echo json_encode($MovieList, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
