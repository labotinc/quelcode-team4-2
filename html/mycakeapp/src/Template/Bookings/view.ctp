<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Booking'), ['action' => 'edit', $booking->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Booking'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bookings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Movie Schedules'), ['controller' => 'MovieSchedules', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Movie Schedule'), ['controller' => 'MovieSchedules', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bookings view large-9 medium-8 columns content">
    <h3><?= h($booking->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $booking->has('user') ? $this->Html->link($booking->user->id, ['controller' => 'Users', 'action' => 'view', $booking->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Schedule Id') ?></th>
            <td><?= $this->Number->format($booking->schedule_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seat Number') ?></th>
            <td><?= h($booking->seat_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($booking->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($booking->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($booking->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Cancelled') ?></th>
            <td><?= $booking->is_cancelled ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Main Booked') ?></th>
            <td><?= $booking->is_main_booked ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
