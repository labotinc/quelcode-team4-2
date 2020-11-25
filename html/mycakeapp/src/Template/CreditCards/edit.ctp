<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CreditCard $creditCard
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $creditCard->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $creditCard->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Credit Cards'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Payment Histories'), ['controller' => 'PaymentHistories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment History'), ['controller' => 'PaymentHistories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="creditCards form large-9 medium-8 columns content">
    <?= $this->Form->create($creditCard) ?>
    <fieldset>
        <legend><?= __('Edit Credit Card') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('card_number');
            echo $this->Form->control('holder_name');
            echo $this->Form->control('expiration_date');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
