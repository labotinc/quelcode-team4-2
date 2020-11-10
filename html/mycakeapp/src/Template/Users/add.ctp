<h2>会員登録</h2>
<div class="signup">
    <?= $this->Form->create($user, [
        'type' => 'post',
        'url' => ['controller' => 'Users', 'action' => 'add'],
        'novalidate' => true
    ]); ?>
  
    <?= $this->Form->end(); ?>
</div>
