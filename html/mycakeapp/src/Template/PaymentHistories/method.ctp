<?= $this->Html->css('bookings'); ?>
<section>
    <h1 class="heading">決済方法</h1>
    <div class="credit-wrapper">
        <div class="credit-box">
            <p class="credit-summary">ご登録のクレジットカード</p>

            <div class="credit-choice">
                <?php for ($i = 0; $i < count($arrayCreditCards); $i++) : ?>
                    <?php $options = array($arrayCreditCards[$i]['card_number']); ?>
                    <p class="credit-choice-radio"><?php echo $this->Form->radio('CardNumber', $options); ?></p>
                    <div class="credit-choice-flex">
                        <p><?php echo $arrayCreditCards[$i]['holder_name'] ?></p>
                        <p>有効期限<?php echo $arrayCreditCards[$i]['expiration_date'] ?></p>
                    </div>
                <?php endfor; ?>
            </div>

            <!-- ========= 将来的に実装予定 ========= -->
            <!-- <p class="credit-summary">ご利用ポイント</p>
            <p class="point-choice">一部利用する。(今はテキストで入れる)</p> -->
            <!-- ========= 将来的に実装予定 end========= -->
            <div class="select-btn">

                <!-- 今は仮のリンク -->
                <a href="<?= $this->Url->build(['controller' => 'MoviesInfo', 'action' => 'schedule']) ?>" class="cancel-button button">キャンセル</a>
                <a href="<?= $this->Url->build(['controller' => 'MoviesInfo', 'action' => 'schedule']) ?>" class="accept-button button">決定</a>
            </div>
        </div>
    </div>
</section>
