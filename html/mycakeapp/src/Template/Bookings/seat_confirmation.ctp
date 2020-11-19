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
    <div class="confirmation-container">
      <div class="movie title">タイトル</div>
      <p class="movie content"><?= h($movie_info->title) ?></p>
      <div class="movie title">上映時間</div>
      <p class="movie content">
        <?=
          // movie_infoページの公開時間を利用する
          // 今はそのデータがないので現状は映画公開時間のみ記載しておきます
          h($booking->movie_schedule->screening_start_datetime);
        ?>
      </p>
      <div class="movie title">座席番号</div>
      <p class="movie content"><?= h($booking->seat_number) ?></p>
      <div class="user title">性別（割引のための情報となります）</div>
      <p class="user content"><?= h($authuser->user_sex) ?></p>
      <div class="user title">誕生日（割引のための情報となります）</div>
      <p class="user content"><?= h($authuser->user_birthdate) ?></p>
      <!-- 今後の仕様変更によってボタンのURLを変更します -->
      <a href="<?= $this->Url->build(['action' => 'seat_cancel', $booking['id']]) ?>" class="cancel-button button">キャンセル</a>
      <a href="<?= $this->Url->build(['controller' => 'payment', 'action' => 'index']) ?>" class="accept-button button">決定</a>
    </div>
  </div>
</section>
