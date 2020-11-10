<h2>会員登録</h2>
<div class="signup">
    <?= $this->Form->create($user, [
        'type' => 'post',
        'url' => ['controller' => 'Users', 'action' => 'add'],
        'novalidate' => true
    ]); ?>
    <?= $this->Form->control('email', ['placeholder' => 'メールアドレス', 'label' => false]); ?>
    <?= $this->Form->control('password', ['placeholder' => 'パスワード', 'label' => false,]); ?>
    <?= $this->Form->control('password', ['placeholder' => 'パスワード（確認用）', 'label' => false]); ?>
    <?= $this->Form->control('birthday', [
        'type' => 'date',
        'label' => false,
        'dateFormat' => 'YMD',
        'monthNames' => false,
        'maxYear' => date('Y'),
        'minYear' => date('Y') - 100
    ]); ?>
    <?= $this->Form->end(); ?>
</div>
