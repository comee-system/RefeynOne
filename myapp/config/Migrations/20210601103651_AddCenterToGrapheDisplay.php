<?php
use Migrations\AbstractMigration;

class AddCenterToGrapheDisplay extends AbstractMigration
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
        $table->addColumn('center', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'after' => 'min'
        ]);
        $table->update();
    }
}
