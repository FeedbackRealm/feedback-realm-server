<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;
use Cake\ORM\Table;

class BaseTablePolicy
{
    /**
     * Check if $user can view the entities
     *
     * @param IdentityInterface & User $user The user.
     * @param Table $table
     * @return bool
     */
    public function canIndex(IdentityInterface $user, Table $table): bool
    {
        return true;
    }

    /**
     * Check if $user can add the entities
     *
     * @param IdentityInterface & User $user The user.
     * @param Table $table
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Table $table): bool
    {
        return true;
    }

    /**
     * Check if $user can view entities
     *
     * @param IdentityInterface & User $user The user.
     * @param Table $table
     * @return bool
     */
    public function canView(IdentityInterface $user, Table $table): bool
    {
        return true;
    }

    /**
     * Check if $user can delete entities
     *
     * @param IdentityInterface & User $user The user.
     * @param Table $table
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Table $table): bool
    {
        return true;
    }

    /**
     * Check if $user can edit entities
     *
     * @param IdentityInterface&User $user The user.
     * @param Table $table
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Table $table): bool
    {
        return true;
    }
}
