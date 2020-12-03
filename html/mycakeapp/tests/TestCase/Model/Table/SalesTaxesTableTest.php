<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalesTaxesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalesTaxesTable Test Case
 */
class SalesTaxesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SalesTaxesTable
     */
    public $SalesTaxes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SalesTaxes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SalesTaxes') ? [] : ['className' => SalesTaxesTable::class];
        $this->SalesTaxes = TableRegistry::getTableLocator()->get('SalesTaxes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SalesTaxes);

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
