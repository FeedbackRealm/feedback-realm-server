<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class RenamedAppUserToCustomer extends AbstractMigration
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
            ->removeColumn('app_user_count')
            ->update();

        $this->table('feedbacks')
            ->removeColumn('app_user_id')
            ->update();
        $this->table('customers')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('app_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('identifier', 'string', [
                'default' => '',
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('meta', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('feedback_count', 'integer', [
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
                    'app_id',
                    'identifier',
                ],
                [
                    'name' => 'app_user_identifier1',
                    'unique' => true,
                ]
            )
            ->addIndex(
                [
                    'app_id',
                ],
                [
                    'name' => 'app_id3',
                ]
            )
            ->create();

        $this->table('apps')
            ->addColumn('customer_count', 'integer', [
                'after' => 'app_member_count',
                'default' => null,
                'length' => null,
                'null' => true,
                'signed' => false,
            ])
            ->update();

        $this->table('feedbacks')
            ->addColumn('customer_id', 'integer', [
                'after' => 'app_id',
                'default' => null,
                'length' => null,
                'null' => false,
                'signed' => false,
            ])
            ->update();

        $this->table('app_users')->drop()->save();
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
        $this->table('app_users')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('app_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('identifier', 'string', [
                'default' => '',
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('meta', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('feedback_count', 'integer', [
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
                    'app_id',
                    'identifier',
                ],
                [
                    'name' => 'app_user_identifier2',
                    'unique' => true,
                ]
            )
            ->addIndex(
                [
                    'app_id',
                ],
                [
                    'name' => 'app_id4',
                ]
            )
            ->create();

        $this->table('apps')
            ->addColumn('app_user_count', 'integer', [
                'after' => 'app_member_count',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->removeColumn('customer_count')
            ->update();

        $this->table('feedbacks')
            ->addColumn('app_user_id', 'integer', [
                'after' => 'app_id',
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->removeColumn('customer_id')
            ->update();

        $this->table('customers')->drop()->save();
    }
}
