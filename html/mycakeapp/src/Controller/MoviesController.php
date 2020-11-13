<?php

namespace App\Controller;

use App\Controller\AppController;


/**
 * Movies Controller
 *
 * @property \App\Model\Table\MoviesTable $Movies
 *
 * @method \App\Model\Entity\Movie[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MoviesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $movies = $this->paginate($this->Movies);

        $this->set(compact('movies'));
    }

    /**
     * View method
     *
     * @param string|null $id Movie id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $movie = $this->Movies->get($id, [
            'contain' => [],
        ]);

        $this->set('movie', $movie);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $movie = $this->Movies->newEntity();
        // 保存の流れ
        // →まず保存を仮で行う（これによってIDを取得）
        // →その後にそのIDを使用して"id.拡張子"の形式で画像を保存
        // →保存したエンティティに上書き
        if ($this->request->is('post')) {
            //thumbnail_pathは配列なので先に取り出す。
            $thumbnail_data_array = $this->request->getData('thumbnail_path');
            $thumbnail_filename = $thumbnail_data_array['name'];
            // $movieにフォームの送信内容を反映（thumbnail_pathは後で更新する）
            $movie = $this->Movies->patchEntity($movie, [
                'title' => $this->request->getData('title'),
                'thumbnail_path' => $thumbnail_filename,
                'total_minutes_with_trailer' => $this->request->getData('total_minutes_with_trailer'),
                'screening_start_date' => $this->request->getData('screening_start_date'),
                'screening_end_date' => $this->request->getData('screening_end_date'),
                'is_screened' => $this->request->getData('is_screened')
            ]);
            // $movieを保存する
            if ($this->Movies->save($movie)) {
                //画像保存名（ファイルパス)の作成
                //画像拡張子のみを取得
                $thumbnail_file_extension = pathinfo($thumbnail_filename, PATHINFO_EXTENSION);
                //保存先thumbnail_path_idのID
                $thumbnail_path_id = $movie->id;
                //webroot/img/Auctionからの絶対パスを取得 参考：https://blog.s-giken.net/323.html
                $webroot_img_path = realpath(WWW_ROOT . "img/MovieThumbnails");
                $thumbnail_file_path = $webroot_img_path . "/" . $thumbnail_path_id . "." . $thumbnail_file_extension;
                //これをすでに一度保存したimage_pathに上書き
                $movie_update = $this->Movies->patchEntity($movie, [
                    'thumbnail_path' => $thumbnail_file_path,
                ]);
                if ($this->Movies->save($movie_update)) {
                    //画像をファイルに保存
                    move_uploaded_file($thumbnail_data_array['tmp_name'], $thumbnail_file_path);
                    // 成功時のメッセージ
                    $this->Flash->success(__('保存しました。'));
                    // トップページ（index）に移動
                    return $this->redirect(['action' => 'index']);
                }
            }
            // 失敗時のメッセージ
            $this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
        }
        $this->set(compact('movie'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Movie id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $movie = $this->Movies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // 以下はaddと同様の操作
            $thumbnail_data_array = $this->request->getData('thumbnail_path');
            $thumbnail_filename = $thumbnail_data_array['name'];
            $movie = $this->Movies->patchEntity($movie, [
                'title' => $this->request->getData('title'),
                'thumbnail_path' => $thumbnail_filename,
                'total_minutes_with_trailer' => $this->request->getData('total_minutes_with_trailer'),
                'screening_start_date' => $this->request->getData('screening_start_date'),
                'screening_end_date' => $this->request->getData('screening_end_date'),
                'is_screened' => $this->request->getData('is_screened')
            ]);
            if ($this->Movies->save($movie)) {
                $thumbnail_file_extension = pathinfo($thumbnail_filename, PATHINFO_EXTENSION);
                $thumbnail_path_id = $movie->id;
                $webroot_img_path = realpath(WWW_ROOT . "img/MovieThumbnails");
                $thumbnail_file_path = $webroot_img_path . "/" . $thumbnail_path_id . "." . $thumbnail_file_extension;
                $movie_update = $this->Movies->patchEntity($movie, [
                    'thumbnail_path' => $thumbnail_file_path,
                ]);
                if ($this->Movies->save($movie_update)) {
                    move_uploaded_file($thumbnail_data_array['tmp_name'], $thumbnail_file_path);
                    $this->Flash->success(__('保存しました。'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
        }
        $this->set(compact('movie'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Movie id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $movie = $this->Movies->get($id);
        if ($this->Movies->delete($movie)) {
            $this->Flash->success(__('The movie has been deleted.'));
        } else {
            $this->Flash->error(__('The movie could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
