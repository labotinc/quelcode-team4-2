<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\LoginForm; // added.

use Cake\Auth\DefaultPasswordHasher; // added.
use Cake\Event\Event; // added.

class MovieAuthBaseController extends AppController
{

  // 初期化処理
  public function initialize()
  {
    parent::initialize();
    // 必要なコンポーネントのロード
    $this->loadComponent('RequestHandler');
    $this->loadComponent('Flash');
    $this->loadComponent('Auth', [
      'authorize' => ['Controller'],
      'authenticate' => [
        'Form' => [
          'fields' => [
            'username' => 'email',
            'password' => 'password'
          ]
        ]
      ],
      'loginRedirect' => [
        'controller' => 'Users',
        'action' => 'login'
      ],
      'logoutRedirect' => [
        'controller' => 'Users',
        'action' => 'logout',
      ],
      'authError' => '予約を行う際は、ログインしてください。',
    ]);
  }

  // ログイン処理
  function login()
  {
    $this->layout = 'main';

    $login_form = new LoginForm();
    if ($this->request->is('post')) {
      // バリデーションエラーが起きている場合はここでfalseになる
      // つまりフラッシュメッセージは表示されずにバリデーションエラーメッセージがフォームにでる
      if ($login_form->execute($this->request->getData())) {
        $user = $this->Auth->identify();
        // Authのidentifyをユーザーに設定
        if ($user) {
          $this->Auth->setUser($user);
          // *本当はトップページに遷移
          return $this->redirect(['controller' => 'Moviesinfo', 'action' => 'schedule']);
        }
        $this->Flash->error('ユーザー名かパスワードが間違っています。');
      }
    }

    $this->set(compact('login_form'));
  }

  // ログアウト処理
  public function logout()
  {
    // セッションを破棄
    $this->request->getSession()->destroy();
    return $this->redirect($this->Auth->logout());
  }

  // 認証をしないページの設定
  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
    // ※トップページのアクションが決まり次第ここに記入
    // ワイルドカードを用いて全ページアクセス可能な状態にしている。本番では削除
    $this->Auth->allow([
      'pricelist', 'schedule', 'トップページ',
      '*'
    ]);
  }

  // 認証時のロールの処理
  public function isAuthorized($user)
  {
    // ID1,2,3,4は管理者ユーザーとします
    // 配列比較もできますが、厳密な比較を用いたいのでこのようにしています
    $user_id = $user['id'];
    if ($user_id === 1 || $user_id === 2 || $user_id === 3 || $user_id === 4) {
      return true;
    }
    // 一般ユーザーはBookingsControllerとMoviesinfoControllerのみtrue、他はfalse,他必要なコントローラは順次追加する
    else {
      if ($this->name == 'Bookings' || $this->name === 'Moviesinfo') {
        return true;
      } else {
        return false;
      }
    }
    // その他はすべてfalse
    return false;
  }
}
