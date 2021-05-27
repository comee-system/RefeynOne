<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SopDefaults Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\GraphesTable&\Cake\ORM\Association\BelongsTo $Graphes
 *
 * @method \App\Model\Entity\SopDefault get($primaryKey, $options = [])
 * @method \App\Model\Entity\SopDefault newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SopDefault[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SopDefault|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SopDefault saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SopDefault patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SopDefault[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SopDefault findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SopDefaultsTable extends Table
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

        $this->setTable('sop_defaults');
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
            ->integer('defaultpoint')
            ->requirePresence('defaultpoint', 'create')
            ->notEmptyString('defaultpoint');

        $validator
            ->integer('dispareamax')
            ->requirePresence('dispareamax', 'create')
            ->notEmptyString('dispareamax');

        $validator
            ->integer('binsize')
            ->requirePresence('binsize', 'create')
            ->notEmptyString('binsize');

        $validator
            ->integer('smooth')
            ->requirePresence('smooth', 'create')
            ->notEmptyString('smooth');

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
