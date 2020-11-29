<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CreditCard $creditCard
 */
?>
<?= $this->Html->css('credit', ['block' => true]); ?>
<section class="h1">
    <h1>決済情報</h1>
</section>
<section class="form-container">
    <p class="text-registration-completed">決済情報の登録が完了しました。</p>
    <?= $this->Html->link(
        'マイページに戻る',
        ['controller' => 'MoviesInfo', 'action' => 'mypage', $user_id], //****** リンク要確認 */
        ['class' => 'link-button']
    );
    ?>
</section>