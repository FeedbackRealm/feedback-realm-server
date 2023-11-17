<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\App;
use App\Model\Entity\User;
use App\Model\Table\TeamsTable;
use Authorization\IdentityInterface;

/**
 * App policy
 */
class AppPolicy
{
    /**
     * Check if $user can edit App
     *
     * @param IdentityInterface & User $user The user.
     * @param App $app
     * @return bool
     */
    public function canEdit(IdentityInterface $user, App $app): bool
    {
        return $app->user_id === $user->id;
    }

    /**
     * Check if $user can delete App
     *
     * @param IdentityInterface & User $user The user.
     * @param App $app
     * @return bool
     */
    public function canDelete(IdentityInterface $user, App $app): bool
    {
        return $app->user_id === $user->id;
    }

    /**
     * Check if $user can view App
     *
     * @param IdentityInterface & User $user The user.
     * @param App $app
     * @return bool
     */
    public function canView(IdentityInterface $user, App $app): bool
    {
        return TeamsTable::isAppMember($user->id, $app->id);
    }
}
