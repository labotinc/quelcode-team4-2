<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MovieSchedule $movieSchedule
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Movie Schedules'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Movies'), ['controller' => 'Movies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movie'), ['controller' => 'Movies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="movieSchedules form large-9 medium-8 columns content">
    <?= $this->Form->create($movieSchedule) ?>
    <fieldset>
        <legend><?= __('映画スケジュールを追加') ?></legend>
        <?php
        echo $this->Form->control('movie_id', ['options' => $movies, 'label' => '映画を選択する']);
        echo $this->Form->control('screening_start_datetime', ['label' => '映画の上映開始時間を選択する']);
        echo $this->Form->label('is_playable', '上映可不可を選択する');
        echo $this->Form->radio(
            'is_playable',
            [
                ['value' => 1, 'text' => '上映可能'],
                ['value' => 0, 'text' => '上映不可能', 'selected']

            ]
        );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>