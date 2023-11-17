<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class RenamedTeamsToAppMembers extends AbstractMigration
{
    public $autoId = false;

    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-up-method
     *
     * @return void
     */
    public function up(): void
    {
        $this->table('apps')
            ->removeColumn('team_count')
            ->update();
        $this->table('app_members')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('app_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('notification_count', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deleted', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'user_id',
                    'app_id',
                ],
                [
                    'name' => 'users_apps1',
                    'unique' => true,
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ],
                [
                    'name' => 'user_id1',
                ]
            )
            ->addIndex(
                [
                    'app_id',
                ],
                [
                    'name' => 'app_id1',
                ]
            )
            ->create();

        $this->table('apps')
            ->addColumn('app_member_count', 'integer', [
                'after' => 'auth_token',
                'default' => null,
                'length' => null,
                'null' => true,
                'signed' => false,
            ])
            ->update();

        $this->table('teams')->drop()->save();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-down-method
     *
     * @return void
     */
    public function down(): void
    {
        $this->table('teams')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('app_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('notification_count', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deleted', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'user_id',
                    'app_id',
                ],
                [
                    'name' => 'users_apps2',
                    'unique' => true,
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ],
                [
                    'name' => 'user_id2',
                ]
            )
            ->addIndex(
                [
                    'app_id',
                ],
                [
                    'name' => 'app_id2',
                ]
            )
            ->create();

        $this->table('apps')
            ->addColumn('team_count', 'integer', [
                'after' => 'auth_token',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->removeColumn('app_member_count')
            ->update();

        $this->table('app_members')->drop()->save();
    }
}
