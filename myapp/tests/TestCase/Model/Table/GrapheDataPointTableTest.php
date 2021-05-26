<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GrapheDataPointTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GrapheDataPointTable Test Case
 */
class GrapheDataPointTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GrapheDataPointTable
     */
    public $GrapheDataPoint;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.GrapheDataPoint',
        'app.Users',
        'app.Graphes',
        'app.GrapheDatas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GrapheDataPoint') ? [] : ['className' => GrapheDataPointTable::class];
        $this->GrapheDataPoint = TableRegistry::getTableLocator()->get('GrapheDataPoint', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GrapheDataPoint);

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
