<?php
use Migrations\AbstractMigration;

class AddstartdateToUsers extends AbstractMigration
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
        $table = $this->table('users');

        $table->addColumn('datestatus', 'integer', [
            'default' => 0,
            'limit' => 3,
            'null' => true,
            'after' => 'email'
        ]);
        $table->addColumn('startdate', 'date', [
            'default' => 0,
            'null' => true,
            'after' => 'datestatus'
        ]);
        $table->addColumn('enddate', 'date', [
            'default' => 0,
            'null' => true,
            'after' => 'startdate'
        ]);

        $table->update();
    }
}
