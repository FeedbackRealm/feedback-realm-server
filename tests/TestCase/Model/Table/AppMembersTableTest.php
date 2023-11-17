<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppMembersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppMembersTable Test Case
 */
class AppMembersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var AppMembersTable
     */
    protected $AppMembers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.AppMembers',
        'app.Users',
        'app.Apps',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AppMembers') ? [] : ['className' => AppMembersTable::class];
        $this->AppMembers = $this->getTableLocator()->get('AppMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->AppMembers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses AppMembersTable::validationDefault
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses AppMembersTable::buildRules
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
