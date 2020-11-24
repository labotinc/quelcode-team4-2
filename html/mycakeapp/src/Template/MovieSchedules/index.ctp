<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MovieSchedule[]|\Cake\Collection\CollectionInterface $movieSchedules
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Movie Schedule'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Movies'), ['controller' => 'Movies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movie'), ['controller' => 'Movies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bookings'), ['controller' => 'Bookings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="movieSchedules index large-9 medium-8 columns content">
    <h3><?= __('Movie Schedules') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('movie_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('screening_start_datetime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_playable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movieSchedules as $movieSchedule) : ?>
                <tr>
                    <td><?= $this->Number->format($movieSchedule->id) ?></td>
                    <td><?= $movieSchedule->has('movie') ? $this->Html->link($movieSchedule->movie->title, ['controller' => 'Movies', 'action' => 'view', $movieSchedule->movie->id]) : '' ?></td>
                    <td><?= h($movieSchedule->screening_start_datetime) ?></td>
                    <td><?= h($movieSchedule->is_playable) ?></td>
                    <td><?= h($movieSchedule->created) ?></td>
                    <td><?= h($movieSchedule->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $movieSchedule->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $movieSchedule->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $movieSchedule->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movieSchedule->id)]) ?>
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
