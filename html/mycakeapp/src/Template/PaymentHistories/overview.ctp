<?= $this->Html->css('bookings'); ?>
<section>
    <h1 class="heading">決済概要</h1>
    <div class="overview-wrapper">
        <div class="price-box">
            <div class="price-flex ticket-price">
                <p>チケット金額</p>
                <p>¥1,800</p>
            </div>
            <div class="price-flex total-price">
                <p>小計</p>
                <p>¥1,800</p>
            </div>
        </div>

        <div class="select-btn">
            <!-- 今は仮のリンク -->
            <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'index']) ?>" class="cancel-button button">キャンセル</a>
            <a href="<?= $this->Url->build(['action' => 'overview']) ?>" class="accept-button button">決定</a>
        </div>

    </div>
</section>
