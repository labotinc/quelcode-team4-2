<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Movie[]|\Cake\Collection\CollectionInterface $movies
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Movie'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Movie Schedules'), ['controller' => 'MovieSchedules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movie Schedules'), ['controller' => 'MovieSchedules', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bookings'), ['controller' => 'Bookings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="movies index large-9 medium-8 columns content">
    <h3><?= __('Movies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('thumbnail_path') ?></th>
                <th scope="col"><?= $this->Paginator->sort('thumbnail') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_minutes_with_trailer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('screening_start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('screening_end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_screened') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie) : ?>
                <tr>
                    <td><?= $this->Number->format($movie->id) ?></td>
                    <td><?= h($movie->title) ?></td>
                    <td><?= h($movie->thumbnail_path) ?></td>
                    <td><?= $this->Html->image(
                            $movie->thumbnail_path,
                            array(
                                'width' => '200',
                                'height' => '100',
                                'alt' => h($movie->thumbnail_path)
                            )
                        ); ?></td>
                    <td><?= $this->Number->format($movie->total_minutes_with_trailer) ?></td>
                    <td><?= h($movie->screening_start_date) ?></td>
                    <td><?= h($movie->screening_end_date) ?></td>
                    <td><?= h($movie->is_screened) ?></td>
                    <td><?= h($movie->created) ?></td>
                    <td><?= h($movie->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $movie->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $movie->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $movie->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movie->id)]) ?>
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
