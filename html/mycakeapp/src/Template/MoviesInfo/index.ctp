<?= $this->Html->css('toppage'); ?>
<section>
    <!-- スライドショー参考URL: https://csshtml.work/css-only-select-auto-slide/ -->
    <div class="slide-inner">
        <div class="out">
            <?= $this->Html->image('top/slide/cinema.jpg'); ?>
            <input type=radio name="slide" id="slide1">
            <input type=radio name="slide" id="slide2">
            <input type=radio name="slide" id="slide3">
            <div class="in">
                <label for="slide1"><span></span><a href="#1"><?= $this->Html->image('top/slide/cinema.jpg'); ?></a></label>
                <label for="slide2"><span></span><a href="#2"><?= $this->Html->image('top/slide/popcorn.jpg'); ?></a></label>
                <label for="slide3"><span></span><a href="#3"><?= $this->Html->image('top/slide/theater.jpg'); ?></a></label>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="movielist-inner">
        <div class="heading-box">
            <div class="bar"></div>
            <h1 class="h1">上映映画一覧</h1>
        </div>
        <div class="movielist-box">
            <?= $this->Html->image('top/onair/film.jpg') ?>
            <?= $this->Html->image('top/onair/goods.jpg') ?>
            <?= $this->Html->image('top/onair/dice.jpg') ?>
        </div>
        <?= $this->Html->link('上映一覧（予約にはログインが必要です）', ['controller' => 'MoviesInfo', 'action' => 'schedule'], ['class' => 'movielist-link']); ?>
    </div>
</section>
<section>
    <div class="discount-inner">
        <div class="heading-box">
            <div class="bar"></div>
            <h1 class="h1">お得な割引</h1>
        </div>
        <div class="banner-box upper">
            <?= $this->Html->image('top/banner/sale1.jpg') ?>
            <?= $this->Html->image('top/banner/sale2.jpg') ?>
        </div>
        <?= $this->Html->link('料金表', ['controller' => 'prices', 'action' => 'index'], ['class' => 'discount-link']); ?>
    </div>
</section>
