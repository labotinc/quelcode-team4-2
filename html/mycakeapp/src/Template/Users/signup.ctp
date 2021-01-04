<?= $this->Html->css('users', ['block' => true]) ?>
<section>
    <h1 class="heading">会員登録</h1>
    <div class="wrapper">
        <div class="container">
            <?= $this->Form->create($user, [
                'type' => 'post',
                'url' => ['controller' => 'Users', 'action' => 'signup'],
                'novalidate' => true
            ]) ?>
            <?php
            $errors = $user->getErrors();

            if ($errors) {
                echo $this->Form->label('email', 'メールアドレス');
            }


            if ($this->request->is('post')) {
                echo $this->Form->control('email', [

                    'label' => false,
                    'class' => 'email-form'
                ]);
            } else {
                echo $this->Form->control('email', [
                    'placeholder' => 'メールアドレス',
                    'label' => false,
                    'class' => 'email-form'
                ]);
            }
            if ($errors) {
                echo $this->Form->label('password', 'パスワード');
            }
            if ($this->request->is('post')) {
                echo $this->Form->control('password', [
                    'label' => false,
                    'class' => 'password-form'
                ]);
            } else {
                echo $this->Form->control('password', [
                    'placeholder' => 'パスワード',
                    'label' => false,
                    'class' => 'password-form'
                ]);
            }

            if ($errors) {
                echo $this->Form->label('check_password', 'パスワード（再確認）');
            }

            if ($this->request->is('post')) {


                echo $this->Form->control('check_password', [
                    'type' => 'password',
                    'label' => false,
                    'class' => 'check-password'
                ]);
            } else {

                echo $this->Form->control('check_password', [
                    'type' => 'password',
                    'placeholder' => 'パスワード（確認用）',
                    'label' => false,
                    'class' => 'check-password'
                ]);
            } ?>





            <?= $this->Form->label(
                'birthdate',
                '生年月日',
            ); ?>

            <?= $this->Form->control('birthdate', [
                'type' => 'date',
                'label' => false,
                'dateFormat' => 'YMD',
                'monthNames' => false,
                'maxYear' => date('Y'),
                'minYear' => date('Y') - 100
            ]) ?>
            <div class="sexuality">

                <?php
                if ($errors) {
                    echo $this->Form->label('sex', '性別');
                }
                if ($this->request->is('post')) {
                    echo $this->Form->select(
                        'sex',
                        [
                            '1' => '男性',
                            '2' => '女性',
                            '9' => 'その他'
                        ],
                        [
                            'empty' => '未選択',
                            'default' => '未選択'
                        ]
                    );
                } else {
                    echo $this->Form->select(
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
                    );
                } ?>
                <?= $this->Form->error('sex') ?>
            </div>
            <?= $this->Form->submit('会員登録', ['class' => 'registration']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</section>
