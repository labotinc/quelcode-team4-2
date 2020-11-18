<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<?= $this->Html->css('bookings', ['block' => true]); ?>
<section>
  <h1 class="heading">座席予約</h1>
  <div class="wrapper">
    <div class="container">
      <?= $this->Form->create($booking, ['type' => 'post']) ?>
      <?php
      $errors = $booking->hasErrors();
      // ユーザーIDはログインユーザーから、映画スケジュールIDはDBから取得
      echo $this->Form->hidden('user_id', ['value' => $authuser['id']]);
      echo $this->Form->hidden('schedule_id', ['value' => $movie_schedule['id']]);
      // echo $this->Form->radio()
      // 席一覧の作成
      ?>
      <table class="movie-seats">
        <thead>
          <tr class="movie-seats-line">
            <th></th>
            <th class="table-text">A</th>
            <th class="table-text">B</th>
            <th class="table-text">C</th>
            <th class="table-text">D</th>
            <th class="table-text">E</th>
            <th class="table-text">F</th>
            <th class="table-text">G</th>
            <th class="table-text">H</th>
            <th class="table-text">I</th>
            <th class="table-text">J</th>
            <th class="table-text">K</th>
            <th></th>
          </tr>
        </thead>
        <tr class="movie-seats-line">
          <th class="table-text">1</th>
          <th>

          </th>
          <th>

          </th>
          <th><?= $this->Form->radio('seat_number', [
                ['value' => 'A1', 'text' => ''],
                ['value' => 'A2', 'text' => ''],
                ['value' => 'A3', 'text' => ''],
                ['value' => 'A4', 'text' => '']
              ]) ?></th>

          <th class="table-text">1</th>
        </tr>

        <tr class="movie-seats-line">
          <th class="table-text">2</th>

          <th class="table-text">2</th>
        </tr>
        <tr class="movie-seats-line">
          <th class="table-text">3</th>

          <th class="table-text">3</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">4</th>

          <th class="table-text">4</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">5</th>

          <th class="table-text">5</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">6</th>

          <th class="table-text">6</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">7</th>

          <th class="table-text">7</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">8</th>

          <th class="table-text">8</th>
        </tr>
      </table>
      <?= $this->Form->hidden('is_cancelled', ['value' => 0]); ?>

      <?= $this->Form->submit('決定', ['class' => 'registration']) ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</section>
