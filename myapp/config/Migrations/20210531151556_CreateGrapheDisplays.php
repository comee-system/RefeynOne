<?php
use Migrations\AbstractMigration;

class CreateGrapheDisplays extends AbstractMigration
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
        $table = $this->table('graphe_displays');

        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('graphe_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('graphe_data_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('counts', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('max', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('min', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('number_flag', 'integer', [
            'default' => 0,
            'limit' => 3,
            'null' => false,
        ]);
        $table->addColumn('count_flag', 'integer', [
            'default' => 0,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('mass_flag', 'integer', [
            'default' => 0,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('normalized_flag', 'integer', [
            'default' => 0,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('smooth_flag', 'integer', [
            'default' => 0,
            'limit' => 3,
            'null' => true,
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
