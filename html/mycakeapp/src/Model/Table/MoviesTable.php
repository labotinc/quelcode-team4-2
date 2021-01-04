<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
// Typeクラスを追加
use Cake\Database\Type;

/**
 * Movies Model
 *
 * @method \App\Model\Entity\Movie get($primaryKey, $options = [])
 * @method \App\Model\Entity\Movie newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Movie[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Movie|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Movie saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Movie patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Movie[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Movie findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MoviesTable extends Table
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

        $this->setTable('movies');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('MovieSchedules', [
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('thumbnail_path')
            ->maxLength('thumbnail_path', 100)
            ->requirePresence('thumbnail_path', 'create')
            ->notEmptyString('thumbnail_path')
            // ファイル末尾を正規表現にかけることで拡張子を確認
            ->add('thumbnail_path', 'custom', [
                'rule' => function ($value, $context) {
                    return (bool) preg_match('/\.jpeg\z|\.jpg\z|\.png\z/i', $value);
                },
                'message' => 'ファイル形式が正しくありません。'
            ]);

        $validator
            ->integer('total_minutes_with_trailer')
            ->requirePresence('total_minutes_with_trailer', 'create')
            ->notEmptyString('total_minutes_with_trailer');

        $validator
            ->date('screening_start_date')
            ->requirePresence('screening_start_date', 'create')
            ->notEmptyDate('screening_start_date');

        $validator
            ->date('screening_end_date')
            ->requirePresence('screening_end_date', 'create')
            ->notEmptyDate('screening_end_date')
            ->add(
                'screening_end_date',
                'custom',
                [
                    'rule' => function ($value, $start_time) {
                        // 公開日と終了日の比較（参照:https://qiita.com/ichi404/items/b5cdc06d3fa605c732c1)
                        // 日付比較をTypeクラスを用いて実装
                        // Type::build('date')->でイミュータブル（変更不可）なdateオブジェクトを作成
                        // marshal()でフォームで取得したデータを引数し、PHPの型に変換
                        $end = Type::build('date')->marshal($value);
                        $start = Type::build('date')->marshal($start_time['data']['screening_start_date']);
                        //gt():「>」の条件を作成。つまり$end > $start
                        return $end->gte($start);
                    },
                    'message' => '終了日は開始日より後にしてください'
                ]
            );

        $validator
            ->boolean('is_screened')
            ->notEmptyString('is_screened');

        return $validator;
    }
}
