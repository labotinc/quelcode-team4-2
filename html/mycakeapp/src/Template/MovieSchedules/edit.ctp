<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MovieSchedule $movieSchedule
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $movieSchedule->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $movieSchedule->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Movie Schedules'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Movies'), ['controller' => 'Movies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movie'), ['controller' => 'Movies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="movieSchedules form large-9 medium-8 columns content">
    <?= $this->Form->create($movieSchedule) ?>
    <fieldset>
        <legend><?= __('Edit Movie Schedule') ?></legend>
        <?php
            echo $this->Form->control('movie_id', ['options' => $movies]);
            echo $this->Form->control('screening_start_datetime');
            echo $this->Form->control('is_playable');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
