<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TeamsFixture
 */
class TeamsFixture extends TestFixture
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
                'created' => '2023-11-14 07:54:31',
                'modified' => '2023-11-14 07:54:31',
            ],
        ];
        parent::init();
    }
}
