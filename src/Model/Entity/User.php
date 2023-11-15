<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $password
 * @property string|null $avatar
 * @property bool|null $email_verified
 * @property int|null $app_count
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property App[] $apps
 * @property Notification[] $notifications
 * @property Team[] $teams
 */
class User extends Entity
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
        'name' => true,
        'email' => true,
        'password' => true,
        'avatar' => true,
        'email_verified' => true,
        'app_count' => true,
        'created' => true,
        'modified' => true,
        'apps' => true,
        'notifications' => true,
        'teams' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];

    /**
     * Hashes user passwords
     *
     * @param string $password the plain-text password
     * @return string|null
     */
    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}
