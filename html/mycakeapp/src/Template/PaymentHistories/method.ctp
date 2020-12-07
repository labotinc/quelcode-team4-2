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
                                    <?= h($cardInfo->holder_name) ?>
                                </p>
                                <div class="flex">
                                    <p class="card-info-CardNumber">
                                        <?= h($cardInfo->card_number) ?>
                                    </p>
                                    <p class="card-info-ExpirationDate">
                                        有効期限
                                        <?php
                                        $mouth = substr($cardInfo->expiration_date, 0, 2);
                                        $year = '20' . (string)substr($cardInfo->expiration_date, 2, 2);
                                        ?>
                                        <?= h($mouth) ?>
                                        /
                                        <?= h($year) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="btn">
                <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'seat-confirmation', $booking_id]) ?>" class="cancel-button button">キャンセル</a>
                <?= $this->Form->submit('決定', ['class' => 'registration']) ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</section>
