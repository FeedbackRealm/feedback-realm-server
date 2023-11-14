<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Feedback;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Behavior\CounterCacheBehavior;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Feedbacks Model
 *
 * @property AppsTable&BelongsTo $Apps
 * @property AppUsersTable&BelongsTo $AppUsers
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
class FeedbacksTable extends Table
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
        ]);

        $this->belongsTo('Apps', [
            'foreignKey' => 'app_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AppUsers', [
            'foreignKey' => 'app_user_id',
            'joinType' => 'INNER',
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
            ->nonNegativeInteger('app_user_id')
            ->notEmptyString('app_user_id');

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
        $rules->add($rules->existsIn('app_user_id', 'AppUsers'), ['errorField' => 'app_user_id']);

        return $rules;
    }
}
