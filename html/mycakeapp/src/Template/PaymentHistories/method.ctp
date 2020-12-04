<?php
// var_dump($cardInfo);
?>
<?= $this->Html->css('bookings'); ?>
<section class="payment-method">
    <h1 class="heading">決済方法</h1>
    <div class="wrapper">
        <div class="confirmation-container">
            <?= $this->Form->create(); ?>
            <div class="credit">
                <?php if (empty($cardInfos)) : ?>
                    <div class="not-have-card">
                        <?= $this->Html->link('カード情報の登録をお願いします', ['controller' => 'credit_cards', 'action' => 'add']) ?>
                    </div>
                <?php else : ?>
                    <p class="title">ご登録のクレジットカード</p>


                    <?php foreach ($cardInfos as $cardInfo) : ?>
                        <div class="card-info">
                            <?php if (empty($inputRadio)) : ?>
                                <input type="radio" name="cardInfoId" value="<?php echo $cardInfo->id ?>" checked>
                                <?php $inputRadio = 'checked' ?>
                            <?php else : ?>
                                <input type="radio" name="cardInfoId" value="<?php echo $cardInfo->id ?>">
                            <?php endif; ?>
                            <div class="card-info-details">
                                <p class="name">
                                    <!-- <?= h($cardInfo->holder_name) ?> -->
                                    名前
                                </p>
                                <div class="flex">
                                    <p class="card-info-CardNumber">
                                        <!-- <?= h($cardInfo->card_number) ?> -->
                                        カード番号
                                    </p>
                                    <p class="card-info-ExpirationDate">
                                        <!-- <?= h($cardInfo->expiration_date) ?> -->
                                        有効期限
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
            <?= $this->Form->submit('決定', ['class' => 'registration']) ?>
            <?= $this->Form->end() ?>

        </div>
    </div>
</section>
