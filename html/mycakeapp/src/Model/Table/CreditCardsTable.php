<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CreditCards Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\CreditCard get($primaryKey, $options = [])
 * @method \App\Model\Entity\CreditCard newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CreditCard[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CreditCard|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CreditCard saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CreditCard patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CreditCard[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CreditCard findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CreditCardsTable extends Table
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

        $this->setTable('credit_cards');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
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
            ->scalar('card_number')
            ->requirePresence('card_number', 'create')
            ->notEmptyString('card_number', '空白になっています。')
            ->naturalNumber('card_number', '半角数字以外の文字が使われています。')
            ->add('holder_name', 'custom', ['rule' => function ($value, $context) {
                if (preg_match("/\A[0-9]{16}\z/", $value)) {
                    return true;
                } else {
                    return false;
                }
            }, 'message' => '不正なカード番号です。']);

        $validator
            ->scalar('holder_name')
            ->maxLength('holder_name', 100)
            ->requirePresence('holder_name', 'create')
            ->notEmptyString('holder_name', '空白になっています。')
            ->add('holder_name', 'custom', ['rule' => function ($value, $context) {
                if (preg_match("/\A[a-zA-Z]+\s[a-zA-Z]+\z/", $value)) {
                    return true;
                } else {
                    return false;
                }
            }, 'message' => '半角英字以外の文字が使われています。']);

        $validator
            ->scalar('expiration_date')
            ->maxLength('expiration_date', 100)
            ->requirePresence('expiration_date', 'create')
            ->notEmptyString('expiration_date', '空白になっています。')
            ->add('expiration_date', 'custom', ['rule' => function ($value, $context) {
                // 参考ページ http://php.o0o0.jp/article/php-creditcard
                // 有効期限（MMYY）
                if (!preg_match('/\A([0-9]{2})([0-9]{2})\z/', $value, $matches)) {
                    return false; 
                } else {
                    $month = $matches[1];
                    $year = sprintf('20%s', $matches[2]);

                    // 日付妥当性
                    if (!checkdate($month, 1, $year)) {
                        return false;
                    }
                    // 範囲
                    $expiration = mktime(0, 0, 0, $month, 1, $year);
                    // 過去の場合
                    $today = mktime(0, 0, 0, date('m'), 1, date('Y'));
                    if ($expiration < $today) {
                        return false;
                    }
                    // 未来の場合（有効期限は最長10年程度？）
                    $future = mktime(0, 0, 0, date('m'), 1, date('Y') + 10);
                    if ($expiration > $future) {
                        return false;
                    }
                    return true;
                }
            }, 'message' => '有効期限が間違っています。']);

        $validator
            ->boolean('is_deleted')
            ->notEmptyString('is_deleted');

        $validator
            ->notEmptyString('security_code')
            ->add('security_code', 'custom', ['rule' => function ($value, $context) {
                if (preg_match("/\A[0-9]{3,4}\z/", $value)) {
                    return true;
                } else {
                    return false;
                }
            }, 'message' => '半角数字以外の文字が使われているか、あるいは文字数が誤っています。']);

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
