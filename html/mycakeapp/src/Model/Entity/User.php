<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property \Cake\I18n\Date $birthdate
 * @property string $sex
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'birthdate' => true,
        'sex' => true,
        'is_deleted' => true,
        'created' => true,
        'modified' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];


    /**
     * パスワードのハッシュ化
     */
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }

    // -- 仮想プロパティの作成 --
    // ユーザーの性別を日本語表記に変換
    protected function _getUserSex()
    {
        $sex_number = $this->sex;
        if ($sex_number === '0') {
            return $this->sex = '未選択';
        } elseif ($sex_number === '1') {
            return $this->sex = '男性';
        } elseif ($sex_number === '2') {
            return $this->sex = '女性';
        } elseif ($sex_number === '9') {
            return $this->sex = 'その他';
        }
    }

    // 誕生日をYYYYMMDDに変換
    protected function _getUserBirthdate()
    {
        return $this->birthdate->format('Y年m月d日');
    }
}
