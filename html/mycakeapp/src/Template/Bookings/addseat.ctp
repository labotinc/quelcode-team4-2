<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<section>
  <h1 class="heading">座席予約</h1>
  <div class="wrapper">
    <div class="container">
      <?= $this->Form->create($booking, [
        'type' => 'post',
        'url' => ['controller' => 'Bookings', 'action' => 'addseat'],
        'novalidate' => true
      ]) ?>
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
          <tr>
            <th></th>
            <th>A</th>
            <th>B</th>
            <th>C</th>
            <th>D</th>
            <th>E</th>
            <th>F</th>
            <th>G</th>
            <th>H</th>
            <th>I</th>
            <th>J</th>
            <th>K</th>
            <th></th>
          </tr>
        </thead>
        <tr>
          <th>1</th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'A1', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'A2', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'A3', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'A4', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'A5', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'A6', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'A7', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'A8', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'A9', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'A10', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'A11', 'text' => '']]) ?></th>
          <th>1</th>
        </tr>
        <tr>
          <th>2</th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'B1', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'B2', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'B3', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'B4', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'B5', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'B6', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'B7', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'B8', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'B9', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'B10', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'B11', 'text' => '']]) ?></th>
          <th>2</th>
        </tr>
        <tr>
          <th>3</th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'C1', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'C2', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'C3', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'C4', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'C5', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'C6', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'C7', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'C8', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'C9', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'C10', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'C11', 'text' => '']]) ?></th>
          <th>3</th>
        </tr>
        <tr>
          <th>4</th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'D1', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'D2', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'D3', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'D4', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'D5', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'D6', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'D7', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'D8', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'D9', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'D10', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'D11', 'text' => '']]) ?></th>
          <th>4</th>
        </tr>
        <tr>
          <th>5</th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'E1', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'E2', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'E3', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'E4', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'E5', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'E6', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'E7', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'E8', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'E9', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'E10', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'E11', 'text' => '']]) ?></th>
          <th>5</th>
        </tr>
        <tr>
          <th>6</th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'F1', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'F2', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'F3', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'F4', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'F5', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'F6', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'F7', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'F8', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'F9', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'F10', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'F11', 'text' => '']]) ?></th>
          <th>6</th>
        </tr>
        <tr>
          <th>7</th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'G1', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'G2', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'G3', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'G4', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'G5', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'G6', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'G7', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'G8', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'G9', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'G10', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'G11', 'text' => '']]) ?></th>
          <th>7</th>
        </tr>
        <tr>
          <th>8</th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'H1', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'H2', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'H3', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'H4', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'H5', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'H6', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'H7', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'H8', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'H9', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'H10', 'text' => '']]) ?></th>
          <th><?= $this->Form->radio('seat_number', [['value' => 'H11', 'text' => '']]) ?></th>
          <th>8</th>
        </tr>
      </table>
      <?= $this->Form->hidden('is_cancelled', ['value' => 0]); ?>

      <?= $this->Form->submit('決定', ['class' => 'ragistration']) ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</section>
