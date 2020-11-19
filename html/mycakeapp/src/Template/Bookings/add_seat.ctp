<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
$column_alphabets = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K'];
?>
<?= $this->Html->css('bookings', ['block' => true]); ?>
<?= $this->Html->script('jquery.min', ['block' => true]); ?>
<?= $this->Html->script('booking', ['block' => true]); ?>
<section>
  <?= $this->Flash->render(); ?>
  <h1 class="heading">座席予約</h1>
  <div class="wrapper">
    <div class="container">
      <div class="non-reserved-sample">予約可能</div>
      <div class="reserved-sample">予約済</div>
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
          <?php
          $checkbox_values_one = [];
          foreach ($column_alphabets as $column_alphabet) {
            array_push($checkbox_values_one, $column_alphabet . '1');
          }
          foreach ($checkbox_values_one as $value) {
            if ($value === $cancel_user_seat) { // P51から遷移した時に席を選択済にする
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'checked' => true, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            } elseif (in_array($value, $booked_seats_array)) { // 予約済の席を選択できないようする
              echo "<th>";
              echo "<div class=reserved></div>";
              echo "</th>";
            } else {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            }
          }
          ?>
          <th class="table-text">1</th>

        </tr>

        <tr class="movie-seats-line">
          <th class="table-text">2</th>
          <?php
          $checkbox_values_two = [];
          foreach ($column_alphabets as $column_alphabet) {
            array_push($checkbox_values_two, $column_alphabet . '2');
          }
          foreach ($checkbox_values_two as $value) {
            if ($value === $cancel_user_seat) {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'checked' => true, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            } elseif (in_array($value, $booked_seats_array)) {
              echo "<th>";
              echo "<div class=reserved></div>";
              echo "</th>";
            } else {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            }
          }
          ?>
          <th class="table-text">2</th>
        </tr>
        <tr class="movie-seats-line">
          <th class="table-text">3</th>
          <?php
          $checkbox_values_three = [];
          foreach ($column_alphabets as $column_alphabet) {
            array_push($checkbox_values_three, $column_alphabet . '3');
          }
          foreach ($checkbox_values_three as $value) {
            if ($value === $cancel_user_seat) {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'checked' => true, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            } elseif (in_array($value, $booked_seats_array)) {
              echo "<th>";
              echo "<div class=reserved></div>";
              echo "</th>";
            } else {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            }
          }
          ?>
          <th class="table-text">3</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">4</th>
          <?php
          $checkbox_values_sixour = [];
          foreach ($column_alphabets as $column_alphabet) {
            array_push($checkbox_values_sixour, $column_alphabet . '4');
          }
          foreach ($checkbox_values_sixour as $value) {
            if ($value === $cancel_user_seat) {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'checked' => true, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            } elseif (in_array($value, $booked_seats_array)) {
              echo "<th>";
              echo "<div class=reserved></div>";
              echo "</th>";
            } else {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            }
          }
          ?>
          <th class="table-text">4</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">5</th>
          <?php
          $checkbox_values_sixive = [];
          foreach ($column_alphabets as $column_alphabet) {
            array_push($checkbox_values_sixive, $column_alphabet . '5');
          }
          foreach ($checkbox_values_sixive as $value) {
            if ($value === $cancel_user_seat) {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'checked' => true, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            } elseif (in_array($value, $booked_seats_array)) {
              echo "<th>";
              echo "<div class=reserved></div>";
              echo "</th>";
            } else {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            }
          }
          ?>
          <th class="table-text">5</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">6</th>
          <?php
          $checkbox_values_six = [];
          foreach ($column_alphabets as $column_alphabet) {
            array_push($checkbox_values_six, $column_alphabet . '6');
          }
          foreach ($checkbox_values_six as $value) {
            if ($value === $cancel_user_seat) {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'checked' => true, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            } elseif (in_array($value, $booked_seats_array)) {
              echo "<th>";
              echo "<div class=reserved></div>";
              echo "</th>";
            } else {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            }
          }
          ?>
          <th class="table-text">6</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">7</th>
          <?php
          $checkbox_values_seven = [];
          foreach ($column_alphabets as $column_alphabet) {
            array_push($checkbox_values_seven, $column_alphabet . '7');
          }
          foreach ($checkbox_values_seven as $value) {
            if ($value === $cancel_user_seat) {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'checked' => true, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            } elseif (in_array($value, $booked_seats_array)) {
              echo "<th>";
              echo "<div class=reserved></div>";
              echo "</th>";
            } else {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            }
          }
          ?>
          <th class="table-text">7</th>
        </tr>
        <tr class='movie-seats-line'>
          <th class="table-text">8</th>
          <?php
          $checkbox_values_eight = [];
          foreach ($column_alphabets as $column_alphabet) {
            array_push($checkbox_values_eight, $column_alphabet . '8');
          }
          foreach ($checkbox_values_eight as $value) {
            if ($value === $cancel_user_seat) {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'checked' => true, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            } elseif (in_array($value, $booked_seats_array)) {
              echo "<th>";
              echo "<div class=reserved></div>";
              echo "</th>";
            } else {
              echo "<th>";
              echo $this->Form->control('seat_number', ['type' => 'checkbox', 'value' => $value, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '']);
              echo "</th>";
            }
          }
          ?>
          <th class="table-text">8</th>
        </tr>
      </table>
      <?= $this->Form->hidden('is_cancelled', ['value' => 0]); ?>
      <?= $this->Form->hidden('is_main_booked', ['value' => 0]); ?>
      <?= $this->Form->submit('決定', ['class' => 'registration']) ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</section>
