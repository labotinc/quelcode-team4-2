<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PaymentHistory $paymentHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Payment History'), ['action' => 'edit', $paymentHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Payment History'), ['action' => 'delete', $paymentHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Payment Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Credit Cards'), ['controller' => 'CreditCards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Credit Card'), ['controller' => 'CreditCards', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Prices'), ['controller' => 'Prices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price'), ['controller' => 'Prices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Discounts'), ['controller' => 'Discounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Discount'), ['controller' => 'Discounts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Taxes'), ['controller' => 'SalesTaxes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Tax'), ['controller' => 'SalesTaxes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="paymentHistories view large-9 medium-8 columns content">
    <h3><?= h($paymentHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Booking') ?></th>
            <td><?= $paymentHistory->has('booking') ? $this->Html->link($paymentHistory->booking->id, ['controller' => 'Bookings', 'action' => 'view', $paymentHistory->booking->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($paymentHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Credit Card Id') ?></th>
            <td><?= $this->Number->format($paymentHistory->credit_card_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Id') ?></th>
            <td><?= $this->Number->format($paymentHistory->price_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount Id') ?></th>
            <td><?= $this->Number->format($paymentHistory->discount_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Tax Id') ?></th>
            <td><?= $this->Number->format($paymentHistory->sales_tax_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Request Created') ?></th>
            <td><?= h($paymentHistory->payment_request_created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($paymentHistory->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Cancelled') ?></th>
            <td><?= $paymentHistory->is_cancelled ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Credit Cards') ?></h4>
        <?php if (!empty($paymentHistory->credit_cards)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Card Number') ?></th>
                <th scope="col"><?= __('Holder Name') ?></th>
                <th scope="col"><?= __('Expiration Date') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($paymentHistory->credit_cards as $creditCards): ?>
            <tr>
                <td><?= h($creditCards->id) ?></td>
                <td><?= h($creditCards->user_id) ?></td>
                <td><?= h($creditCards->card_number) ?></td>
                <td><?= h($creditCards->holder_name) ?></td>
                <td><?= h($creditCards->expiration_date) ?></td>
                <td><?= h($creditCards->is_deleted) ?></td>
                <td><?= h($creditCards->created) ?></td>
                <td><?= h($creditCards->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CreditCards', 'action' => 'view', $creditCards->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CreditCards', 'action' => 'edit', $creditCards->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CreditCards', 'action' => 'delete', $creditCards->id], ['confirm' => __('Are you sure you want to delete # {0}?', $creditCards->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Prices') ?></h4>
        <?php if (!empty($paymentHistory->prices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Is Applied') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($paymentHistory->prices as $prices): ?>
            <tr>
                <td><?= h($prices->id) ?></td>
                <td><?= h($prices->name) ?></td>
                <td><?= h($prices->price) ?></td>
                <td><?= h($prices->is_applied) ?></td>
                <td><?= h($prices->created) ?></td>
                <td><?= h($prices->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Prices', 'action' => 'view', $prices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Prices', 'action' => 'edit', $prices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Prices', 'action' => 'delete', $prices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Discounts') ?></h4>
        <?php if (!empty($paymentHistory->discounts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Is Applied') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($paymentHistory->discounts as $discounts): ?>
            <tr>
                <td><?= h($discounts->id) ?></td>
                <td><?= h($discounts->name) ?></td>
                <td><?= h($discounts->price) ?></td>
                <td><?= h($discounts->is_applied) ?></td>
                <td><?= h($discounts->created) ?></td>
                <td><?= h($discounts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Discounts', 'action' => 'view', $discounts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Discounts', 'action' => 'edit', $discounts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Discounts', 'action' => 'delete', $discounts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $discounts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Sales Taxes') ?></h4>
        <?php if (!empty($paymentHistory->sales_taxes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Is Applied') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($paymentHistory->sales_taxes as $salesTaxes): ?>
            <tr>
                <td><?= h($salesTaxes->id) ?></td>
                <td><?= h($salesTaxes->rate) ?></td>
                <td><?= h($salesTaxes->is_applied) ?></td>
                <td><?= h($salesTaxes->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SalesTaxes', 'action' => 'view', $salesTaxes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SalesTaxes', 'action' => 'edit', $salesTaxes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SalesTaxes', 'action' => 'delete', $salesTaxes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesTaxes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
