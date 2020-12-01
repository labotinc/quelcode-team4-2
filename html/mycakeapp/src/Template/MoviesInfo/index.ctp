<?= $this->Html->css('toppage'); ?>
<section>
    <!-- スライドショー参考URL: https://csshtml.work/css-only-select-auto-slide/ -->
    <div class="slide-inner">
        <div class="out">
            <?= $this->Html->image('top/kingdom/masamicool.jpg'); ?>
            <input type=radio name="slide" id="slide1">
            <input type=radio name="slide" id="slide2">
            <input type=radio name="slide" id="slide3">
            <div class="in">
                <label for="slide1"><span></span><a href="#1"><?= $this->Html->image('top/kingdom/masamicool.jpg'); ?></a></label>
                <label for="slide2"><span></span><a href="#2"><?= $this->Html->image('top/oceans8/oceans.jpg'); ?></a></label>
                <label for="slide3"><span></span><a href="#3"><?= $this->Html->image('top/adaline/adaline.jpg'); ?></a></label>
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
            <?= $this->Html->image('top/katsuben/katsuben.png') ?>
            <?= $this->Html->image('top/kiminosuizo/kiminosuizo.png') ?>
            <?= $this->Html->image('top/yayoisangatsu/yayoisangatsu.png') ?>
        </div>
        <a href="#" class="movielist-link">詳しく見る</a>
    </div>
</section>
<section>
    <div class="discount-inner">
        <div class="heading-box">
            <div class="bar"></div>
            <h1 class="h1">お得な割引</h1>
        </div>
        <div class="banner-box upper">
            <?= $this->Html->image('top/banner/80.gif') ?>
            <?= $this->Html->image('top/banner/6166.gif') ?>
        </div>
        <div class="banner-box lower">
            <?= $this->Html->image('top/banner/6225.gif') ?>
            <?= $this->Html->image('top/banner/6227.gif') ?>
        </div>
        <a href="#" class="discount-link">詳しく見る</a>
    </div>
</section>
