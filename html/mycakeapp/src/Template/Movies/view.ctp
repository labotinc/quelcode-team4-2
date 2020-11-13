<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Movie $movie
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Movie'), ['action' => 'edit', $movie->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Movie'), ['action' => 'delete', $movie->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movie->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Movies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Movie'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Movie Schedules'), ['controller' => 'MovieSchedules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movie Schedules'), ['controller' => 'MovieSchedules', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="movies view large-9 medium-8 columns content">
    <h3><?= h($movie->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($movie->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thumbnail Path') ?></th>
            <td><?= h($movie->thumbnail_path) ?></td>
        </tr>
        <tr>
            <!-- サムネイルを表示（大きさは実画像を元に変更予定） -->
            <th scope="row"><?= __('Thumbnail') ?></th>
            <td><?= $this->Html->image(
                    "MovieThumbnails/" . pathinfo($movie->thumbnail_path, PATHINFO_BASENAME),
                    array(
                        'width' => '300',
                        'height' => '200',
                        'alt' => h($movie->thumbnail_path)
                    )
                ); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($movie->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Minutes With Trailer') ?></th>
            <td><?= $this->Number->format($movie->total_minutes_with_trailer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Screening Start Date') ?></th>
            <td><?= h($movie->screening_start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Screening End Date') ?></th>
            <td><?= h($movie->screening_end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($movie->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($movie->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Screened') ?></th>
            <td><?= $movie->is_screened ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
