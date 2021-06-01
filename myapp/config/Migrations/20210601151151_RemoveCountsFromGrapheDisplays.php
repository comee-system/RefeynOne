<?php
use Migrations\AbstractMigration;

class RemoveCountsFromGrapheDisplays extends AbstractMigration
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
        $table->removeColumn('counts1');
        $table->removeColumn('counts2');
        $table->removeColumn('counts3');
        $table->removeColumn('counts4');
        $table->removeColumn('scounts1');
        $table->removeColumn('scounts2');
        $table->removeColumn('scounts3');
        $table->removeColumn('scounts4');
        $table->update();
    }
}
