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
<section class="form-container edit-container">
    <?= $this->Form->create($creditCard, ['class' => 'forms', 'novalidate']) ?>
    <fieldset>
        <div class="flex">
            <?php
            echo $this->Form->control('card_number', ['label' => 'クレジットカード番号(半角数字16桁)', 'placeholder' => 'ex.1234567890123456', 'class' => 'card_number']);
            echo $this->Html->image('visa.png', ['class' => 'visa']);
            echo $this->Html->image('master.png', ['class' => 'master']);
            ?>
            </div>
            <?= $this->Form->control('holder_name', ['label' => 'クレジットカード名義(半角文字のみ。姓名の間に半角スペース)', 'placeholder' => 'ex.Taro Yamada', 'class' => 'holder_name']);?>
        <div class="flexbox">
            <?php
            echo $this->Form->control('expiration_date', ['label' => '有効期限(月と西暦下2桁)', 'placeholder' => 'ex.0724', 'class' => 'expiration_date']);
            echo $this->Form->control('security_code', ['label' => 'セキュリティコード(半角数字)', 'class' => 'security_code']);
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