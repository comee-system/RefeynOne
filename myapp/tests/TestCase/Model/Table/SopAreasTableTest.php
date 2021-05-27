<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SopAreasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SopAreasTable Test Case
 */
class SopAreasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SopAreasTable
     */
    public $SopAreas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SopAreas',
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
        $config = TableRegistry::getTableLocator()->exists('SopAreas') ? [] : ['className' => SopAreasTable::class];
        $this->SopAreas = TableRegistry::getTableLocator()->get('SopAreas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SopAreas);

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
