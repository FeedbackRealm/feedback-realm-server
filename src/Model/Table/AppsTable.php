<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\App;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Behavior\CounterCacheBehavior;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Routing\Router;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Apps Model
 *
 * @property UsersTable&BelongsTo $Users
 * @property CustomersTable&HasMany $Customers
 * @property FeedbacksTable&HasMany $Feedbacks
 * @property NotificationsTable&HasMany $Notifications
 * @property AppMembersTable&HasMany $AppMembers
 * @method App newEmptyEntity()
 * @method App newEntity(array $data, array $options = [])
 * @method App[] newEntities(array $data, array $options = [])
 * @method App get($primaryKey, $options = [])
 * @method App findOrCreate($search, ?callable $callback = null, $options = [])
 * @method App patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method App[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method App|false save(EntityInterface $entity, $options = [])
 * @method App saveOrFail(EntityInterface $entity, $options = [])
 * @method App[]|ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method App[]|ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method App[]|ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method App[]|ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin TimestampBehavior
 * @mixin CounterCacheBehavior
 */
class AppsTable extends TableBase
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

        $this->setTable('apps');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Users' => ['app_count'],
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Customers', [
            'foreignKey' => 'app_id',
        ]);
        $this->hasMany('Feedbacks', [
            'foreignKey' => 'app_id',
        ]);
        $this->hasMany('Notifications', [
            'foreignKey' => 'app_id',
        ]);
        $this->hasMany('AppMembers', [
            'foreignKey' => 'app_id',
        ]);

        $this->addBehavior('Notifiable', [
            'prepareNotificationFunc' => function (App $entity) {
                return $this->Notifications->newEntity([
                    'app_id' => $entity->id,
                ]);
            },
            'onUpdate' => [
                'titleFunc' => function (App $entity) {
                    return sprintf('The app %s was updated', $entity->name);
                },
                'bodyFunc' => function (App $entity) {
                    $user = $this->Users->get($entity->user_id);

                    $title = sprintf(
                        '%s made changes to the app %s.',
                        $user->name,
                        $entity->name
                    );

                    $url = Router::url([
                        'controller' => 'Apps',
                        'action' => 'view',
                        $entity->id,
                    ], true);

                    return sprintf('<a href="%s">%s</a>', $url, $title);
                },
                'userQueryFunc' => function (App $entity, Query $query) {
                    return $query->where([
                        'Users.id <>' => $entity->user_id,
                    ])->innerJoinWith('AppMembers', fn(Query $q) => $q->where([
                        'AppMembers.app_id' => $entity->id,
                    ]));
                },
                'notificationType' => 'info',
            ],
            'onDelete' => [
                'titleFunc' => function (App $entity) {
                    return sprintf('The app %s was deleted', $entity->name);
                },
                'bodyFunc' => function (App $entity) {
                    $user = $this->Users->get($entity->user_id);

                    return sprintf(
                        '%s deleted the app  %s.',
                        $user->name,
                        $entity->name
                    );
                },
                'userQueryFunc' => function (App $entity, Query $query) {
                    return $query->where([
                        'Users.id <>' => $entity->user_id,
                    ])->innerJoinWith('AppMembers', fn(Query $q) => $q->where([
                        'AppMembers.user_id' => $entity->user_id,
                    ]));
                },
                'notificationType' => 'danger',
            ],
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('logo')
            ->maxLength('logo', 100)
            ->allowEmptyString('logo');

        $validator
            ->scalar('description')
            ->maxLength('description', 200)
            ->allowEmptyString('description');

        $validator
            ->uuid('auth_token')
            ->notEmptyString('auth_token')
            ->add('auth_token', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->nonNegativeInteger('app_member_count')
            ->allowEmptyString('app_member_count');

        $validator
            ->nonNegativeInteger('customer_count')
            ->allowEmptyString('customer_count');

        $validator
            ->nonNegativeInteger('feedback_count')
            ->allowEmptyString('feedback_count');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param RulesChecker $rules The rules object to be modified.
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name']), ['errorField' => 'name']);
        $rules->add($rules->isUnique(['auth_token']), ['errorField' => 'auth_token']);
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    /**
     * Event is fired before each entity is saved
     *
     * @param EventInterface $event
     * @param App $entity
     * @param ArrayObject $options
     * @return void
     */
    public function beforeSave(EventInterface $event, App $entity, ArrayObject $options)
    {
        if ($entity->isNew()) {
            $entity->auth_token = Text::uuid();
        }
    }

    /**
     * Event is fired after an entity is saved
     *
     * @param EventInterface $event
     * @param App $entity
     * @param ArrayObject $options
     * @return void
     */
    public function afterSave(EventInterface $event, App $entity, ArrayObject $options)
    {
        if ($entity->isNew()) {
            $appMember = $this->AppMembers->newEntity([
                'app_id' => $entity->id,
                'user_id' => $entity->user_id,
            ]);
            $this->AppMembers->saveOrFail($appMember);
        }
    }
}
