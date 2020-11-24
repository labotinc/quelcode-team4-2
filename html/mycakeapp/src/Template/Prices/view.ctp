<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Price $price
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Price'), ['action' => 'edit', $price->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Price'), ['action' => 'delete', $price->id], ['confirm' => __('Are you sure you want to delete # {0}?', $price->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Prices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="prices view large-9 medium-8 columns content">
    <h3><?= h($price->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($price->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($price->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($price->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($price->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($price->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Applied') ?></th>
            <td><?= $price->is_applied ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
