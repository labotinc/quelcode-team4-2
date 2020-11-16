<?php
// var_dump($weekDate);

?>

<?= $this->Html->css('moviesinfo.css'); ?>
<div class="movie-info-wrap">
    <div class="movie-info-menu">
        <p class="scheduel-text">上映スケジュール</p>
        <!-- spanは縦線 -->
        <ul>
            <li class="info-menu"><?php echo $weekDate[0] ?><span></span></li>
            <li class="info-menu"><?php echo $weekDate[1] ?><span></span></li>
            <li class="info-menu"><?php echo $weekDate[2] ?><span></span></li>
            <li class="info-menu"><?php echo $weekDate[3] ?><span></span></li>
            <li class="info-menu"><?php echo $weekDate[4] ?><span></span></li>
            <li class="info-menu"><?php echo $weekDate[5] ?><span></span></li>
            <li class="info-menu"><?php echo $weekDate[6] ?></li>
        </ul>

        <!-- 今は適当に日付入れてあとからヘルパー -->
        <p class="scheduled-date">00月00日(月)</p>
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
