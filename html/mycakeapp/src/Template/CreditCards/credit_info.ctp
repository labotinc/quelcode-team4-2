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
<?= $this->Html->link(
        '削除',
        ['controller' => 'CreditCards', 'action' => 'add', 1], //****** リンク要確認 ひとまずクレジットカードid「1」*/
        ['class' => 'link-button__small']
    );
    ?>
    <?= $this->Html->link(
        '編集',
        ['controller' => 'CreditCards', 'action' => 'edit', 1], //****** リンク要確認 同上*/
        ['class' => 'link-button__middle']
    );
    ?>
</section>