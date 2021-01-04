<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesTax $salesTax
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sales Tax'), ['action' => 'edit', $salesTax->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sales Tax'), ['action' => 'delete', $salesTax->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesTax->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sales Taxes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Tax'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="salesTaxes view large-9 medium-8 columns content">
    <h3><?= h($salesTax->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($salesTax->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($salesTax->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($salesTax->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Applied') ?></th>
            <td><?= $salesTax->is_applied ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
