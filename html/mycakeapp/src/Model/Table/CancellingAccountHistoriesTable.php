<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CancellingAccountHistories Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CancellingCategoriesTable&\Cake\ORM\Association\BelongsTo $CancellingCategories
 *
 * @method \App\Model\Entity\CancellingAccountHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\CancellingAccountHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CancellingAccountHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CancellingAccountHistory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CancellingAccountHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CancellingAccountHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CancellingAccountHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CancellingAccountHistory findOrCreate($search, callable $callback = null, $options = [])
 */
class CancellingAccountHistoriesTable extends Table
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

        $this->setTable('cancelling_account_histories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('CancellingCategories', [
            'foreignKey' => 'cancelling_category_id',
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
            ->dateTime('cancelled')
            ->requirePresence('cancelled', 'create')
            ->notEmptyDateTime('cancelled');

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
        $rules->add($rules->existsIn(['cancelling_category_id'], 'CancellingCategories'));

        return $rules;
    }
}
