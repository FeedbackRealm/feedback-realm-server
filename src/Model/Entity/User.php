<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\IdentityInterface as AuthenticationIdentity;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Authorization\AuthorizationServiceInterface;
use Authorization\IdentityInterface as AuthorizationIdentity;
use Authorization\Policy\ResultInterface;
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
 *
 * @property AuthorizationServiceInterface $authorization
 */
class User extends Entity implements AuthenticationIdentity, AuthorizationIdentity
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
     * Authentication\IdentityInterface method
     *
     * @return int
     */
    public function getIdentifier(): int
    {
        return $this->id;
    }

    /**
     * Authentication\IdentityInterface method
     *
     * @return User
     */
    public function getOriginalData(): User
    {
        return $this;
    }

    /**
     * Sets the Authorization service
     *
     * @param AuthorizationServiceInterface $service
     * @return User
     */
    public function setAuthorization(AuthorizationServiceInterface $service): User
    {
        $this->authorization = $service;

        return $this;
    }

    /**
     * Authorization\IdentityInterface method
     *
     * @param string $action
     * @param mixed $resource
     * @return bool
     */
    public function can(string $action, $resource): bool
    {
        return $this->authorization->can($this, $action, $resource);
    }

    /**
     * Authorization\IdentityInterface method
     *
     * @param string $action
     * @param mixed $resource
     * @return ResultInterface
     */
    public function canResult(string $action, $resource): ResultInterface
    {
        return $this->authorization->canResult($this, $action, $resource);
    }

    /**
     * Authorization\IdentityInterface method
     *
     * @param string $action
     * @param mixed $resource
     * @return mixed
     */
    public function applyScope(string $action, $resource)
    {
        return $this->authorization->applyScope($this, $action, $resource);
    }

    /**
     * Hashes user passwords
     *
     * @param string $password the plain-text password
     * @return string
     */
    protected function _setPassword(string $password): string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }

        return $password;
    }
}
