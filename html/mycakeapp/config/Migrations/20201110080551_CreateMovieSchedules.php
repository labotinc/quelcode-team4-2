<?php

use Migrations\AbstractMigration;

class CreateMovieSchedules extends AbstractMigration
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
        $table = $this->table('movie_schedules');
        $table->addColumn('movie_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('screening_start_datetime', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('is_playable', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
