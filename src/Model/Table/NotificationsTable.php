<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Notification;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Behavior\CounterCacheBehavior;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notifications Model
 *
 * @property AppsTable&BelongsTo $Apps
 * @property UsersTable&BelongsTo $Users
 * @property TeamsTable&BelongsTo $Teams
 * @method Notification newEmptyEntity()
 * @method Notification newEntity(array $data, array $options = [])
 * @method Notification[] newEntities(array $data, array $options = [])
 * @method Notification get($primaryKey, $options = [])
 * @method Notification findOrCreate($search, ?callable $callback = null, $options = [])
 * @method Notification patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Notification[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method Notification|false save(EntityInterface $entity, $options = [])
 * @method Notification saveOrFail(EntityInterface $entity, $options = [])
 * @method Notification[]|ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method Notification[]|ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method Notification[]|ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method Notification[]|ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin TimestampBehavior
 * @mixin CounterCacheBehavior
 */
class NotificationsTable extends Table
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

        $this->setTable('notifications');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Teams' => ['notification_count'],
        ]);
        $this->belongsTo('Apps', [
            'foreignKey' => 'app_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Teams')
            ->setForeignKey(['app_id', 'user_id'])
            ->setBindingKey(['app_id', 'user_id']);
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
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('type')
            ->maxLength('type', 20)
            ->notEmptyString('type');

        $validator
            ->scalar('title')
            ->maxLength('title', 100)
            ->notEmptyString('title');

        $validator
            ->scalar('body')
            ->maxLength('body', 200)
            ->notEmptyString('body');

        $validator
            ->dateTime('seen')
            ->allowEmptyDateTime('seen');

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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
