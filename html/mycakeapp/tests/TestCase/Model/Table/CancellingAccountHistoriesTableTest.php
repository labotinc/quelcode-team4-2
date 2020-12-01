<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CancellingAccountHistoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CancellingAccountHistoriesTable Test Case
 */
class CancellingAccountHistoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CancellingAccountHistoriesTable
     */
    public $CancellingAccountHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CancellingAccountHistories',
        'app.Users',
        'app.CancellingCategories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CancellingAccountHistories') ? [] : ['className' => CancellingAccountHistoriesTable::class];
        $this->CancellingAccountHistories = TableRegistry::getTableLocator()->get('CancellingAccountHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CancellingAccountHistories);

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
