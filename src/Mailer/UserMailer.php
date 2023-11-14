<?php
declare(strict_types=1);

namespace App\Mailer;

use App\Model\Entity\User;
use Cake\Mailer\Mailer;

class UserMailer extends Mailer
{
    /**
     * Welcome Email
     *
     * @param User $user the user
     * @return void
     */
    public function welcome(User $user)
    {
        $this
            ->setTo($user->email)
            ->setSubject(sprintf('Welcome %s', $user->name))
            ->viewBuilder()
            ->setVar('user', $user)
            ->setTemplate('welcome');
    }
}
