<?php
use Migrations\AbstractMigration;

class AddUsersToCampany extends AbstractMigration
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
        $table->addColumn('campany', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
            'after' => 'email'
        ]);
        $table->addColumn('sei', 'string', [
            'default' => null,
            'limit' => 128,
            'null' => true,
            'after' => 'campany'
        ]);
        $table->addColumn('mei', 'string', [
            'default' => null,
            'limit' => 128,
            'null' => true,
            'after' => 'sei'
        ]);
        $table->addColumn('sei_kana', 'string', [
            'default' => null,
            'limit' => 128,
            'null' => true,
            'after' => 'mei'
        ]);
        $table->addColumn('mei_kana', 'string', [
            'default' => null,
            'limit' => 128,
            'null' => true,
            'after' => 'sei_kana'
        ]);
        $table->update();
    }
}
