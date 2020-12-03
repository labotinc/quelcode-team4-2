<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

/**
 * CreditCard Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $card_number
 * @property string $holder_name
 * @property string $expiration_date
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\PaymentHistory $payment_history
 */
class CreditCard extends Entity
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
        'card_number' => true,
        'holder_name' => true,
        'expiration_date' => true,
        'is_deleted' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'payment_history' => true,
    ];

    public function encrypt()
    {
        $IV = Configure::read('IV');
        $method = Configure::read('method');
        $option = Configure::read('option');
        // 鍵を環境変数から取得
        $DEV_KEY = getenv("DEV_KEY");
        $this->card_number = openssl_encrypt($this->card_number, $method, $DEV_KEY, $option, $IV);
        $this->holder_name = openssl_encrypt($this->holder_name, $method, $DEV_KEY, $option, $IV);
        $this->expiration_date = openssl_encrypt($this->expiration_date, $method, $DEV_KEY, $option, $IV);
        return $this;
    }


    public function decrypt() {
        $IV = Configure::read('IV');
        $method = Configure::read('method');
        $option = Configure::read('option');
        $DEV_KEY = getenv("DEV_KEY");
        $this->card_number = openssl_decrypt($this->card_number, $method, $DEV_KEY, $option, $IV);
        $this->holder_name = openssl_decrypt($this->holder_name, $method, $DEV_KEY, $option, $IV);
        $this->expiration_date = openssl_decrypt($this->expiration_date, $method, $DEV_KEY, $option, $IV);
        return $this;
    }

    // $user_idに値をセットする関数
    public function setUserId($user_id) {
        $this->user_id = $user_id;
        return $this;
    }
    // $is_deletedに値をセットする関数
    public function setIsDeleted() {
        $this->is_deleted = 0;
        return $this;
    }

    // ユーザーがクレジットカード情報を削除する際、暗号化された情報を全て"0000"で上書きし、削除フラグを更新する。
    public function showAsDeleted() {
        $this->card_number = "0000";
        $this->holder_name = "0000";
        $this->expiration_date = "0000";
        $this->is_deleted = 1;
        return $this;
    }
}
