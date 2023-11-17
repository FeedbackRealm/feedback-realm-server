<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use App\Model\Table\TeamsTable;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Check if $user can edit User
     *
     * @param IdentityInterface&User $user The user.
     * @param User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource): bool
    {
        return $user->id === $resource->id;
    }

    /**
     * Check if $user can view User
     *
     * @param IdentityInterface&User $user The user.
     * @param User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource): bool
    {
        return TeamsTable::isTeamMember($user->id, $resource->id);
    }
}
