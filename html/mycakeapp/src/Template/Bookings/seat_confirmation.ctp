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
        <?= h($booking->movie_schedule->screening_start_datetime->format('m月d日')); ?>
        <?= '(', h($booking->movie_schedule->screening_start_week), ')', PHP_EOL; ?>
      </p>
      <p class="movie content">
        <?= h($booking->movie_schedule->screening_start_datetime->format('H:i')), ' ~'; ?>
        <?= h($booking->movie_schedule->screening_start_datetime
          ->addMinutes($movie_info->total_minutes_with_trailer) // 終了時間計算
          ->format('H:i'));
        ?>
      </p>
      <div class="movie title">座席番号</div>
      <p class="movie content"><?= h($booking->seat_number) ?></p>
      <div class="user title">性別（割引のための情報となります）</div>
      <p class="user content"><?= h($booking->user->user_sex) ?></p>
      <div class="user title">誕生日（割引のための情報となります）</div>
      <p class="user content"><?= h($booking->user->user_birthdate) ?></p>
      <!-- 今後の仕様変更によってボタンのURLを変更します -->
      <a href="<?= $this->Url->build(['action' => 'seat_cancel', $booking['id']]) ?>" class="cancel-button button">キャンセル</a>
      <a href="<?= $this->Url->build(['controller' => 'PaymentHistories', 'action' => 'choose_card', $booking['id']]) ?>" class="accept-button button">決定</a>
    </div>
  </div>
</section>
