<?php
namespace App\Controller\Lssadmin;


use Cake\Event\Event;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->pan = [];
        $this->pan[0]['title'] = "Home";
        $this->pan[0]['link' ] = Router::url(['controller' => '/'], true);
        $this->mailsend = $this->loadComponent('MailSend');
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'hoge']);
        $this->set("pan",$this->pan);
        $this->set("type",[]);

    }

    /**
     * ログイン
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        $this->viewBuilder()->setLayout('admin_login');
      if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
          $this->Auth->setUser($user);
          return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Flash->error(__('ユーザ名もしくはパスワードが間違っています'));
      }
    }

    /**
     * ログアウト
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
      return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $title = "会員一覧";
        $this->pan[1]['title'] = $title;
        $this->pan[1]['link' ] = "";
        $user = $this->Users->find()->where(['role'=>0]);
        $users = $this->paginate($user);

        $this->set(compact('users'));
        $this->set("title",$title);
        $this->set("pan",$this->pan);

    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
    public function admin()
    {
        $user = $this->Users->find()->select(['id'])->where([
            'role'=>1
        ])->first();

        //管理者情報取得
        $user = $this->Users->get($user->id, [
            'contain' => [],
        ]);
        if ($this->request->is('put')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(),['validate'=>false]);

            if(!$this->request->getData('password')){
                unset($user[ 'password' ]);
            }
            if ($this->Users->save($user)) {
                $this->Flash->success(__('管理者情報の更新を行いました。'));

                return $this->redirect(['controller'=>'users','action' => 'admin']);
            }
            $this->Flash->error(__('管理者情報の更新に失敗しました。'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $type = "";
        if($id > 0 ){
            $user = $this->Users->get($id, [
                'contain' => [],
            ]);
        }else{
            $user = $this->Users->newEntity();
        }
        $error = [];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $request = $this->request->getData();
            $request["startdate"] = sprintf("%04d-%02d-%02d"
                                        ,$this->request->getData("start")[ 'year' ]
                                        ,$this->request->getData("start")[ 'month' ]
                                        ,$this->request->getData("start")[ 'day' ]
                                        );
            $request["enddate"] = sprintf("%04d-%02d-%02d"
                                        ,$this->request->getData("end")[ 'year' ]
                                        ,$this->request->getData("end")[ 'month' ]
                                        ,$this->request->getData("end")[ 'day' ]
                                        );
            if($id > 0){
                $user = $this->Users->patchEntity($user, $request,['validate'=>"userEdit"]);
            }else{
                $user = $this->Users->patchEntity($user, $request);
            }

            if($this->request->getData("conf")){
                $error = $user->getErrors();
                if(!$user->hasErrors()){
                    $type = "conf";
                }
            }
            if($this->request->getData("regist")){
                if(!$this->request->getData("password")){
                    unset($user->password);
                }
                $user[ 'startdate' ] = $request[ 'startdate' ];
                $user[ 'enddate'   ] = $request[ 'enddate' ];
                $user[ 'role'      ] = 0;
                $user[ 'last_login_at' ] = date('Y-m-d');
                if ($userdata = $this->Users->save($user)) {
                    $this->mailsend->userRegistSends($userdata);
                    $this->Flash->success(__('会員登録が完了しました。'));

                    return $this->redirect(['action' => 'index']);
                }
            }

        }
        $this->set(compact('user'));
        $this->set("type",$type);
        $this->set("id",$id);
        $this->set("error",$error);

    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }




}
