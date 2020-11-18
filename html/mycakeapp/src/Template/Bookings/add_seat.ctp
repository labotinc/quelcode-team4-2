<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<?= $this->Html->css('bookings', ['block' => true]); ?>
<?= $this->Html->script('jquery.min', ['block' => true]); ?>
<?= $this->Html->script('booking', ['block' => true]); ?>
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
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'A1', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'A1', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'A2', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'A2', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'A3', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'A3', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'A4', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'A4', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'A5', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'A5', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'A6', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'A6', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'A7', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'A7', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'A8', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'A8', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'A9', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'A9', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'A10', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'A10',  'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'A11', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'A11',  'label' => '']) ?></th>
          <th class="table-text">1</th>

        </tr>

        <tr class="movie-seats-line">
          <th class="table-text">2</th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'B1', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'B1', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'B2', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'B2', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'B3', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'B3', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'B4', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'B4', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'B5', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'B5', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'B6', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'B6', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'B7', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'B7', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'B8', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'B8', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'B9', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'B9', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'B10', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'B10', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'B11', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'B11', 'label' => '']) ?></th>
          <th class="table-text">2</th>
        </tr>
        <tr class="movie-seats-line">
          <th class="table-text">3</th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'C1', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'C1', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'C2', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'C2', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'C3', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'C3', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'C4', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'C4', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'C5', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'C5', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'C6', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'C6', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'C7', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'C7', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'C8', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'C8', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'C9', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'C9', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'C10', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'C10', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'C11', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'C11', 'label' => '']) ?></th>
          <th class="table-text">3</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">4</th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'D1', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'D1', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'D2', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'D2', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'D3', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'D3', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'D4', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'D4', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'D5', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'D5', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'D6', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'D6', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'D7', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'D7', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'D8', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'D8', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'D9', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'D9', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'D10', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'D10', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'D11', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'D11', 'label' => '']) ?></th>
          <th class="table-text">4</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">5</th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'E1', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'E1', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'E2', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'E2', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'E3', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'E3', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'E4', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'E4', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'E5', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'E5', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'E6', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'E6', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'E7', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'E7', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'E8', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'E8', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'E9', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'E9', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'E10', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'E10', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'E11', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'E11', 'label' => '']) ?></th>
          <th class="table-text">5</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">6</th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'F1', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'F1', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'F2', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'F2', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'F3', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'F3', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'F4', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'F4', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'F5', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'F5', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'F6', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'F6', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'F7', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'F7', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'F8', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'F8', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'F9', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'F9', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'F10', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'F10', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'F11', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'F11', 'label' => '']) ?></th>
          <th class="table-text">6</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">7</th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'G1', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'G1', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'G2', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'G2', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'G3', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'G3', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'G4', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'G4', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'G5', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'G5', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'G6', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'G6', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'G7', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'G7', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'G8', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'G8', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'G9', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'G9', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'G10', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'G10', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'G11', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'G11', 'label' => '']) ?></th>
          <th class="table-text">7</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">8</th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'H1', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'H1', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'H2', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'H2', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'H3', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'H3', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'H4', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'H4', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'H5', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'H5', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'H6', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'H6', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'H7', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'H7', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'H8', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'H8', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'H9', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'H9', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'H10', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'H10', 'label' => '']) ?></th>
          <th><?= $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => 'H11', 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => 'H11', 'label' => '']) ?></th>
          <th class="table-text">8</th>
        </tr>
      </table>
      <?= $this->Form->hidden('is_cancelled', ['value' => 0]); ?>

      <?= $this->Form->submit('決定', ['class' => 'registration']) ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</section>
