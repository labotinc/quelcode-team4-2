<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Movie $movie
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $movie->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $movie->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Movies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Movie Schedules'), ['controller' => 'MovieSchedules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movie Schedules'), ['controller' => 'MovieSchedules', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="movies form large-9 medium-8 columns content">
    <?= $this->Form->create($movie, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit Movie') ?></legend>
        <?php
        echo $this->Form->control('title', ['label' => '映画タイトル']);
        echo $this->Form->control(
            'thumbnail_path',
            [
                'type' => 'file',
                'label' => 'サムネイル画像 ※有効ファイル形式：jpg jpeg png'
            ]
        );
        echo $this->Form->control('total_minutes_with_trailer', ['label' => '予告編含む上映時間（分）']);
        // 上映開始日、終了日ともに入力可能な日付は誤造作の修正も考慮して前後5年（初期値）
        echo $this->Form->control(
            'screening_start_date',
            [
                'label' => '上映開始日',
                'monthNames' => false
            ]
        );
        echo $this->Form->control('screening_end_date', [
            'label' => '上映終了日',
            'monthNames' => false
        ]);
        echo $this->Form->control('is_screened', ['label' => '上映中']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
