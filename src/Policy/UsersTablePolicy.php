<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use Cake\ORM\Table;

/**
 * Users policy
 */
class UsersTablePolicy extends BaseTablePolicy
{
    /**
     * @inheritDoc
     */
    public function canIndex(IdentityInterface $user, Table $table): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function canAdd(IdentityInterface $user, Table $table): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function canDelete(IdentityInterface $user, Table $table): bool
    {
        return false;
    }
}
