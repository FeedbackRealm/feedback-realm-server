<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppUsersTable Test Case
 */
class AppUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var AppUsersTable
     */
    protected $AppUsers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.AppUsers',
        'app.Apps',
        'app.Feedbacks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AppUsers') ? [] : ['className' => AppUsersTable::class];
        $this->AppUsers = $this->getTableLocator()->get('AppUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->AppUsers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses AppUsersTable::validationDefault
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses AppUsersTable::buildRules
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
