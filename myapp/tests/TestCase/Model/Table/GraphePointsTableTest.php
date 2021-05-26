<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GraphePointsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GraphePointsTable Test Case
 */
class GraphePointsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GraphePointsTable
     */
    public $GraphePoints;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.GraphePoints',
        'app.Users',
        'app.Graphs',
        'app.GraphDatas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GraphePoints') ? [] : ['className' => GraphePointsTable::class];
        $this->GraphePoints = TableRegistry::getTableLocator()->get('GraphePoints', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GraphePoints);

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
