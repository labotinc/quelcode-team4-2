<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CancellingAccountHistory $cancellingAccountHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cancellingAccountHistory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cancellingAccountHistory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cancelling Account Histories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cancellingAccountHistories form large-9 medium-8 columns content">
    <?= $this->Form->create($cancellingAccountHistory) ?>
    <fieldset>
        <legend><?= __('Edit Cancelling Account History') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('cancelling_category_id');
            echo $this->Form->control('cancelled');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
