<?php
use Migrations\AbstractMigration;

class AddUserIdToGrapheDataPoint extends AbstractMigration
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
        $table = $this->table('graphe_data_point');
        $table->addColumn('user_id', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => false,
            'after' => 'id'
        ]);
        $table->addColumn('graphe_id', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'user_id'
        ]);
        $table->update();
    }
}
