<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Movie Entity
 *
 * @property int $id
 * @property string $title
 * @property string $thumbnail_path
 * @property int $total_minutes_with_trailer
 * @property \Cake\I18n\Date $screening_start_date
 * @property \Cake\I18n\Date $screening_end_date
 * @property bool $is_screened
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Movie extends Entity
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
        'title' => true,
        'thumbnail_path' => true,
        'total_minutes_with_trailer' => true,
        'screening_start_date' => true,
        'screening_end_date' => true,
        'is_screened' => true,
        'created' => true,
        'modified' => true,
    ];
}
