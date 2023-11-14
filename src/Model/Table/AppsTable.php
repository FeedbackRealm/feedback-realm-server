<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\App;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Behavior\CounterCacheBehavior;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Apps Model
 *
 * @property UsersTable&BelongsTo $Users
 * @property AppUsersTable&HasMany $AppUsers
 * @property FeedbacksTable&HasMany $Feedbacks
 * @property NotificationsTable&HasMany $Notifications
 * @property TeamsTable&HasMany $Teams
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
class AppsTable extends Table
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
        $this->hasMany('AppUsers', [
            'foreignKey' => 'app_id',
        ]);
        $this->hasMany('Feedbacks', [
            'foreignKey' => 'app_id',
        ]);
        $this->hasMany('Notifications', [
            'foreignKey' => 'app_id',
        ]);
        $this->hasMany('Teams', [
            'foreignKey' => 'app_id',
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
            ->nonNegativeInteger('team_count')
            ->allowEmptyString('team_count');

        $validator
            ->nonNegativeInteger('app_user_count')
            ->allowEmptyString('app_user_count');

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
}
