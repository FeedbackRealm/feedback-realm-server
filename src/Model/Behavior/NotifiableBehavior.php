<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use App\Exception\NotificationException;
use App\Model\Entity\Notification;
use App\Model\Table\NotificationsTable;
use App\Model\Table\UsersTable;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\TableRegistry;

/**
 * Notifiable behavior
 */
class NotifiableBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [
        'prepareNotificationFunc' => null, // callable that returns a notification
        'onCreate' => [
            'titleFunc' => null, // callable that returns string
            'bodyFunc' => null, // callable that returns string
            'userQueryFunc' => null, // callable that returns a query or a query
            'notificationType' => 'success',
        ],
        'onUpdate' => [
            'titleFunc' => null, // callable that returns string
            'bodyFunc' => null, // callable that returns string
            'userQueryFunc' => null, // callable that returns a query or a query
            'notificationType' => 'info',
        ],
        'onDelete' => [
            'titleFunc' => null, // callable that returns string
            'bodyFunc' => null, // callable that returns string
            'userQueryFunc' => null, // callable that returns a query or a query
            'notificationType' => 'danger',
        ],
    ];

    /**
     * Gets the Notifications Table
     *
     * @return NotificationsTable
     */
    protected function getNotificationsTable(): NotificationsTable
    {
        /** @var NotificationsTable $table */
        $table = TableRegistry::getTableLocator()->get('Notifications');

        return $table;
    }

    /**
     * Gets the Users Table
     *
     * @return UsersTable
     */
    protected function getUsersTable(): UsersTable
    {
        /** @var UsersTable $table */
        $table = TableRegistry::getTableLocator()->get('Users');

        return $table;
    }

    /**
     * @param array $arguments
     * @param string $configKey
     * @param bool $expectedTypeIsString
     * @param string|null $expectedType
     * @return string|SelectQuery
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    protected function getCallableValue(
        array $arguments,
        string $configKey,
        bool $expectedTypeIsString = true,
        ?string $expectedType = null
    ) {
        $func = $this->getConfig($configKey);
        $valueType = $expectedTypeIsString ? 'string' : SelectQuery::class;

        if (!is_callable($func)) {
            throw new NotificationException(sprintf(
                'The "%s" value for "%s" should be a callable.',
                $configKey,
                $this->table()->getAlias(),
            ));
        }
        $value = $func(...$arguments);
        if (
            ($expectedTypeIsString && !is_string($value)) ||
            (!$expectedTypeIsString && get_class($value) !== $expectedType)
        ) {
            throw new NotificationException(sprintf(
                'The return value for "%s" should be a %s. "%s" given.',
                $configKey,
                $valueType,
                get_class($value)
            ));
        }

        return $value;
    }

    /**
     * @param string $configKey
     * @param EntityInterface $entity
     * @return void
     */
    protected function prepare(string $configKey, EntityInterface $entity)
    {
        if ($this->getConfig($configKey) === null) {
            return;
        }

        $title = $this->getCallableValue([$entity], $configKey . '.titleFunc', true);
        $body = $this->getCallableValue([$entity], $configKey . '.bodyFunc', true);
        /** @var SelectQuery $userQuery */
        $userQuery = $this->getCallableValue(
            [$entity, $this->getUsersTable()->selectQuery()],
            $configKey . '.userQueryFunc',
            false,
            SelectQuery::class
        );

        /** @var Notification $notification */
        $notification = $this->getCallableValue(
            [$entity],
            'prepareNotificationFunc',
            false,
            Notification::class
        );

        $notificationsData = [];
        $users = $userQuery->all();
        foreach ($users as $user) {
            $notificationsData[] = array_merge($notification->toArray(), [
                'user_id' => $user->id,
                'type' => $this->getConfig($configKey . '.notificationType'),
                'title' => $title,
                'body' => $body,
            ]);
        }

        try {
            $notifications = $this->getNotificationsTable()->newEntities($notificationsData);
            $this->getNotificationsTable()->saveManyOrFail($notifications);
        } catch (\Throwable $exception) {
            throw new NotificationException(sprintf(
                'Unable to create notifications due to error: %s',
                $exception->getMessage()
            ), null, $exception);
        }
    }

    /**
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if ($entity->isNew()) {
            $this->prepare('onCreate', $entity);
        } else {
            $this->prepare('onUpdate', $entity);
        }
    }

    /**
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function afterDelete(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->prepare('onDelete', $entity);
    }
}
