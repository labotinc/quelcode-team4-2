<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CancellingAccountCategory $cancellingAccountCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cancelling Account Category'), ['action' => 'edit', $cancellingAccountCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cancelling Account Category'), ['action' => 'delete', $cancellingAccountCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cancellingAccountCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cancelling Account Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cancelling Account Category'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cancellingAccountCategories view large-9 medium-8 columns content">
    <h3><?= h($cancellingAccountCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($cancellingAccountCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cancellingAccountCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($cancellingAccountCategory->created) ?></td>
        </tr>
    </table>
</div>
