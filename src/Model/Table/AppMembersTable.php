<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\AppMember;
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
 * AppMembers Model
 *
 * @property UsersTable&BelongsTo $Users
 * @property AppsTable&BelongsTo $Apps
 * @property NotificationsTable&HasMany $Notifications
 * @method AppMember newEmptyEntity()
 * @method AppMember newEntity(array $data, array $options = [])
 * @method AppMember[] newEntities(array $data, array $options = [])
 * @method AppMember get($primaryKey, $options = [])
 * @method AppMember findOrCreate($search, ?callable $callback = null, $options = [])
 * @method AppMember patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method AppMember[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method AppMember|false save(EntityInterface $entity, $options = [])
 * @method AppMember saveOrFail(EntityInterface $entity, $options = [])
 * @method AppMember[]|ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method AppMember[]|ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method AppMember[]|ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method AppMember[]|ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin TimestampBehavior
 * @mixin CounterCacheBehavior
 */
class AppMembersTable extends TableBase
{
    /**
     * Returns true when a user is part of an app team
     *
     * @param int $userId
     * @param int $appId
     * @return bool
     */
    public static function isAppMember(int $userId, int $appId): bool
    {
        return TableRegistry::getTableLocator()
            ->get('AppMembers')
            ->exists([
                'user_id' => $userId,
                'app_id' => $appId,
            ]);
    }

    /**
     * Returns true is 2 user ids exist in the same app
     *
     * @param int $user1Id
     * @param int $user2Id
     * @return bool
     */
    public static function isTeamMember(int $user1Id, int $user2Id): bool
    {
        $appMembers = TableRegistry::getTableLocator()->get('AppMembers');

        $matching = $appMembers->subquery()
            ->select(['app_id'])
            ->distinct()
            ->where(['user_id' => $user1Id]);

        return $appMembers->exists([
            'app_id IN' => $matching,
            'user_id' => $user2Id,
        ]);
    }

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('app_members');
        $this->setDisplayField('display_value');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Apps' => ['app_member_count'],
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
}
