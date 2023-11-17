<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\AppUser;
use App\Model\Entity\User;
use App\Model\Table\AppMembersTable;
use Authorization\IdentityInterface;

/**
 * AppUser policy
 */
class AppUserPolicy
{
    /**
     * Check if $user can edit an AppUser
     *
     * @param IdentityInterface & User $user The user.
     * @param AppUser $appUser
     * @return bool
     */
    public function canEdit(IdentityInterface $user, AppUser $appUser): bool
    {
        return AppMembersTable::isAppMember($user->id, $appUser->app_id);
    }

    /**
     * Check if $user can delete an AppUser
     *
     * @param IdentityInterface & User $user The user.
     * @param AppUser $appUser
     * @return bool
     */
    public function canDelete(IdentityInterface $user, AppUser $appUser): bool
    {
        return false;
    }

    /**
     * Check if $user can view an AppUser
     *
     * @param IdentityInterface & User $user The user.
     * @param AppUser $appUser
     * @return bool
     */
    public function canView(IdentityInterface $user, AppUser $appUser): bool
    {
        return AppMembersTable::isAppMember($user->id, $appUser->app_id);
    }
}
