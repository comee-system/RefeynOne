<?php
use Migrations\AbstractMigration;

class DropGraphDetailsTable extends AbstractMigration
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
        $this->table('graph_details')
            ->drop()
            ->save();
    }
}
