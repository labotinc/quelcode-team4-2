<?php

namespace App\Model\Table;

use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use DateTime;
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

        $this->hasMany('PaymentHistories', [
            'foreignKey' => 'booking_id'
        ]);
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
            ->maxLength('seat_number', 2, '座席番号が不正です。')
            ->requirePresence('seat_number', 'create')
            ->notEmptyString('seat_number', '座席を選択してください。')
            ->add('seat_number', 'custom', ['rule' => function ($value, $context) {
                if (preg_match("/\A[A-K]{1}[1-8]{1}\z/", $value)) {
                    return true;
                } else {
                    return false;
                }
            }, 'message' => '座席番号が不正です。']);

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

    // 上映ごとの予約済座席（キャンセルはされていない）を検索
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
    public function findBookedTemporary(string $authuser_id)
    {
        $query = $this->find('all', ['contain' => ['MovieSchedules']]);
        $my_booked_temporary = $query
            // 現在時刻よりも新しい映画予約を取得
            ->enableHydration(false)
            ->select(['id', 'schedule_id', 'seat_number', 'created'])
            ->where([
                'user_id' => $authuser_id,
                'is_main_booked' => false,
                'is_cancelled' => false,
                'MovieSchedules.screening_start_datetime >= NOW()',
            ])
            ->order(['MovieSchedules.screening_start_datetime' => 'DESC']);
        $my_booked_temporary_array = $my_booked_temporary->toArray();
        return $my_booked_temporary_array;
    }

    // ユーザーごとの本予約を取得
    public function findBookedMain(string $authuser_id)
    {
        $query = $this
            ->find('all', ['contain' => ['MovieSchedules',]]);
        $my_booked_main = $query
            // 現在時刻よりも新しい映画予約を取得

            ->enableHydration(false)
            ->select([
                'id', 'schedule_id', 'seat_number',
            ])
            ->where([
                'user_id' => $authuser_id,
                'is_main_booked' => true,
                'is_cancelled' => false,
                'MovieSchedules.screening_start_datetime >= NOW()',
            ])
            ->order(['MovieSchedules.screening_start_datetime' => 'DESC']);;
        $my_booked_main_array = $my_booked_main->toArray();
        return $my_booked_main_array;
    }

    public function findBookedScheduleId($schedule_id)
    {
        $bookings = $this->find()
            ->select(['schedule_id'])
            ->where(['id' => $schedule_id, 'is_cancelled' => false])
            ->toList();
        return $bookings;
    }

    /**
     * ユーザー退会時の予約取り消しメソッド
     * 1. そのユーザーの
     * 2. まだキャンセルされてない
     * 3. 現在時刻より将来の
     * 予約をキャンセルする。
     */
    public function cancelBookings(string $user_id)
    {
        $now = date('Y-m-d h:i:s');
        $bookings = $this->find('all', ['contain' => ['MovieSchedules']])->where(['user_id' => $user_id, 'is_cancelled' => 0, 'MovieSchedules.screening_start_datetime >' => $now]);
        foreach ($bookings as $booking) {
            $booking = $booking->setIsCancelled();
        }
        return $bookings;
    }
}
