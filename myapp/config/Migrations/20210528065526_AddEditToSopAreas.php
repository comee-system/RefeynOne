<?php
use Migrations\AbstractMigration;

class AddEditToSopAreas extends AbstractMigration
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
        $table = $this->table('sop_areas');
        $table->addColumn('edit', 'integer', [
            'default' => null,
            'limit' => 3,
            'default'=> 0,
            'null' => true,
            'after' => 'maxpoint'
        ]);
        $table->update();
    }
}
