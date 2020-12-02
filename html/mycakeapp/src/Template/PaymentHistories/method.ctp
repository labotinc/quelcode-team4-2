<?= $this->Html->css('bookings'); ?>
<section>
    <h1 class="heading">決済方法</h1>
    <div class="credit-wrapper">
        <div class="credit-box">
            <p class="credit-summary">ご登録のクレジットカード</p>
            <div class="credit-choice">
                <p><?php echo $arrayCreditCards[0]['holder_name'] ?></p>
                <div class="credit-choice-flex">
                    <p><?php echo $arrayCreditCards[0]['card_number'] ?></p>
                    <p>有効期限<?php echo $arrayCreditCards[0]['expiration_date'] ?></p>
                </div>

            </div>
            <!-- ========= 将来的に実装予定 ========= -->
            <!-- <p class="credit-summary">ご利用ポイント</p>
            <p class="point-choice">一部利用する。(今はテキストで入れる)</p> -->
            <!-- ========= 将来的に実装予定 end========= -->
            <div class="select-btn">
                <a href="" class="cancel-button button">キャンセル</a>
                <a href="" class="accept-button button">決定</a>
            </div>
        </div>
    </div>
</section>
