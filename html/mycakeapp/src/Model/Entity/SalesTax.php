<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesTax Entity
 *
 * @property int $id
 * @property int $rate
 * @property bool $is_applied
 * @property \Cake\I18n\Time $created
 */
class SalesTax extends Entity
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
        'rate' => true,
        'is_applied' => true,
        'created' => true,
    ];
}
