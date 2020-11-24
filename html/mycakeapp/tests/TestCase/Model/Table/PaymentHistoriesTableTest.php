<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentHistoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentHistoriesTable Test Case
 */
class PaymentHistoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentHistoriesTable
     */
    public $PaymentHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PaymentHistories',
        'app.Bookings',
        'app.CreditCards',
        'app.Prices',
        'app.Discounts',
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
        $config = TableRegistry::getTableLocator()->exists('PaymentHistories') ? [] : ['className' => PaymentHistoriesTable::class];
        $this->PaymentHistories = TableRegistry::getTableLocator()->get('PaymentHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PaymentHistories);

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
