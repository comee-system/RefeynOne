<?php
namespace App\Controller;


use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GraphsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $uAuth = $this->Auth->user();
        $this->set("uAuth",$uAuth);
    }

    public function index(){

    }
    public function step2(){


    }
    public function step3(){


    }
    public function step4(){


    }
    public function step5(){


    }
    public function step6(){


    }

}
