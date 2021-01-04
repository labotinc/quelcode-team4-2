<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CreditCard $creditCard
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Credit Card'), ['action' => 'edit', $creditCard->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Credit Card'), ['action' => 'delete', $creditCard->id], ['confirm' => __('Are you sure you want to delete # {0}?', $creditCard->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Credit Cards'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Credit Card'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Payment Histories'), ['controller' => 'PaymentHistories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment History'), ['controller' => 'PaymentHistories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="creditCards view large-9 medium-8 columns content">
    <h3><?= h($creditCard->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $creditCard->has('user') ? $this->Html->link($creditCard->user->id, ['controller' => 'Users', 'action' => 'view', $creditCard->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Card Number') ?></th>
            <td><?= h($creditCard->card_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Holder Name') ?></th>
            <td><?= h($creditCard->holder_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expiration Date') ?></th>
            <td><?= h($creditCard->expiration_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($creditCard->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($creditCard->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($creditCard->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $creditCard->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
