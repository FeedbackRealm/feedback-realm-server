<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Customer;
use App\Model\Entity\Feedback;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Behavior\CounterCacheBehavior;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Routing\Router;
use Cake\Validation\Validator;

/**
 * Feedbacks Model
 *
 * @property AppsTable&BelongsTo $Apps
 * @property CustomersTable&BelongsTo $Customers
 * @method Feedback newEmptyEntity()
 * @method Feedback newEntity(array $data, array $options = [])
 * @method Feedback[] newEntities(array $data, array $options = [])
 * @method Feedback get($primaryKey, $options = [])
 * @method Feedback findOrCreate($search, ?callable $callback = null, $options = [])
 * @method Feedback patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Feedback[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method Feedback|false save(EntityInterface $entity, $options = [])
 * @method Feedback saveOrFail(EntityInterface $entity, $options = [])
 * @method Feedback[]|ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method Feedback[]|ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method Feedback[]|ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method Feedback[]|ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin TimestampBehavior
 * @mixin CounterCacheBehavior
 */
class FeedbacksTable extends TableBase
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

        $this->setTable('feedbacks');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Apps' => ['feedback_count'],
            'Customers' => ['feedback_count'],
        ]);

        $this->belongsTo('Apps', [
            'foreignKey' => 'app_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
        ]);

        $this->addBehavior('Notifiable', [
            'prepareNotificationFunc' => function (Feedback $entity) {
                return $this->Apps->Users->Notifications->newEntity([
                    'app_id' => $entity->app_id,
                ]);
            },
            'onCreate' => [
                'titleFunc' => function (Feedback $entity) {
                    $app = $this->Apps->get($entity->app_id);

                    return sprintf('A %s Feedback was left for %s', $entity->type, $app->name);
                },
                'bodyFunc' => function (Feedback $entity) {
                    $title = sprintf(
                        'Customer %s has a new %s Feedback: %s.',
                        $entity->customer_id,
                        $entity->type,
                        $entity->title,
                    );

                    $url = Router::url([
                        'controller' => 'Feedbacks',
                        'action' => 'view',
                        $entity->id,
                    ], true);

                    return sprintf('<a href="%s">%s</a>', $url, $title);
                },
                'userQueryFunc' => function (Feedback $entity, Query $query) {
                    return $query->innerJoinWith('AppMembers', fn(Query $q) => $q->where([
                        'AppMembers.app_id' => $entity->app_id,
                    ]));
                },
                'notificationType' => 'info',
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
            ->nonNegativeInteger('app_id')
            ->notEmptyString('app_id');

        $validator
            ->nonNegativeInteger('customer_id')
            ->notEmptyString('customer_id');

        $validator
            ->scalar('type')
            ->maxLength('type', 32)
            ->notEmptyString('type');

        $validator
            ->scalar('title')
            ->maxLength('title', 50)
            ->notEmptyString('title');

        $validator
            ->scalar('body')
            ->maxLength('body', 300)
            ->notEmptyString('body');

        $validator
            ->scalar('meta')
            ->allowEmptyString('meta');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

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
        $rules->add($rules->existsIn('app_id', 'Apps'), ['errorField' => 'app_id']);
        $rules->add($rules->existsIn('customer_id', 'Customers'), ['errorField' => 'customer_id']);

        return $rules;
    }
}
