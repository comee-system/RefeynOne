<?php
use Migrations\AbstractMigration;

class RemoveFlagFromGrapheDisplays extends AbstractMigration
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
        $table->removeColumn('number_flag');
        $table->removeColumn('count_flag');
        $table->removeColumn('mass_flag');
        $table->removeColumn('normalized_flag');
        $table->removeColumn('smooth_flag');
        $table->update();
    }
}
