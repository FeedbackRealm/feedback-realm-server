<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * Team Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $app_id
 * @property int|null $notification_count
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property User $user
 * @property App $app
 *
 * @property string $display_value
 */
class Team extends Entity
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
        'user_id' => true,
        'app_id' => true,
        'notification_count' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'app' => true,
    ];

    /**
     * Team Display Field
     *
     * @return string
     */
    protected function _getDisplayValue(): string
    {
        return $this->user_id . ' - ' . $this->app_id;
    }
}
