<?php
declare(strict_types=1);

namespace App\Mailer;

use App\Model\Table\UsersTable;
use Cake\Mailer\Mailer;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Queue\Mailer\QueueTrait;

class UserMailer extends Mailer
{
    use QueueTrait;
    use LocatorAwareTrait;

    /**
     * Welcome Email
     *
     * @param int $userid the user
     * @return void
     */
    public function welcome(int $userid)
    {
        $user = $this->getUsersTable()->get($userid);
        $this
            ->setTo($user->email)
            ->setSubject(sprintf('Welcome %s', $user->name))
            ->viewBuilder()
            ->setVar('user', $user)
            ->setTemplate('welcome');
    }

    /**
     * Gets an instance of the UsersTable
     *
     * @return UsersTable
     */
    protected function getUsersTable(): UsersTable
    {
        /** @var UsersTable $table */
        $table = $this->fetchTable('Users');

        return $table;
    }
}
