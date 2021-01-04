<?php

use Migrations\AbstractMigration;

class CreateMovies extends AbstractMigration
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
        $table = $this->table('movies');
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('thumbnail_path', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('total_minutes_with_trailer', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('screening_start_date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('screening_end_date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('is_screened', 'boolean', [
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
