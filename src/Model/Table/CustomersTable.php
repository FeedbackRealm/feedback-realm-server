<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Customer;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Behavior\CounterCacheBehavior;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @property AppsTable&BelongsTo $Apps
 * @property FeedbacksTable&HasMany $Feedbacks
 * @property UsersTable&BelongsTo $LastUpdatedAuthor
 * @method Customer newEmptyEntity()
 * @method Customer newEntity(array $data, array $options = [])
 * @method Customer[] newEntities(array $data, array $options = [])
 * @method Customer get($primaryKey, $options = [])
 * @method Customer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method Customer patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Customer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method Customer|false save(EntityInterface $entity, $options = [])
 * @method Customer saveOrFail(EntityInterface $entity, $options = [])
 * @method Customer[]|ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method Customer[]|ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method Customer[]|ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method Customer[]|ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin TimestampBehavior
 * @mixin CounterCacheBehavior
 */
class CustomersTable extends TableBase
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

        $this->setTable('customers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Apps' => ['customer_count'],
        ]);

        $this->belongsTo('Apps', [
            'foreignKey' => 'app_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Feedbacks', [
            'foreignKey' => 'customer_id',
        ]);
        $this->belongsTo('LastUpdatedAuthor', [
            'className' => 'Users',
            'foreignKey' => 'last_updated_by',
            'joinType' => 'left',
            'propertyName' => 'last_updated_author',
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
            ->nonNegativeInteger('last_updated_by')
            ->allowEmptyString('last_updated_by');

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
        $rules->add($rules->existsIn('last_updated_by', 'LastUpdatedAuthor'), [
            'errorField' => 'last_updated_by',
        ]);

        return $rules;
    }
}
