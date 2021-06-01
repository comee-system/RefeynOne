<?php
use Migrations\AbstractMigration;

class AddCounts1ToGrapheDisplay extends AbstractMigration
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
        $table->addColumn('counts1', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'graphe_data_id',
            'comment'=>'Number&count'
        ]);
        $table->addColumn('counts2', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'counts1',
            'comment'=>'Mass&count'
        ]);
        $table->addColumn('counts3', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'counts2',
            'comment'=>'Number&Normalized'
        ]);
        $table->addColumn('counts4', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'counts3',
            'comment'=>'Mass&Normalized'
        ]);
        $table->addColumn('scounts1', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'counts4',
            'comment'=>'smooth&Number&count'
        ]);
        $table->addColumn('scounts2', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'scounts1',
            'comment'=>'smooth&Mass&count'
        ]);
        $table->addColumn('scounts3', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'scounts2',
            'comment'=>'smooth&Number&Normalized'
        ]);
        $table->addColumn('scounts4', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'scounts3',
            'comment'=>'smooth&Mass&Normalized'
        ]);
        $table->update();
    }
}
