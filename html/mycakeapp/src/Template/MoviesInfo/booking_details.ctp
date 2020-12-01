<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MovieInfo $booking
 */
?>
<?= $this->Flash->render(); ?>
<?= $this->Html->script('booking_delete', ['block' => true]); ?>
<?= $this->Html->css('moviesinfo', ['block' => true]); ?>
<section>
  <div class="movie-info-wrap">
    <h1 class="heading">予約詳細</h1>

    <div class="wrapper booking-main">
      <h2 class="booking-type">決済済のご予約</h2>
      <?php if (is_null($booked_main_details)) : ?>
        <div class="non-main-booking">現在予約はありません</div>
      <?php else : ?>
        <?php foreach ($booked_main_details as $booked_main_detail) : ?>
          <div class="booking-detail">
            <?= $this->Html->image(
              $booked_main_detail['thumbnail_path'],
              ['class' => 'thumbnail', 'alt' => h($booked_main_detail['movie_title'])]
            ) ?>
            <div class="detail-contents">
              <p class="detail title"><?= h($booked_main_detail['movie_title']) ?></p>
              <p class="detail datetime-screening-seat">
                <?= h($booked_main_detail['screening_date']) ?>
                <?= '(' . h($booked_main_detail['screening_week']) . ')' ?>
                <?= h($booked_main_detail['screening_start_time']), '~' ?>
                <?= h($booked_main_detail['screening_end_time']) ?>
                <?= h($booked_main_detail['seat_number']) ?>
              </p>
              <p class="detail price"><?= '&yen;', h($booked_main_detail['total_price']) ?></p>
              <?php if (h($booked_main_detail['discount_name'] !== '割引きなし')) : ?>
                <p class="detail discount"><?= h($booked_main_detail['discount_name']) ?></p>
              <?php endif; ?>
            </div>
            <div class="cancel-button">
              <a class="delete_send">キャンセル</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="wrapper booking-temporary">
      <h2 class="booking-type">未決済のご予約（15分以内に決済がご確認できない際にはキャンセル扱いとなります。）</h2>
      <?php if (is_null($booked_temporary_details)) : ?>
        <div class="non-main-booking">現在予約はありません</div>
      <?php else : ?>
        <?php foreach ($booked_temporary_details as $booked_temporary_detail) : ?>
          <div class="booking-detail">
            <?= $this->Html->image(
              $booked_temporary_detail['thumbnail_path'],
              ['class' => 'thumbnail', 'alt' => h($booked_temporary_detail['movie_title'])]
            ) ?>
            <div class="detail-contents">
              <p class="detail title"><?= h($booked_temporary_detail['movie_title']) ?></p>
              <p class="detail datetime-screening-seat">
                <?= h($booked_temporary_detail['screening_date']) ?>
                <?= '(' . h($booked_temporary_detail['screening_week']) . ')' ?>
                <?= h($booked_temporary_detail['screening_start_time']), '~' ?>
                <?= h($booked_temporary_detail['screening_end_time']) ?>
                <?= h($booked_temporary_detail['seat_number']) ?>
              </p>
            </div>
            <div class="procedures">
              <div class="cancel-button">
                <?= $this->Form->postButton('キャンセル', [$booked_temporary_detail['id']], ['class' => 'cancel-send']) ?>
                <button class="cancel-send">キャンセル</button>
              </div>
              <!-- 基本設計書P51に遷移 -->
              <div class="payment-button-wrapper">
                <div class="payment-button">
                  <?= $this->Html->link(
                    '決済情報入力',
                    // 決済情報に必要な値を取得する（ユーザーidなど）
                    ['controller' => 'booking', 'action' => '決済情報'],
                    ['class' => 'payment-send']
                  ) ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </div>
</section>
