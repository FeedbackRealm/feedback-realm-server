<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AppsFixture
 */
class AppsFixture extends TestFixture
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
                'user_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'logo' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'auth_token' => '82bbbe45-6882-498c-91b8-1ac7fb360c53',
                'team_count' => 1,
                'app_user_count' => 1,
                'feedback_count' => 1,
                'created' => '2023-11-14 07:54:48',
                'modified' => '2023-11-14 07:54:48',
            ],
        ];
        parent::init();
    }
}
