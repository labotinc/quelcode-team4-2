<?= $this->Html->css('moviesinfo.css'); ?>
<div class="movie-info-wrap">
    <div class="movie-info-menu">
        <p>上映スケジュール</p>
        <!-- spanは縦線 -->
        <ul>
            <li class="info-menu">00月00日(月)<span></span></li>
            <li class="info-menu">00月00日(火)<span></span></li>
            <li class="info-menu">00月00日(水)<span></span></li>
            <li class="info-menu">00月00日(木)<span></span></li>
            <li class="info-menu">00月00日(金)<span></span></li>
            <li class="info-menu">00月00日(土)<span></span></li>
            <li class="info-menu">00月00日(日)</li>
        </ul>
    </div>
</div>
<?= $this->Html->script('moviesinfo.js') ?>
