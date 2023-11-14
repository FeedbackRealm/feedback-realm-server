<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * AppUser Entity
 *
 * @property int $id
 * @property int $app_id
 * @property string $identifier
 * @property string|null $name
 * @property string|null $meta
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property App $app
 * @property Feedback[] $feedbacks
 */
class AppUser extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'app_id' => true,
        'identifier' => true,
        'name' => true,
        'meta' => true,
        'created' => true,
        'modified' => true,
        'app' => true,
        'feedbacks' => true,
    ];
}