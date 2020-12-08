<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MovieInfo $booking
 */
?>
<?= $this->Flash->render(); ?>
<?= $this->Html->script('booking_delete', ['block' => true]); ?>
<?= $this->Html->script('jquery.min.js', ['block' => true]) ?>
<?= $this->Html->css('moviesinfo', ['block' => true]); ?>
<section>
  <div class="movie-info-wrap">
    <h1 class="heading">予約詳細</h1>

    <div class="wrapper booking-main">
      <h2 class="booking-type">決済が完了しているご予約</h2>
      <?php if (empty($booked_main_details)) : ?>
        <div class="non-main-booking">現在決済が完了しているご予約はありません</div>
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
            <div class="cancel-button main">
              <?= $this->Form->create() ?>
              <fieldset>
                <?= $this->Form->hidden('booking_id', ['value' => $booked_main_detail['id']]) ?>
                <?= $this->Form->hidden('payment_id', ['value' => $booked_main_detail['payment_id']]) ?>
              </fieldset>
              <?= $this->Form->end() ?>
              <?= $this->Form->button(
                'キャンセル',
                ['class' => 'link-button__small', 'id' => 'cancel-send-main', 'name' => 'cancel']
              ); ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <!-- アクション先未定 -->
      <?= $this->Html->link('マイページへ戻る', ['controller' => 'MoviesInfo', 'action' => 'mypage'], ['class' => 'button']) ?>
    </div>

    <div class="wrapper booking-temporary">
      <h2 class="booking-type">未決済のご予約（15分以内に決済がご確認できない際にはキャンセル扱いとなります。）</h2>
      <?php if (empty($booked_temporary_details)) : ?>
        <div class="non-main-booking">現在未決済の予約はありません</div>
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
              <div class="payment-button-wrapper">
                <div class="payment-button">
                  <?= $this->Html->link(
                    '決済情報入力',
                    // 決済情報に必要な値を取得する（ユーザーidなど）
                    ['controller' => 'PaymentHistories', 'action' => 'choose_card', $booked_temporary_detail['id']],
                    ['class' => 'payment-send']
                  ) ?>
                </div>
              </div>
              <div class="cancel-button temporary">
                <?= $this->Form->create() ?>
                <fieldset>
                  <?= $this->Form->hidden('booking_id', ['value' => $booked_temporary_detail['id']]) ?>
                </fieldset>
                <?= $this->Form->end() ?>
                <?= $this->Form->button(
                  'キャンセル',
                  ['class' => 'link-button__small', 'id' => 'cancel-send-temporary', 'name' => 'cancel']
                ); ?>
              </div>
              <!-- 基本設計書P51に遷移 -->

            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <!-- アクション先未定 -->
      <?= $this->Html->link(
        'マイページへ戻る',
        ['controller' => 'MoviesInfo', 'action' => 'mypage'],
        ['class' => 'button']
      ) ?>

    </div>
  </div>
</section>
