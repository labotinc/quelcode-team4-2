<section>
    <h1 class="heading">会員登録</h1>
    <div class="wrapper">
        <div class="container">
            <?= $this->Form->create($user, [
                'type' => 'post',
                'url' => ['controller' => 'Users', 'action' => 'signup'],
                'novalidate' => true
            ]) ?>
            <?= $this->Form->control('email', [
                'placeholder' => 'メールアドレス',
                'label' => false,
                'class' => 'email-form'
            ]) ?>
            <?= $this->Form->control('password', [
                'placeholder' => 'パスワード',
                'label' => false,
                'class' => 'password-form'
            ]) ?>
            <?= $this->Form->control('check_password', [
                'type' => 'password',
                'placeholder' => 'パスワード（確認用）',
                'label' => false,
                'class' => 'check-password'
            ]) ?>
            <?= $this->Form->label(
                'birthdate',
                '生年月日',
                ['class' => 'birthday']
            ) ?>

            <?= $this->Form->control('birthdate', [
                'type' => 'date',
                'label' => false,
                'dateFormat' => 'YMD',
                'monthNames' => false,
                'maxYear' => date('Y'),
                'minYear' => date('Y') - 100
            ]) ?>
            <div class="sexuality">
                <?= $this->Form->select(
                    'sex',
                    [
                        '1' => '男性',
                        '2' => '女性',
                        '9' => 'その他'
                    ],
                    [
                        'empty' => '性別',
                        'default' => '性別'
                    ]
                ) ?>
                <?= $this->Form->error('sex') ?>
            </div>
            <?= $this->Form->submit('会員登録', ['class' => 'ragistration']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</section>
