<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class TrashField extends AbstractMigration
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
        $this->table('notifications')
            ->removeColumn('read')
            ->update();

        $this->table('app_users')
            ->addColumn('deleted', 'datetime', [
                'after' => 'modified',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

        $this->table('apps')
            ->addColumn('deleted', 'datetime', [
                'after' => 'modified',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

        $this->table('feedbacks')
            ->addColumn('deleted', 'datetime', [
                'after' => 'modified',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

        $this->table('notifications')
            ->addColumn('seen', 'datetime', [
                'after' => 'body',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('deleted', 'datetime', [
                'after' => 'modified',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

        $this->table('teams')
            ->addColumn('deleted', 'datetime', [
                'after' => 'modified',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

        $this->table('users')
            ->addColumn('deleted', 'datetime', [
                'after' => 'modified',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
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
        $this->table('app_users')
            ->removeColumn('deleted')
            ->update();

        $this->table('apps')
            ->removeColumn('deleted')
            ->update();

        $this->table('feedbacks')
            ->removeColumn('deleted')
            ->update();

        $this->table('notifications')
            ->addColumn('read', 'datetime', [
                'after' => 'body',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->removeColumn('seen')
            ->removeColumn('deleted')
            ->update();

        $this->table('teams')
            ->removeColumn('deleted')
            ->update();

        $this->table('users')
            ->removeColumn('deleted')
            ->update();
    }
}
