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
                <p><?php echo ($price); ?>円</p>
            </div>
            <div class="price-flex discount-price">
                <p>割引額</p>
                <p><?php echo ($discount); ?>円</p>
            </div>
            <div class="price-flex total-price">
                <p>小計（税込）</p>
                <p><?php echo ($TaxIncludedPrice); ?>円</p>
            </div>
        </div>

        <div class="select-btn">
            <!-- 今は仮のリンク -->
            <a href="<?= $this->Url->build(['action' => 'PaymentCancel', $booking_id]) ?>" class="cancel-button button">キャンセル</a>
            <a href="<?= $this->Url->build(['action' => 'completion']) ?>" class="accept-button button">決定</a>
        </div>
    </div>
</section>
