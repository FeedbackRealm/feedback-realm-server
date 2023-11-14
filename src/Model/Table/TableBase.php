<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Muffin\Trash\Model\Behavior\TrashBehavior;

/**
 * TableBase
 *
 * @mixin TrashBehavior
 */
class TableBase extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->addBehavior('Muffin/Trash.Trash', ['field' => 'deleted']);
    }
}
