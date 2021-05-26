<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GrapheDatasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GrapheDatasTable Test Case
 */
class GrapheDatasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GrapheDatasTable
     */
    public $GrapheDatas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.GrapheDatas',
        'app.Users',
        'app.Graphes',
        'app.GrapheDataPoint',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GrapheDatas') ? [] : ['className' => GrapheDatasTable::class];
        $this->GrapheDatas = TableRegistry::getTableLocator()->get('GrapheDatas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GrapheDatas);

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
