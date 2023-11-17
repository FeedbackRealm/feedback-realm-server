<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AppMembersFixture
 */
class AppMembersFixture extends TestFixture
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
                'app_id' => 1,
                'notification_count' => 1,
                'created' => '2023-11-17 05:13:12',
                'modified' => '2023-11-17 05:13:12',
                'deleted' => '2023-11-17 05:13:12',
            ],
        ];
        parent::init();
    }
}
