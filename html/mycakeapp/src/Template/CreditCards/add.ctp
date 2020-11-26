<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CreditCard $creditCard
 */
?>
<?= $this->Html->css('credit', ['block' => true]); ?>
<section class="h1">
    <h1>決済情報</h1>
</section>
<section class="form-container">
    <?= $this->Form->create($creditCard, ['class' => 'forms', 'novalidate']) ?>
    <fieldset>
        <?php
        // ユーザーidも送信するの忘れない is_deletedはデフォルト値があるからむし
        echo $this->Form->control('card_number', ['label' => false, 'placeholder' => 'クレジットカード番号', 'class' => 'card_number']);
        echo $this->Form->control('holder_name', ['label' => false, 'placeholder' => 'クレジットカード名義', 'class' => 'holder_name']);
        ?>
        <div class="flexbox">
            <?php
            echo $this->Form->control('expiration_date', ['label' => false, 'placeholder' => '有効期限', 'class' => 'expiration_date']);
            echo $this->Form->control('security_code', ['label' => false, 'placeholder' => 'セキュリティコード', 'class' => 'security_code']);
            ?>
        </div>
        <?= $this->Form->control('confirm', [
            'label' =>
            [
                'text' => '利用規約・プライバシーポリシーに同意の上、ご確認ください。',
                'class' => 'label_confirm'
            ],
            'type' => 'checkbox'
        ]); ?>
    </fieldset>
    <?= $this->Form->button(__('登録'), ['class' => 'submit-button']) ?>
    <?= $this->Form->end() ?>
</section>
