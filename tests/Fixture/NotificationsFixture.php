<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NotificationsFixture
 */
class NotificationsFixture extends TestFixture
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
                'app_id' => 1,
                'user_id' => 1,
                'type' => 'Lorem ipsum dolor ',
                'title' => 'Lorem ipsum dolor sit amet',
                'body' => 'Lorem ipsum dolor sit amet',
                'seen' => '2023-11-14 19:18:13',
                'created' => '2023-11-14 19:18:13',
                'modified' => '2023-11-14 19:18:13',
            ],
        ];
        parent::init();
    }
}
