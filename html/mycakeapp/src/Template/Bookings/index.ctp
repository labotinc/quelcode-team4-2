<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking[]|\Cake\Collection\CollectionInterface $bookings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Booking'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bookings index large-9 medium-8 columns content">
    <h3><?= __('Bookings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('schedule_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seat_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_cancelled') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= $this->Number->format($booking->id) ?></td>
                <td><?= $booking->has('user') ? $this->Html->link($booking->user->id, ['controller' => 'Users', 'action' => 'view', $booking->user->id]) : '' ?></td>
                <td><?= $this->Number->format($booking->schedule_id) ?></td>
                <td><?= h($booking->seat_number) ?></td>
                <td><?= h($booking->is_cancelled) ?></td>
                <td><?= h($booking->created) ?></td>
                <td><?= h($booking->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $booking->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $booking->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id)]) ?>
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
