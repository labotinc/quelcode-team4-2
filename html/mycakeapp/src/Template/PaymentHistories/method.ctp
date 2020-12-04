<?php
// var_dump($cardInfo);
?>
<?= $this->Html->css('bookings'); ?>
<section class="payment-method">
    <h1 class="heading">決済方法</h1>
    <div class="wrapper">
        <div class="confirmation-container">


            <div class="credit">
                <?php if (empty($cardInfo)) : ?>
                    <div class="not-have-card">
                        <?= $this->Html->link('カード情報の登録をお願いします', ['controller' => 'credit_cards', 'action' => 'add']) ?>
                    </div>
                <?php else : ?>
                    <p class="title">ご登録のクレジットカード</p>
                    <div class="card-info">
                        <input type="radio" name="example" value="サンプル">
                        <div class="card-info-details">
                            <p>名前</p>
                            <p>カード情報</p>
                        </div>
                    </div>
                <?php endif; ?>

            </div>


            <div class="point">
                <p class="title">ご利用ポイント</p>
                <div class="">
                    <select name="" id="">
                        <option value="">aa</option>
                        <option value="">bb</option>
                        <option value="">cc</option>
                        <option value="">dd</option>
                    </select>
                </div>
            </div>


        </div>
    </div>
</section>
