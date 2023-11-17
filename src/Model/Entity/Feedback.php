<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * Feedback Entity
 *
 * @property int $id
 * @property int $app_id
 * @property int $customer_id
 * @property string $type
 * @property string $title
 * @property string $body
 * @property string|null $meta
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 * @property FrozenTime|null $deleted
 *
 * @property App $app
 * @property Customer $customer
 */
class Feedback extends Entity
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
        'customer_id' => true,
        'type' => true,
        'title' => true,
        'body' => true,
        'meta' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'app' => true,
        'customer' => true,
    ];
}
