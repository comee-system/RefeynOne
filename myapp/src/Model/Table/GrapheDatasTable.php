<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GrapheDatas Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\GraphesTable&\Cake\ORM\Association\BelongsTo $Graphes
 *
 * @method \App\Model\Entity\GrapheData get($primaryKey, $options = [])
 * @method \App\Model\Entity\GrapheData newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GrapheData[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GrapheData|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GrapheData saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GrapheData patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GrapheData[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GrapheData findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GrapheDatasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('graphe_datas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Graphes', [
            'foreignKey' => 'graphe_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('label')
            ->maxLength('label', 256)
            ->requirePresence('label', 'create')
            ->notEmptyString('label');

        $validator
            ->scalar('filename')
            ->maxLength('filename', 256)
            ->requirePresence('filename', 'create')
            ->notEmptyFile('filename');

        $validator
            ->integer('counts')
            ->requirePresence('counts', 'create')
            ->notEmptyString('counts');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['graphe_id'], 'Graphes'));

        return $rules;
    }
}
