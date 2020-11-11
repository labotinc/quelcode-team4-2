<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Movie $movie
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Movies'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="movies form large-9 medium-8 columns content">
    <?= $this->Form->create($movie) ?>
    <fieldset>
        <legend><?= __('Add Movie') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('thumbnail_path');
            echo $this->Form->control('total_minutes_with_trailer');
            echo $this->Form->control('screening_start_date');
            echo $this->Form->control('screening_end_date');
            echo $this->Form->control('is_screened');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
