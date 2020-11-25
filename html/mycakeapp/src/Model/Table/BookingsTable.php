<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Bookings Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\MovieSchedulesTable&\Cake\ORM\Association\BelongsTo $MovieSchedules
 *
 * @method \App\Model\Entity\Booking get($primaryKey, $options = [])
 * @method \App\Model\Entity\Booking newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Booking[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Booking|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Booking saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Booking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Booking[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Booking findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BookingsTable extends Table
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

        $this->setTable('bookings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('MovieSchedules', [
            'foreignKey' => 'schedule_id',
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
            ->scalar('seat_number')
            ->maxLength('seat_number', 2)
            ->requirePresence('seat_number', 'create')
            ->notEmptyString('seat_number', '座席を選択してください。');

        $validator
            ->boolean('is_cancelled')
            ->notEmptyString('is_cancelled');

        $validator
            ->boolean('is_main_booked')
            ->notEmptyString('is_main_booked');

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
        $rules->add($rules->existsIn(['schedule_id'], 'MovieSchedules'));

        return $rules;
    }

    // ユーザーごとの予約済座席（キャンセルはされていない）を検索
    public function findBookingSeats(string $schedule_id)
    {
        $query = $this->find();
        $seat_numbers = $query
            // enableHydrationをfalseにすることで素の配列を取得できる
            ->enableHydration(false)
            ->select(['user_id', 'seat_number'])
            ->where([
                'schedule_id' => $schedule_id,
                'is_cancelled' => false
            ]);
        // toList()によって配列にする
        // 参考:https://qiita.com/kojimetal666/items/41d23aa32dd2d88da8de
        $seat_numbers_array = $seat_numbers->toList();
        return $seat_numbers_array;
    }

    // ユーザーごとの仮予約を取得
    public function findBookedTemporary(string $schedule_id, string $authuser_id)
    {
        $query = $this->find();
        $my_booked_temporary = $query
            ->enableHydration(false)
            ->select(['id', 'created'])
            ->where([
                'schedule_id' => $schedule_id,
                'user_id' => $authuser_id,
                'is_main_booked' => false,
                'is_cancelled' => false
            ]);
        $my_booked_temporary_array = $my_booked_temporary->toList();
        return $my_booked_temporary_array;
    }
}
