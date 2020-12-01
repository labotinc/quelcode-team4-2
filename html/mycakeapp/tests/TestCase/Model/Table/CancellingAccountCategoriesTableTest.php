<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CancellingAccountCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CancellingAccountCategoriesTable Test Case
 */
class CancellingAccountCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CancellingAccountCategoriesTable
     */
    public $CancellingAccountCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CancellingAccountCategories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CancellingAccountCategories') ? [] : ['className' => CancellingAccountCategoriesTable::class];
        $this->CancellingAccountCategories = TableRegistry::getTableLocator()->get('CancellingAccountCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CancellingAccountCategories);

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
}
