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

        $users = $this->paginate($this->Users);

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
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
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

            $user = $this->Users->patchEntity($user, $request,['validate'=>"userEdit"]);

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
                $user['startdate'] = $request[ 'startdate' ];
                $user['enddate'] = $request[ 'enddate' ];

                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));

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
