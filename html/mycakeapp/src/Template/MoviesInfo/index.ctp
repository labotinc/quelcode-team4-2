<?php
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

// ↓これはdataに変換するコード
var_dump($ajaxActiveTime);
// var_dump(date("Y-m-d H:i:s", $weekValue[0]));


// var_dump($weekDate);
// var_dump($city);
var_dump($MovieSchedules);
?>
<?= $this->Html->css('moviesinfo.css'); ?>
<li id=tekitou></li>
<div class="movie-info-wrap">
    <div class="movie-info-menu">
        <p class="scheduel-text">上映スケジュール</p>
        <!-- spanは縦線 -->
        <ul>
            <li class="info-menu" value="<?php echo $weekValue[0] ?>"><?php echo $weekDate[0] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[1] ?>"><?php echo $weekDate[1] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[2] ?>"><?php echo $weekDate[2] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[3] ?>"><?php echo $weekDate[3] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[4] ?>"><?php echo $weekDate[4] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[5] ?>"><?php echo $weekDate[5] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[6] ?>"><?php echo $weekDate[6] ?></li>
        </ul>
        <!-- 今は適当に日付入れてあとからヘルパー -->
        <p id="scheduled-date"><?php echo $weekDate[0] ?></p>
        <div class="movie-list">
            <div class="movie-list-head">
                <p class="movie-title">タイトルタイトル</p>
                <p class="movie-screening-time">[ 上映時間 : 100分 ]</p>
                <p class="movie-scheduled-to-end">00月00日(金)終了予定</p>
            </div>
            <!-- ======================= 1block チケット購入 ======================= -->
            <div class="movie-list-main">
                <p class="movie-img"><img src="" alt="">img</p>
                <div class="movie-schedule-for-the-day">
                    <p class="movie-time">00:00~00:00</p>
                    <p class="buy-button">予約購入</p>
                </div>
                <div class="movie-schedule-for-the-day">
                    <p class="movie-time">00:00~00:00</p>
                    <p class="buy-button">予約購入</p>
                </div>
                <div class="movie-schedule-for-the-day">
                    <p class="movie-time">00:00~00:00</p>
                    <p class="buy-button">予約購入</p>
                </div>
                <div class="movie-schedule-for-the-day">
                    <p class="movie-time">00:00~00:00</p>
                    <p class="buy-button">予約購入</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script('moviesinfo.js') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-3.5.1.min.js') ?>
