<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesTax $salesTax
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $salesTax->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $salesTax->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sales Taxes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="salesTaxes form large-9 medium-8 columns content">
    <?= $this->Form->create($salesTax) ?>
    <fieldset>
        <legend><?= __('Edit Sales Tax') ?></legend>
        <?php
            echo $this->Form->control('rate');
            echo $this->Form->control('is_applied');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
