<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Team;
use App\Model\Entity\User;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Behavior\CounterCacheBehavior;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Teams Model
 *
 * @property UsersTable&BelongsTo $Users
 * @property AppsTable&BelongsTo $Apps
 * @property NotificationsTable&HasMany $Notifications
 * @method Team newEmptyEntity()
 * @method Team newEntity(array $data, array $options = [])
 * @method Team[] newEntities(array $data, array $options = [])
 * @method Team get($primaryKey, $options = [])
 * @method Team findOrCreate($search, ?callable $callback = null, $options = [])
 * @method Team patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Team[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method Team|false save(EntityInterface $entity, $options = [])
 * @method Team saveOrFail(EntityInterface $entity, $options = [])
 * @method Team[]|ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method Team[]|ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method Team[]|ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method Team[]|ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin TimestampBehavior
 * @mixin CounterCacheBehavior
 */
class TeamsTable extends TableBase
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

        $this->setTable('teams');
        $this->setDisplayField('display_value');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Apps' => ['team_count'],
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Apps', [
            'foreignKey' => 'app_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Notifications')
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
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->nonNegativeInteger('app_id')
            ->notEmptyString('app_id');

        $validator
            ->nonNegativeInteger('notification_count')
            ->allowEmptyString('notification_count');

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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('app_id', 'Apps'), ['errorField' => 'app_id']);

        return $rules;
    }

    /**
     * Returns true when a user is part of an app team
     *
     * @param int $userId
     * @param int $appId
     * @return bool
     */
    public static function isTeamMember(int $userId, int $appId): bool
    {
        return TableRegistry::getTableLocator()
            ->get('Teams')
            ->exists([
            'user_id' => $userId,
            'app_id' => $appId,
        ]);
    }
}
