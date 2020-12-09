<?= $this->Html->css('moviesinfo', ['block' => true]) ?>
<?= $this->Html->script('user_cancel', ['block' => true]) ?>
<section>
  <div class="mypage-wrapper">
    <h1 class="heading">マイページ</h1>
    <div class="mypage-container">
      <!-- ポイント機能は追加実装 -->
      <div class="my-point my-content">
        <p class="my-content-title">ポイント</p>
        <p class="my-point-count">0pt</p>
      </div>
      <div class="my-booking my-content">
        <p class="my-content-title">予約確認</p>
        <div class="mypage-button-wrapper booking-button-wrapper">
          <?= $this->Html->link(
            '詳細',
            ['action' => 'booking_details'],
            ['class' => 'mypage-button booking-button']
          ) ?>
        </div>
      </div>
      <div class="my-card my-content">
        <p class="my-content-title">決済情報</p>
        <?php if ($my_credit_card_number) : ?>
          <p class="my-card-number">
            <?= $my_credit_card_number ?>
          </p>
          <div class="mypage-button-wrapper booking-button-wrapper">
            <?= $this->Html->link(
              '編集する',
              ['controller' => 'credit_cards', 'action' => 'credit_info'],
              ['class' => 'mypage-button credit-button']
            ) ?>
            <?= $this->Html->link(
              '追加登録する',
              ['controller' => 'credit_cards', 'action' => 'add'],
              ['class' => 'mypage-button credit-button-add']
            ) ?>
          </div>
        <?php else : ?>
          <div class="mypage-button-wrapper booking-button-wrapper">
            <?= $this->Html->link(
              '登録する',
              ['controller' => 'credit_cards', 'action' => 'add'],
              ['class' => 'mypage-button credit-button']
            ) ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="user-delete-link">
      <?php
      echo $this->Form->create();
      echo $this->Form->button(
        'アカウントを削除',
        ['class' => 'user-delete__button', 'id' => 'user-delete__button', 'name' => 'delete']
      );
      echo $this->Form->end();
      ?>
    </div>
  </div>
</section>
