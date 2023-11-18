<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CustomerLastUpdatedBy extends AbstractMigration
{
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
        $this->table('customers')
            ->addColumn('last_updated_by', 'integer', [
                'after' => 'app_id',
                'default' => null,
                'length' => null,
                'null' => true,
                'signed' => false,
            ])
            ->addIndex(
                [
                    'last_updated_by',
                ],
                [
                    'name' => 'last_updated_by',
                ]
            )
            ->update();

        $this->table('feedbacks')
            ->addIndex(
                [
                    'app_id',
                ],
                [
                    'name' => 'app_id',
                ]
            )
            ->addIndex(
                [
                    'customer_id',
                ],
                [
                    'name' => 'customer_id',
                ]
            )
            ->addIndex(
                [
                    'type',
                ],
                [
                    'name' => 'type',
                ]
            )
            ->update();
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
        $this->table('customers')
            ->removeIndexByName('last_updated_by')
            ->update();

        $this->table('customers')
            ->removeColumn('last_updated_by')
            ->update();

        $this->table('feedbacks')
            ->removeIndexByName('app_id')
            ->removeIndexByName('customer_id')
            ->removeIndexByName('type')
            ->update();
    }
}
