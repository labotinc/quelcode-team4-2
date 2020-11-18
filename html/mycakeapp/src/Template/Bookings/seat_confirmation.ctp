<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<?= $this->Html->css('bookings', ['block' => true]); ?>
<section>
  <h1 class="heading">予約確認</h1>
  <div class="wrapper">
    <div class="container">
      <div class="movie info">タイトル</div>
      <p><?= h($movie_info->title) ?></p>
      <div class="movie info">上映時間</div>
      <p>
        <?=
          // movie_infoページの公開時間を利用する
          // 今はそのデータがないので現状は映画公開時間のみ記載しておきます
          h($booking->movie_schedule->screening_start_datetime);
        ?>
      </p>
      <div class="movie info">座席番号</div>
      <p><?= h($booking->seat_number) ?></p>
      <div class="user info">性別（割引のための情報となります）</div>
      <p><?= h($authuser->user_sex) ?></p>
      <div class="user info">誕生日（割引のための情報となります）</div>
      <p><?= h($authuser->user_birthdate) ?></p>
      <!-- 今後の仕様変更によってはボタンを変更します -->
      <?= $this->Html->link('キャンセル', ['action' => 'add_seat'], ['class' => 'cancel-button']) ?>
      <?= $this->Html->link('決定', ['controller' => 'payment', 'action' => 'index'], ['class' => 'accept-button']) ?>
    </div>
  </div>
</section>
