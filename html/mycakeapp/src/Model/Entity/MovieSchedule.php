<?php

namespace App\Model\Entity;

use Cake\Chronos\Chronos;
use Cake\I18n\Time;
use Cake\ORM\Entity;

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

    // 曜日のフォーマット関数 p50で使用
    public function _getScreeningStartWeek()
    {
        $week = array('日', '月', '火', '水', '木', '金', '土');
        $screening_start_datetime = new Time($this->screening_start_datetime);
        $screening_start_week = $week[$screening_start_datetime->format("w")];
        return $screening_start_week;
    }
}
