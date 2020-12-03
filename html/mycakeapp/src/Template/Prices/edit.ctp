<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Price $price
 */
?>
<?php
// 料金項目のグループリスト
$select_list = [
    ['text' => '一般', 'value' => '一般'],
    ['text' => '大学生', 'value' => '大学生'],
    ['text' => '大学生', 'value' => '大学生'],
    ['text' => '小中学生', 'value' => '小中学生'],
    ['text' => '幼児（３歳以上）', 'value' => '幼児（３歳以上）'],
    ['text' => 'その他', 'value' => 'その他'],
]
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $price->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $price->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Prices'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="prices form large-9 medium-8 columns content">
    <?= $this->Form->create($price) ?>
    <fieldset>
        <legend><?= __('Edit Price') ?></legend>
        <?php
        echo $this->Form->control(
            'name',
            ['options' => $select_list]
        );
        echo $this->Form->control('price');
        echo $this->Form->control('is_applied');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
