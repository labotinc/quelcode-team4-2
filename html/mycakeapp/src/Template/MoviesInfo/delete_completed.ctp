<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MovieInfo $booking
 */
?>
<?= $this->Html->css('moviesinfo', ['block' => true]); ?>
<section class="h1">
</section>
<section class="form-container">
  <p class="text-registration-completed">予約をキャンセルしました。</p>
  <?= $this->Html->link(
    'マイページに戻る',
    ['class' => 'link-button']
  );
  ?>
</section>
