<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Customer;
use App\Model\Entity\User;
use App\Model\Table\AppMembersTable;
use Authorization\IdentityInterface;

/**
 * Customer policy
 */
class CustomerPolicy
{
    /**
     * Check if $user can edit a Customer
     *
     * @param IdentityInterface & User $user The user.
     * @param Customer $customer
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Customer $customer): bool
    {
        return AppMembersTable::isAppMember($user->id, $customer->app_id);
    }

    /**
     * Check if $user can delete a Customer
     *
     * @param IdentityInterface & User $user The user.
     * @param Customer $customer
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Customer $customer): bool
    {
        return false;
    }

    /**
     * Check if $user can view a Customer
     *
     * @param IdentityInterface & User $user The user.
     * @param Customer $customer
     * @return bool
     */
    public function canView(IdentityInterface $user, Customer $customer): bool
    {
        return AppMembersTable::isAppMember($user->id, $customer->app_id);
    }
}
