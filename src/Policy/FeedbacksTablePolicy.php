<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use Cake\ORM\Table;

/**
 * Feedbacks policy
 */
class FeedbacksTablePolicy extends BaseTablePolicy
{
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

    /**
     * @inheritDoc
     */
    public function canEdit(IdentityInterface $user, Table $table): bool
    {
        return false;
    }
}
