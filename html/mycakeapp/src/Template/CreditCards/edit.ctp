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
    <?php
    echo $this->Form->control('card_number', ['label' => false, 'class' => 'card_number']);
    echo $this->Form->control('holder_name', ['label' => false, 'class' => 'holder_name']);
    ?>
    <div class="flexbox">
        <?php
        echo $this->Form->control('expiration_date', ['label' => false, 'class' => 'expiration_date']);
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
    <?= $this->Form->button(__('編集'), ['class' => 'submit-button edit']) ?>
    <?= $this->Form->end() ?>
</section>
