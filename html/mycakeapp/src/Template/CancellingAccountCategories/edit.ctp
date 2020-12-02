<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CancellingAccountCategory $cancellingAccountCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cancellingAccountCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cancellingAccountCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cancelling Account Categories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cancellingAccountCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($cancellingAccountCategory) ?>
    <fieldset>
        <legend><?= __('Edit Cancelling Account Category') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
