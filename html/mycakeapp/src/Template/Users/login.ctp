<?= $this->Html->css('users', ['block' => true]) ?>
<section>
  <h1 class="heading">ログイン</h1>
  <div class="wrapper">
    <div class="container">
      <?= $this->Flash->render() ?>

      <?= $this->Form->create($login_form, ['novalidate']) ?>
      <?php $errors = $login_form->getErrors(); ?>
      <fieldset>
        <?= $this->Form->control('email', [
          'placeholder' => 'メールアドレス',
          'label' => 'メールアドレスを入力',
          'class' => 'email-form',
          'autofocus'
        ]) ?>
        <?= $this->Form->control('password', [
          'placeholder' => 'パスワード',
          'label' => "パスワードを入力",
          'class' => 'password-form',
          'autofocus'
        ]) ?>

      </fieldset>
      <?= $this->Form->button(__('ログイン'), ['class' => 'registration']); ?>
      <?= $this->Form->end() ?>
      <?= $this->Html->link(
        '会員登録',
        ['action' => 'signup'],
        ['class' => 'login-link'],
      ); ?>
      <div class="sample-user">
        <h3>サンプルユーザー（映画予約まで可能です）</h3>
        <p>mail:sample@sample.sample</p>
        <p>pass:sample</p>
      </div>
      <!-- 将来的に実装 -->
      <!-- <?= $this->Html->link('パスワードを忘れた方はコチラ', ['action' => 'reset'], ['class' => 'login-link']) ?> -->
    </div>
  </div>
</section>
