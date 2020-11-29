<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CreditCard $creditCard
 */
?>
<?= $this->Html->css('credit', ['block' => true]); ?>
<?= $this->Html->script('credit', ['block' => true]); ?>
<section class="h1">
    <h1>決済情報</h1>
</section>
<section class="form-container">
    <!-- ここにクレジットカード情報出す -->
    <div class="info-container">
        <?= $this->Form->create(); ?>
        <!-- labelと値の配列を作成し、ラジオボタンを作成する -->
        <?php foreach ($info as $key) {
            $options[] = ['text' => $key['card_number'] . '：' . $key['holder_name'], 'value' => $key['id']];
        }
        echo $this->Form->radio('Credit.id', $options);
        ?>
    </div>
    <div class="button-container">
        <?= $this->Form->button(
            '削除',
            ['class' => 'link-button__small', 'id' => 'delete_send', 'name' => 'delete']
        );
        ?>
        <?= $this->Form->button(
            '編集',
            ['class' => 'link-button__middle', 'name' => 'edit']
        );
        ?>
        <?= $this->Form->end() ?>
    </div>
</section>