<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class LoginForm extends Form
{

  protected function _buildSchema(Schema $schema)
  {
    return $schema
      ->addField('email', ['type' => 'string'])
      ->addField('password', ['type' => 'password']);
  }

  protected function _buildValidator(Validator $validator)
  {
    $validator
      ->email('email', false, 'メールアドレスが間違っているようです。')
      ->notEmptyString('email', '空白になっています。');

    $validator
      ->scalar('password')
      ->notEmptyString('password', '空白になっています。');

    return $validator;
  }

  protected function _execute(array $data)
  {
    // メールを送信する
    return true;
  }
}
