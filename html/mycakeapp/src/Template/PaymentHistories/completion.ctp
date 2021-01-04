<?php
// var_dump($cardInfo);
?>
<?= $this->Html->css('bookings'); ?>
<section class="payment-method">

    <div class="completion wrapper">
        <p>決済が完了しました</p>
        <div class="select-btn">
            <a href="<?= $this->Url->build(['controller' => 'MoviesInfo', 'action' => 'index']) ?>" class="accept-button button">戻る</a>
        </div>
    </div>
</section>
