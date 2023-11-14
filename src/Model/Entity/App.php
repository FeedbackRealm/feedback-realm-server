<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * App Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $logo
 * @property string|null $description
 * @property string $auth_token
 * @property int|null $team_count
 * @property int|null $app_user_count
 * @property int|null $feedback_count
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property User $user
 * @property AppUser[] $app_users
 * @property Feedback[] $feedbacks
 * @property Notification[] $notifications
 * @property Team[] $teams
 */
class App extends Entity
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
        'name' => true,
        'logo' => true,
        'description' => true,
        'auth_token' => true,
        'team_count' => true,
        'app_user_count' => true,
        'feedback_count' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'app_users' => true,
        'feedbacks' => true,
        'notifications' => true,
        'teams' => true,
    ];
}
