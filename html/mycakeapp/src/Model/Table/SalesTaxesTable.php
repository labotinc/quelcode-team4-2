<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesTaxes Model
 *
 * @method \App\Model\Entity\SalesTax get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalesTax newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SalesTax[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalesTax|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesTax saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesTax patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalesTax[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalesTax findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalesTaxesTable extends Table
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

        $this->setTable('sales_taxes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->hasMany('PaymentHistories');
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
            ->integer('rate', '半角数字で入力してください')
            ->requirePresence('rate', 'create')
            ->notEmptyString('rate')
            ->naturalNumber('rate', '0以上の自然数を入力してください');

        $validator
            ->boolean('is_applied')
            ->notEmptyString('is_applied');

        return $validator;
    }
}
