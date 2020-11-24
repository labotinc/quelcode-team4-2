<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PaymentHistory[]|\Cake\Collection\CollectionInterface $paymentHistories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Payment History'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Credit Cards'), ['controller' => 'CreditCards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Credit Card'), ['controller' => 'CreditCards', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Prices'), ['controller' => 'Prices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price'), ['controller' => 'Prices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Discounts'), ['controller' => 'Discounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Discount'), ['controller' => 'Discounts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Taxes'), ['controller' => 'SalesTaxes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Tax'), ['controller' => 'SalesTaxes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="paymentHistories index large-9 medium-8 columns content">
    <h3><?= __('Payment Histories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('booking_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('credit_card_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('discount_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_tax_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_cancelled') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_request_created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($paymentHistories as $paymentHistory): ?>
            <tr>
                <td><?= $this->Number->format($paymentHistory->id) ?></td>
                <td><?= $paymentHistory->has('booking') ? $this->Html->link($paymentHistory->booking->id, ['controller' => 'Bookings', 'action' => 'view', $paymentHistory->booking->id]) : '' ?></td>
                <td><?= $this->Number->format($paymentHistory->credit_card_id) ?></td>
                <td><?= $this->Number->format($paymentHistory->price_id) ?></td>
                <td><?= $this->Number->format($paymentHistory->discount_id) ?></td>
                <td><?= $this->Number->format($paymentHistory->sales_tax_id) ?></td>
                <td><?= h($paymentHistory->is_cancelled) ?></td>
                <td><?= h($paymentHistory->payment_request_created) ?></td>
                <td><?= h($paymentHistory->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $paymentHistory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $paymentHistory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $paymentHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentHistory->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
