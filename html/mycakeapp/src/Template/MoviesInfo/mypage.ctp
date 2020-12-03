<?= $this->Html->css('moviesinfo', ['block' => true]) ?>
<section>
  <div class="mypage-wrapper">
    <h1 class="heading">マイページ</h1>
    <div class="mypage-container">
      <!-- ポイント機能は追加実装 -->
      <div class="my-point my-content">
        <p class="my-content-title">ポイント</p>
        <p class="my-point-count">0</p>
      </div>
      <div class="my-booking my-content">
        <p class="my-content-title">予約詳細</p>
        <div class="mypage-button-wrapper booking-button-wrapper">
          <?= $this->Html->link(
            '詳細',
            ['action' => 'booking_detail'],
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
        <?php endif; ?>
        <div class="mypage-button-wrapper booking-button-wrapper">
          <?php if (empty($my_credit_card_number)) : ?>
            <?= $this->Html->link(
              '登録する',
              ['controller' => 'credit_cards', 'action' => 'add'],
              ['class' => 'mypage-button credit-button']
            ) ?>
          <?php else : ?>
            <!-- <p class="my_card_number">
              <?= $my_credit_card_number ?>
            </p> -->
            <?= $this->Html->link(
              '登録・編集する',
              ['controller' => 'credit_cards', 'action' => 'credit_info'],
              ['class' => 'mypage-button credit-button']
            ) ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </div>
</section>
