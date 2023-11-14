<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotificationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotificationsTable Test Case
 */
class NotificationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var NotificationsTable
     */
    protected $Notifications;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Notifications',
        'app.Apps',
        'app.Users',
    ];

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses NotificationsTable::validationDefault
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses NotificationsTable::buildRules
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Notifications') ? [] : ['className' => NotificationsTable::class];
        $this->Notifications = $this->getTableLocator()->get('Notifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Notifications);

        parent::tearDown();
    }
}
