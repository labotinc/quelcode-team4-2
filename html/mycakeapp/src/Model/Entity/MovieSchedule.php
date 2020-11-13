<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Time;

/**
 * MovieSchedule Entity
 *
 * @property int $id
 * @property int $movie_id
 * @property \Cake\I18n\Time $screening_start_datetime
 * @property bool $is_playable
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Movie $movie
 */
class MovieSchedule extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'movie_id' => true,
        'screening_start_datetime' => true,
        'is_playable' => true,
        'created' => true,
        'modified' => true,
        'movie' => true,
    ];


    protected function _setScreeningStartDatetime($screening_start_datetime)
    {
        $now = Time::now();
        if ($screening_start_datetime > $now) {
            return $screening_start_datetime;
        } //else {
            //return $this->getError('screening_start_datetime', ['過去のスケジュールは登録できません']);
        //} エンティティクラスでエラーキャッチができず、save時にエラーキャッチしていたのでルールチェッカーでエラー処理
    }
}
