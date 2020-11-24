<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaymentHistories Model
 *
 * @property \App\Model\Table\BookingsTable&\Cake\ORM\Association\BelongsTo $Bookings
 * @property \App\Model\Table\CreditCardsTable&\Cake\ORM\Association\BelongsTo $CreditCards
 * @property \App\Model\Table\PricesTable&\Cake\ORM\Association\BelongsTo $Prices
 * @property \App\Model\Table\DiscountsTable&\Cake\ORM\Association\BelongsTo $Discounts
 * @property \App\Model\Table\SalesTaxesTable&\Cake\ORM\Association\BelongsTo $SalesTaxes
 *
 * @method \App\Model\Entity\PaymentHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaymentHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PaymentHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaymentHistory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaymentHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaymentHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentHistory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PaymentHistoriesTable extends Table
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

        $this->setTable('payment_histories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            // payment_request_createdの初期値を作成日時にするためにイベントを設定。
            // 参考：https://book.cakephp.org/3/ja/orm/behaviors/timestamp.html#id2
            'events' => [
                'Model.beforeSave' => [
                    'payment_request_created' => 'new',
                    'modified' => 'always',
                ],
            ]
        ]);

        $this->belongsTo('Bookings', [
            'foreignKey' => 'booking_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('CreditCards', [
            'foreignKey' => 'credit_card_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Prices', [
            'foreignKey' => 'price_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Discounts', [
            'foreignKey' => 'discount_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('SalesTaxes', [
            'foreignKey' => 'sales_tax_id',
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
            ->boolean('is_cancelled')
            ->requirePresence('is_cancelled', 'create')
            ->notEmptyString('is_cancelled');
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
        $rules->add($rules->existsIn(['booking_id'], 'Bookings'));
        $rules->add($rules->existsIn(['credit_card_id'], 'CreditCards'));
        $rules->add($rules->existsIn(['price_id'], 'Prices'));
        $rules->add($rules->existsIn(['discount_id'], 'Discounts'));
        $rules->add($rules->existsIn(['sales_tax_id'], 'SalesTaxes'));

        return $rules;
    }
}
