<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CancellingAccountHistory $cancellingAccountHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cancelling Account History'), ['action' => 'edit', $cancellingAccountHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cancelling Account History'), ['action' => 'delete', $cancellingAccountHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cancellingAccountHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cancelling Account Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cancelling Account History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cancellingAccountHistories view large-9 medium-8 columns content">
    <h3><?= h($cancellingAccountHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $cancellingAccountHistory->has('user') ? $this->Html->link($cancellingAccountHistory->user->id, ['controller' => 'Users', 'action' => 'view', $cancellingAccountHistory->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cancellingAccountHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cancelling Category Id') ?></th>
            <td><?= $this->Number->format($cancellingAccountHistory->cancelling_category_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cancelled') ?></th>
            <td><?= h($cancellingAccountHistory->cancelled) ?></td>
        </tr>
    </table>
</div>
