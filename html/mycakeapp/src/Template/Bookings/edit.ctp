<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $booking->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Bookings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Movie Schedules'), ['controller' => 'MovieSchedules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movie Schedule'), ['controller' => 'MovieSchedules', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bookings form large-9 medium-8 columns content">
    <?= $this->Form->create($booking) ?>
    <fieldset>
        <legend><?= __('Edit Booking') ?></legend>
        <?php
        echo $this->Form->control('user_id', ['options' => $users]);
        echo $this->Form->control('schedule_id');
        echo $this->Form->control('seat_number');
        echo $this->Form->control('is_cancelled');
        echo $this->Form->control('is_main_booked');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
