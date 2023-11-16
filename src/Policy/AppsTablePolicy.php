<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use App\Model\Table\AppsTable;
use Authorization\IdentityInterface;
use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 * Apps policy
 */
class AppsTablePolicy extends BaseTablePolicy
{
}
