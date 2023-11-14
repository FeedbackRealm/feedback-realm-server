<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'avatar' => 'test_avatar.jpg',
                'email_verified' => 1,
                'app_count' => 1,
                'created' => '2023-11-14 07:54:24',
                'modified' => '2023-11-14 07:54:24',
            ],
        ];
        parent::init();
    }
}
