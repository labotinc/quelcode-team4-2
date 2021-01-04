<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaymentHistory Entity
 *
 * @property int $id
 * @property int $booking_id
 * @property int $credit_card_id
 * @property int $price_id
 * @property int $discount_id
 * @property int $sales_tax_id
 * @property bool $is_cancelled
 * @property \Cake\I18n\Time $payment_request_created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Booking $booking
 * @property \App\Model\Entity\CreditCard[] $credit_cards
 * @property \App\Model\Entity\Price[] $prices
 * @property \App\Model\Entity\Discount[] $discounts
 * @property \App\Model\Entity\SalesTax[] $sales_taxes
 */
class PaymentHistory extends Entity
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
        'booking_id' => true,
        'credit_card_id' => true,
        'price_id' => true,
        'discount_id' => true,
        'sales_tax_id' => true,
        'is_cancelled' => true,
        'payment_request_created' => true,
        'modified' => true,
        'booking' => true,
        'credit_cards' => true,
        'prices' => true,
        'discounts' => true,
        'sales_taxes' => true,
    ];

    public function setIsCancelled()
    {
        $this->is_cancelled = true;
        return $this;
    }

    public function setTrueIsCancelled()
    {
        $this->is_cancelled = false;
        return $this;
    }
}
