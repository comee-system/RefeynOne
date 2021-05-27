<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SopDefaultsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SopDefaultsTable Test Case
 */
class SopDefaultsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SopDefaultsTable
     */
    public $SopDefaults;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SopDefaults',
        'app.Users',
        'app.Graphes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SopDefaults') ? [] : ['className' => SopDefaultsTable::class];
        $this->SopDefaults = TableRegistry::getTableLocator()->get('SopDefaults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SopDefaults);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
