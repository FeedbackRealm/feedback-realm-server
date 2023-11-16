<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\AppUser;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Behavior\CounterCacheBehavior;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

/**
 * AppUsers Model
 *
 * @property AppsTable&BelongsTo $Apps
 * @property FeedbacksTable&HasMany $Feedbacks
 * @method AppUser newEmptyEntity()
 * @method AppUser newEntity(array $data, array $options = [])
 * @method AppUser[] newEntities(array $data, array $options = [])
 * @method AppUser get($primaryKey, $options = [])
 * @method AppUser findOrCreate($search, ?callable $callback = null, $options = [])
 * @method AppUser patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method AppUser[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method AppUser|false save(EntityInterface $entity, $options = [])
 * @method AppUser saveOrFail(EntityInterface $entity, $options = [])
 * @method AppUser[]|ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method AppUser[]|ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method AppUser[]|ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method AppUser[]|ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin TimestampBehavior
 * @mixin CounterCacheBehavior
 */
class AppUsersTable extends TableBase
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

        $this->setTable('app_users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Apps' => ['app_user_count'],
        ]);

        $this->belongsTo('Apps', [
            'foreignKey' => 'app_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Feedbacks', [
            'foreignKey' => 'app_user_id',
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
            ->scalar('identifier')
            ->maxLength('identifier', 40)
            ->notEmptyString('identifier');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->allowEmptyString('name');

        $validator
            ->scalar('meta')
            ->allowEmptyString('meta');

        $validator
            ->nonNegativeInteger('feedback_count')
            ->allowEmptyString('feedback_count');

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

        return $rules;
    }
}
