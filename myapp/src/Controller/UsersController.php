<?php
namespace App\Controller;


use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
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
        parent::beforeFilter($event);
        $this->connection = ConnectionManager::get('default');
        $this->mailsend = $this->loadComponent('MailSend');
        $this->Auth->allow(['add', 'hoge']);
        $this->uAuth = $this->Auth->user();
        $this->set("uAuth",$this->uAuth);
        $this->set("bottom","fixed-bottom");
    }

    /**
     * ログイン
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        if(!is_null($this->uAuth)){
            return $this->redirect("/");
        }
        if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
          $this->Auth->setUser($user);

          return $this->redirect("/graphs/");
//          return $this->redirect($this->Auth->redirectUrl());
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
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
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
    public function add($id = "")
    {
        $type = "";
        $error = [];
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $error = $user->getErrors();
            if($this->request->getData("conf")){
                if(!$user->hasErrors()){
                    $type = "conf";
                }
            }

            if($this->request->getData("regist")){
                $user->role = 0; //一般
                $user->last_login_at = 0;
                $this->connection->begin();

                $user->startdate = sprintf("%04d-%02d-%02d"
                                        ,$this->request->getData("start")[ 'year' ]
                                        ,$this->request->getData("start")[ 'month' ]
                                        ,$this->request->getData("start")[ 'day' ]
                                        );
                $user->enddate = sprintf("%04d-%02d-%02d"
                                        ,$this->request->getData("end")[ 'year' ]
                                        ,$this->request->getData("end")[ 'month' ]
                                        ,$this->request->getData("end")[ 'day' ]
                                        );

                if ($userdata = $this->Users->save($user)) {
                    $this->mailsend->userRegistSends($userdata);
                    $this->Flash->success(__('会員登録が完了しました。'));
                    $this->connection->commit();
                    return $this->redirect(['controller'=>'users','action' => 'login']);
                }
                $this->connection->rollback();
            }
        }
        $this->set(compact('user'));
        $this->set("type",$type);
        $this->set("id",$id);
        $this->set("error",$error);

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
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
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
