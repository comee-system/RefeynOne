<?php
use Migrations\AbstractMigration;

class ChangeGraphToGraphePoints extends AbstractMigration
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
        $table = $this->table('graphe_points');
        $table->removeColumn('graph_id');
        $table->removeColumn('graph_data_id');

        $table->addColumn('graphe_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            "after" => 'id'
        ]);
        $table->addColumn('graphe_data_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            "after" => 'graphe_id'
        ]);

        $table->update();
    }
}
