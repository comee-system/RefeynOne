<?php
use Migrations\AbstractMigration;

class DropGrapheDataPointTable extends AbstractMigration
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
        $this->table('graphe_data_point')
            ->drop()
            ->save();
    }
}
