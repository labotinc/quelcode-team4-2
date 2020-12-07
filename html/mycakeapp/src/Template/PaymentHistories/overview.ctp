<?php
// var_dump($cardInfo);
?>
<?= $this->Html->css('bookings'); ?>
<section class="payment-method">
    <h1 class="heading">決済概要</h1>
    <div class="overview wrapper">

        <div class="price-box">
            <div class="price-flex ticket-price">
                <p>チケット金額</p>
                <p><?php echo ($price); ?></p>
            </div>
            <div class="price-flex total-price">
                <p>小計</p>
                <p><?php echo ($TotalFee); ?></p>
            </div>
        </div>

        <div class="select-btn">
            <!-- 今は仮のリンク -->
            <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'index']) ?>" class="cancel-button button">キャンセル</a>
            <a href="<?= $this->Url->build(['action' => 'completion']) ?>" class="accept-button button">決定</a>
        </div>
    </div>
</section>
