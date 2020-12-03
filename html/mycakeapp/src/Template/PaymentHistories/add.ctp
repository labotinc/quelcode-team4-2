<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PaymentHistory $paymentHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Payment Histories'), ['action' => 'index']) ?></li>
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
<div class="paymentHistories form large-9 medium-8 columns content">
    <?= $this->Form->create($paymentHistory) ?>
    <fieldset>
        <legend><?= __('Add Payment History') ?></legend>
        <?php
        echo $this->Form->control('booking_id', ['options' => $bookings]);
        echo $this->Form->control('credit_card_id', ['options' => $credit_cards]);
        echo $this->Form->control('price_id', ['options' => $prices]);
        echo $this->Form->control('discount_id', ['options' => $discounts]);
        echo $this->Form->control('sales_tax_id', ['options' => $sales_taxes]);
        echo $this->Form->control('is_cancelled',);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
