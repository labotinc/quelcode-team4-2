<?php

use Migrations\AbstractMigration;

class AddIsMainBookedToBookings extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('bookings');
        $table->addColumn('is_main_booked', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->update();
    }
}
