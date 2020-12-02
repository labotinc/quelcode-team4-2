<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MovieInfo $booking
 */
?>
<?= $this->Html->css('moviesinfo', ['block' => true]); ?>
<section class="h1">
  <h1>予約情報</h1>
</section>
<section class="form-container">
  <p class="text-registration-completed">予約をキャンセルしました。</p>
  <?= $this->Html->link(
    'マイページに戻る',
    ['controller' => 'MoviesInfo', 'action' => 'mypage', $user_id], //****** リンク要確認 */
    ['class' => 'link-button']
  );
  ?>
</section>
