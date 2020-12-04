<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\LoginForm; // added.

use Cake\Auth\DefaultPasswordHasher; // added.
use Cake\Event\Event; // added.

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        // 各種コンポーネントのロード
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        // fieldのキーには'username'と'password'しか使えない
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginRedirect' => [
                'controller' => 'MoviesInfo',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'authError' => 'ログインしてください。',
        ]);
    }

    // ログイン処理
    function login()
    {
        // ログイン済の場合はトップページへリダイレクト
        if ($this->request->getSession()->read('Auth.User.id')) {
            $this->Flash->set('既にログイン済です。');
            return $this->redirect(['controller' => 'MoviesInfo', 'action' => 'index']);
        }
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

                    return $this->redirect($this->Auth->redirectUrl());
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

    // 認証を使わないページの設定
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // 基本的にログイン関連ページと会員登録ページのみ、あとでadd,index,editは消す
        $this->Auth->allow([
            'index', 'signup', 'logout', 'thanks',
            'add', 'edit'
        ]);
    }

    // 認証時のロールのチェック
    public function isAuthorized($user)
    {
        // ID1,2,3,4は管理者ユーザーとします
        // 配列比較もできますが、厳密な比較を用いたいのでこのようにしています
        $user_id = $user['id'];
        if ($user_id === 1 || $user_id === 2 || $user_id === 3 || $user_id === 4) {
            return true;
        }
        // 他はすべてfalse
        return false;
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function signup()
    {
        $this->layout = 'main';
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'thanks']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function thanks()
    {
        $this->layout = 'main';
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
