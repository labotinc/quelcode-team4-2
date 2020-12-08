<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CancellingAccountHistory Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $cancelling_category_id
 * @property \Cake\I18n\Time $cancelled
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\CancellingCategory $cancelling_category
 */
class CancellingAccountHistory extends Entity
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
        'cancelling_category_id' => true,
        'cancelled' => true,
        'user' => true,
        'cancelling_account_category' => true,
    ];

    /**
     * 自主退会するユーザーのエンティティの値をセットするメソッド
     * --------cancelling_category_id = 1 を自主退会とする ------------
     * @return エンティティ
     */
     public function setHistory(string $user_id)
    {
        $this->user_id = $user_id;
        $this->cancelling_category_id = 1;
        $this->cancelled = date("Y-m-d H:i:s");
        return $this;
    }
}
