<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->email('email', false, 'メールアドレスが間違っているようです。')
            ->requirePresence('email', 'create')
            ->notEmptyString('email', '空白になっています。');

        $validator
            ->scalar('password')
            ->lengthBetween('password', [4, 13], 'パスワードは4文字以上、13文字以下にしてください。')
            ->requirePresence('password', 'create')
            ->notEmptyString('password', '空白になっています。')
            ->add('password', [
                'alphaNumeric' => [
                    'rule' => function ($value, $context) {
                        return preg_match("/\A[0-9A-Za-z]*\z/", $value) ? true : false;
                    },
                    'message' => 'パスワードに使えない文字が入力されています'
                ]
            ]);

        $validator
            ->scalar('check_password')
            ->notEmptyString('check_password', '空白になっています。')
            ->equalToField('check_password', 'password', 'パスワードが一致していません。');

        $validator
            ->date('birthdate')
            ->requirePresence('birthdate', 'create')
            ->notEmptyDate('birthdate');

        $validator
            ->scalar('sex')
            ->maxLength('sex', 1)
            ->notEmptyString('sex', '性別を選択して下さい。')
            ->inList('sex', ['0', '1', '2', '9']);

        $validator
            ->boolean('is_deleted')
            ->notEmptyString('is_deleted');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }


    public function findUser($user_id)
    {
        $users = $this->find()
            ->select(['id', 'birthdate', 'sex'])
            ->where(['id' => $user_id])
            ->toList();

        return $users;
    }
    // ユーザーが論理削除されていないものを認証の対象とするクエリービルダー
    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        $query->where(['Users.is_deleted' => 0]);

        return $query;

    }
}
