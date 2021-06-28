<?php
namespace App\Shell;

use Cake\Event\Event;
use Cake\Console\Shell;
use Cake\Mailer\Email;

class SendMailShell extends Shell
{
    public function initialize()
    {
        $this->email = new Email('default');
        $this->user = $this->loadModel("Users");

    }
    public function main(){
        error_reporting(0);
        //会員情報取得
        $onemonth = date('Y-m-d',strtotime("+1 month"));
        $user = $this->user->find()->where([
            'datestatus'=>0,
            'enddate'=>$onemonth
        ])->toArray();
        //管理者情報取得
        $admin = $this->user->find()->where([
            'role'=>1
        ])->first();
        $adminemail = $admin->email;
        foreach($user as $key=>$value){

            $this->email
                ->template('user_one_month')
                ->emailFormat('text')
                ->to($adminemail)
                ->subject("【Refeynシステム】利用期間終了１ヶ月前のお知らせ")
                ->viewVars([
                    'campany' => $value[ 'campany' ],
                    'name' => $value[ 'sei' ].$value[ 'mei' ],
                    'email' => $value[ 'email' ],
                    'term' => date("Y年m月d日",strtotime($value[ 'startdate' ]))."～".date("Y年m月d日",strtotime($value[ 'enddate' ])),
                ])
                ->send();
        }
    }
}
