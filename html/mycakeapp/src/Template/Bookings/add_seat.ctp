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
  <h1 class="heading">座席予約</h1>
  <div class="wrapper">
    <?= $this->Flash->render(); ?>
    <div class="container">
      <div class="non-reserved-sample">予約可能</div>
      <div class="reserved-sample">予約済</div>
      <?= $this->Form->create($booking, [
        'type' => 'post',
        // チェックボタンのlabelの位置を変更することでレイアウトを整える
        'templates' => [
          'inputContainer' => '{{content}}',
          'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>'
        ]
      ]); ?>
      <?php
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
        <?php
        $seat_row_count = 8;
        // 座席選択フォーム
        for ($i = 1; $i <= $seat_row_count; $i++) {
          echo "<tr class=\"movie-seats-line\">";
          echo "<th class=\"table-text\">", $i, "</th>";
          $checkbox_values_one = [];
          foreach ($column_alphabets as $column_alphabet) {
            array_push($checkbox_values_one, $column_alphabet . $i);
          }
          foreach ($checkbox_values_one as $value) {
            if ($value === $cancel_user_seat) {
              // P50から遷移した時にキャンセル前の席を選択済にする
              echo "<th>";
              echo $this->Form->control(
                'seat_number',
                ['type' => 'checkbox', 'value' => $value, 'checked' => true, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '', 'error' => false]
              );
              echo "</th>";
            } elseif (in_array($value, $booked_seats_array)) {
              // 予約済の席を選択できないようする
              echo "<th>";
              echo "<div class=reserved></div>";
              echo "</th>";
            } else {
              // 通常の空席
              echo "<th>";
              echo $this->Form->control(
                'seat_number',
                ['type' => 'checkbox', 'value' => $value, 'onclick' => 'click_cb()', 'hiddenField' => false, 'id' => $value, 'label' => '', 'error' => false]
              );
              echo "</th>";
            }
          }
          echo "<th class=\"table-text\">", $i, "</th>";
          echo "</tr>";
        }
        ?>
      </table>
      <?= $this->Form->hidden('is_cancelled', ['value' => 0]); ?>
      <?= $this->Form->hidden('is_main_booked', ['value' => 0]); ?>
      <p>※別の席に変更する際は選択中の席を選択解除してください。</p>
      <?= $this->Form->submit('決定', ['class' => 'registration']) ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</section>
