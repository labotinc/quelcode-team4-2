<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Booking Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $schedule_id
 * @property string $seat_number
 * @property bool $is_cancelled
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Schedule $schedule
 */
class Booking extends Entity
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
        'user_id' => true,
        'schedule_id' => true,
        'seat_number' => true,
        'is_cancelled' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'schedule' => true,
    ];
}
