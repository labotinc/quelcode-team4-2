<?= $this->Html->css('toppage'); ?>
    <section>
        <div class="slide-inner">
            <?= $this->Html->image('top/shindemita/shindemita.png'); ?>
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
    