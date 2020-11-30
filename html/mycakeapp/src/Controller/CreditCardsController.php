<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * CreditCards Controller
 *
 * @property \App\Model\Table\CreditCardsTable $CreditCards
 *
 * @method \App\Model\Entity\CreditCard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CreditCardsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $creditCards = $this->paginate($this->CreditCards);

        $this->set(compact('creditCards'));
    }

    /**
     * View method
     *
     * @param string|null $id Credit Card id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $creditCard = $this->CreditCards->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('creditCard', $creditCard);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('main');
        $creditCard = $this->CreditCards->newEntity();
        if ($this->request->is('post')) {
            $creditCard = $this->CreditCards->patchEntity($creditCard, $this->request->getData());
            // バリデーションエラーが起こらなかった場合に、暗号化を行う
            if (!$creditCard->getErrors()) {
                // エンティティにuser_idの値をセット
                // ログイン機能つけるまではとりあえず *****  1  ******
                $creditCard->setUserId(2);
                // エンティティにis_deletedの値をセット
                $creditCard->setIsDeleted();
                $creditCard->encrypt();
            }
            if ($this->CreditCards->save($creditCard)) {
                $this->Flash->success(__('The credit card has been saved.'));

                return $this->redirect(['action' => 'completed']); 
            }
            $this->Flash->error(__('The credit card could not be saved. Please, try again.'));
        }
        $users = $this->CreditCards->Users->find('list', ['limit' => 200]);
        $this->set(compact('creditCard', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Credit Card id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('main');
        $creditCard = $this->CreditCards->get($id, [
            'contain' => [],
        ]);
        $creditCard->decrypt();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $creditCard = $this->CreditCards->patchEntity($creditCard, $this->request->getData());
            if ($this->CreditCards->save($creditCard)) {
                $this->Flash->success(__('The credit card has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The credit card could not be saved. Please, try again.'));
        }
        $users = $this->CreditCards->Users->find('list', ['limit' => 200]);
        $this->set(compact('creditCard', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Credit Card id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $creditCard = $this->CreditCards->get($id);
        if ($this->CreditCards->delete($creditCard)) {
            $this->Flash->success(__('The credit card has been deleted.'));
        } else {
            $this->Flash->error(__('The credit card could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Complete method
     *
     * @return \Cake\Http\Response|null Redirects on mypage
     */
    public function completed()
    {
        $this->viewBuilder()->setLayout('main');
        $user_id = $this->Auth; /** ログイン機能実装後、ユーザーIDをビューテンプレートに渡す */
        $this->set(compact('user_id'));
    }

      /**
     * CreditInfo method
     *
     * @return \Cake\Http\Response|null 登録情報編集ページ or 登録情報削除完了ページにリダイレクト（モーダルウィンドウで削除確認を行った後）
     */
    public function creditInfo($user_id = null)
    {
        $this->viewBuilder()->setLayout('main');
        $info = $this->CreditCards->findCreditCard(1); // -----[ログイン機能実装後修正]-----ひとまず[$user_id = 1 ]ログイン機能追加したら$user_idに変更すること

        /**
         * 処理の流れ
         * データがpost送信されると、
         * 1. ユーザが編集を選択した際は編集アクションにリダイレクト
         * 2. ユーザが削除を選択した際はクレジット情報を[0000]で上書きした後削除完了アクションにリダイレクト
         * 3. 上記2つでクレカを選択しなかった場合、エラーメッセージを表示させる
         */
        if ($this->request->is('post')) {
            $credit_id = $this->request->getData('Credit.id');
            // 1. 編集ボタンが押された場合
            if (isset($_POST['edit']) && !empty($credit_id)) {
                return $this->redirect(['action' => 'edit', $credit_id]);
            
            // 2. 削除ボタンが押された場合
            // [うまくいかず]$_POST['edit']ではない場合を elseif (isset($_POST['delete']) && !empty($credit_id))としたかったが機能しなかった
            } elseif (!empty($credit_id)) {
                $info = $this->CreditCards->get($credit_id)->showAsDeleted(); // showAsDeletedはエンティティクラスのメソッド
                if ($this->CreditCards->save($info)){
                    return $this->redirect(['action' => 'deleteCompleted']);
                } else {
                    $this->Flash->error(__('削除に失敗しました')); // 一応例外処理を記入
                }

            //3. クレカを選択せず「編集」「削除」ボタンを押下した場合
            } else {
                $this->Flash->error(__('クレジットカードを選択してください。'), ['key' => 'credit']);
            }
        }
        $this->set(compact('user_id', 'info'));
    }


    /**
     * DeleteCompleted method
     *
     * @return \Cake\Http\Response|null Redirects on mypage 削除完了ページ=>マイページへ遷移
     */
    public function deleteCompleted()
    {
        $this->viewBuilder()->setLayout('main');
        $user_id = $this->Auth; //ログイン情報から$user_idを渡す
        $this->set(compact('user_id'));
    }
}
