<?php
use Migrations\AbstractMigration;

class ChangeCountsToGrapheDisplays extends AbstractMigration
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
        $table->changeColumn('counts1', 'string', [
            'default' => 0,
            'limit' => 128,
            'null' => false,
            'comment'=>'Number&count'
        ]);
        $table->changeColumn('counts2', 'string', [
            'default' => 0,
            'limit' => 128,
            'null' => false,
            'comment'=>'Mass&count'
        ]);
        $table->changeColumn('counts3', 'string', [
            'default' => 0,
            'limit' => 128,
            'null' => false,
            'comment'=>'Number&Normalized'
        ]);
        $table->changeColumn('counts4', 'string', [
            'default' => 0,
            'limit' => 128,
            'null' => false,
            'comment'=>'Mass&Normalized'
        ]);

        $table->changeColumn('scounts1', 'string', [
            'default' => 0,
            'limit' => 128,
            'null' => false,
            'comment'=>'smooth&Number&count'
        ]);
        $table->changeColumn('scounts2', 'string', [
            'default' => 0,
            'limit' => 128,
            'null' => false,
            'comment'=>'smooth&Mass&count'
        ]);
        $table->changeColumn('scounts3', 'string', [
            'default' => 0,
            'limit' => 128,
            'null' => false,
            'comment'=>'smooth&Number&Normalized'
        ]);
        $table->changeColumn('scounts4', 'string', [
            'default' => 0,
            'limit' => 128,
            'null' => false,
            'comment'=>'smooth&Mass&Normalized'
        ]);

        $table->update();
    }
}
