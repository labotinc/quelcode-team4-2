<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MovieSchedule $movieSchedule
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Movie Schedule'), ['action' => 'edit', $movieSchedule->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Movie Schedule'), ['action' => 'delete', $movieSchedule->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movieSchedule->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Movie Schedules'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Movie Schedule'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Movies'), ['controller' => 'Movies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Movie'), ['controller' => 'Movies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="movieSchedules view large-9 medium-8 columns content">
    <h3><?= h($movieSchedule->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Movie') ?></th>
            <td><?= $movieSchedule->has('movie') ? $this->Html->link($movieSchedule->movie->title, ['controller' => 'Movies', 'action' => 'view', $movieSchedule->movie->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($movieSchedule->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Screening Start Datetime') ?></th>
            <td><?= h($movieSchedule->screening_start_datetime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($movieSchedule->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($movieSchedule->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Playable') ?></th>
            <td><?= $movieSchedule->is_playable ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
