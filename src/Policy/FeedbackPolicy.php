<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Feedback;
use App\Model\Entity\User;
use App\Model\Table\AppMembersTable;
use Authorization\IdentityInterface;

/**
 * Feedback policy
 */
class FeedbackPolicy
{
    /**
     * Check if $user can edit a Feedback
     *
     * @param IdentityInterface & User $user The user.
     * @param Feedback $feedback
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Feedback $feedback): bool
    {
        return false;
    }

    /**
     * Check if $user can delete a Feedback
     *
     * @param IdentityInterface & User $user The user.
     * @param Feedback $feedback
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Feedback $feedback): bool
    {
        return false;
    }

    /**
     * Check if $user can view a Feedback
     *
     * @param IdentityInterface & User $user The user.
     * @param Feedback $feedback
     * @return bool
     */
    public function canView(IdentityInterface $user, Feedback $feedback): bool
    {
        return AppMembersTable::isAppMember($user->id, $feedback->app_id);
    }
}
