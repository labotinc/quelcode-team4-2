<?= $this->Html->css('users', ['block' => true]) ?>
<section>
    <div class="thanks-wrapper">
        <p class="thanks-message">アカウントを削除しました。</p>
        <?= $this->Html->link('トップに戻る', ['controller' => 'MoviesInfo', 'action' => 'index'], ['class' => 'button']) ?>
    </div>
</section>
