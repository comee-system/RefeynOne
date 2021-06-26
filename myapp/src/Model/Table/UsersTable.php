<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public $type = "";
    public $dateStatus = "";
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationuserEdit(Validator $validator){
        $this->type = "edit";
        $validator
            ->add('datestatus','custom',[
                'rule'=>[$this,'dateStatus'],
            ]);


        return $this->validationDefault($validator);
    }
    public function dateStatus($value, $context) {
        $this->dateStatus=$value;
        return true;
    }
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        // プロバイダを追加
       // $validator->provider('custom', Validation\CustomValidation::class);

        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 255,__("入力文字が多すぎます。"))
            ->minLength('username',5,__("5文字以上で入力してください。"))
            ->requirePresence('username', 'create')
            ->notEmptyString('username',__("ユーザIDを入力してください。"));

        $validator
            ->add('username','custom',[
                'rule'=>[$this,'sameUsernameCheck'],
                'message'=>'同じユーザIDが既に登録されています',
            ]);

        $validator
            ->scalar('campany')
            ->maxLength('campany', 255,__("入力文字が多すぎます。"))
            ->notEmptyString('campany',__("企業名を入力してください。"));

        $validator
            ->scalar('sei')
            ->maxLength('sei', 255,__("氏名(姓)入力文字が多すぎます。"))
            ->notEmptyString('sei',__("氏名(姓)を入力してください。"));
        $validator
            ->scalar('mei')
            ->maxLength('mei', 255,__("氏名(名)入力文字が多すぎます。"))
            ->notEmptyString('mei',__("氏名(名)を入力してください。"));

        $validator
            ->scalar('sei_kana')
            ->maxLength('sei_kana', 255,__("ふりがな(姓)入力文字が多すぎます。"))
            ->notEmptyString('sei_kana',__("ふりがな(姓)を入力してください。"));
        $validator
            ->scalar('mei_kana')
            ->maxLength('mei_kana', 255,__("ふりがな(名)入力文字が多すぎます。"))
            ->notEmptyString('mei_kana',__("ふりがな(名)を入力してください。"));


        $validator
            ->scalar('mei_kana')
            ->maxLength('mei_kana', 255,__("ふりがな(名)入力文字が多すぎます。"))
            ->notEmptyString('mei_kana',__("ふりがな(名)を入力してください。"));

        if($this->type == "edit"){
            $validator
                ->scalar('password')
                ->maxLength('password', 255,__("入力文字が多すぎます。"))
                ->minLength('password',8,__("8文字以上で入力してください。"))
                ->requirePresence('password', 'create')
                ->allowEmptyString('password');
        }else{
            $validator
                ->scalar('password')
                ->maxLength('password', 255,__("入力文字が多すぎます。"))
                ->minLength('password',8,__("8文字以上で入力してください。"))
                ->requirePresence('password', 'create')
                ->notEmptyString('password',__("パスワードを入力してください。"));
        }
        if($this->type != "edit"){
            $validator
                ->email('email',__("メールアドレスに誤りがあります。"))
                ->requirePresence('email', 'create')
                ->notEmptyString('email',__("メールアドレスを入力してください。"))
                ->add('email', 'unique', [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message'=>__("既に登録されているメールアドレスです。")
                    ]);
        }
        if($this->dateStatus != "1"){
            $validator
            ->notEmptyString('startdate',__("開始日を入力してください。"))
            ->add("startdate", [
                'date' => [
                    'rule' => function($value,$val){
                        if($value == "0000-00-00") return true;
                        $ex = explode("-",$value);
                        if(!checkdate($ex[1], $ex[2], $ex[0])){
                            return false;
                        }
                        if($val[ 'data' ]['startdate'] > $val[ 'data' ][ 'enddate']){
                            return false;
                        }
                        return true;
                    },
                    'message' => '日付に誤りがあります。',
                ],
            ]);
        }
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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    public function sameUsernameCheck($value, $context) {

        $table = TableRegistry::get($this->_registryAlias);

        if ($context['newRecord']) {
            $where = [
                'username'=>$value,
            ];
        } else {
            $where = [
                'id !='=>$context['data']['id'],
                'username'=>$value,
            ];
        }
        $query = $table->find()->select(['id'])->where($where)->first();
        return empty($query) ? true : false;
    }

}
