<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MovieInfo $booking
 */
?>
<?= $this->Flash->render(); ?>
<?= $this->Html->css('moviesinfo.css', ['block' => true]); ?>
<section>
  <div class="movie-info-wrap">
    <h1 class="heading">予約詳細</h1>

    <div class="wrapper booking-main">

      <h2 class="booking-type">決済済のご予約</h2>

      <?php foreach ($booked_main_details as $booked_main_detail) : ?>
        <div class="booking-detail">
          <?= $this->Html->image(
            $booked_main_detail['thumbnail_path'],
            ['width' => '96', 'height' => '128', 'alt' => h($booked_main_detail['thumbnail_path'])]
          ) ?>
          <?= h($booked_main_detail['movie_title']) ?>
          <?= h($booked_main_detail['screening_start_time']) ?>
          <?= h($booked_main_detail['screening_end_time']) ?>
          <?= h($booked_main_detail['seat_number']) ?>
          <?= h($booked_main_detail['discount_name']) ?>
          <?= h($booked_main_detail['total_price']) ?>
        </div>
      <?php endforeach; ?>



    </div>
    <div class="wrapper booking-temporary">
      <h2 class="booking-type">未決済のご予約（ご予約から15分以内に決済いただけない場合は、キャンセル扱いとなります。）</h2>
      <?php foreach ($booked_temporary_details as $booked_temporary_detail) : ?>
        <div class="booking-detail">
          <?= $this->Html->image(
            $booked_temporary_detail['thumbnail_path'],
            ['width' => '96', 'height' => '128', 'alt' => h($booked_temporary_detail['thumbnail_path'])]
          ) ?>
          <?= h($booked_temporary_detail['movie_title']) ?>
          <?= h($booked_temporary_detail['screening_start_time']) ?>
          <?= h($booked_temporary_detail['screening_end_time']) ?>
          <?= h($booked_temporary_detail['seat_number']) ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
