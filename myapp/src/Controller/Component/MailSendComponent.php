<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Mailer\Email;
use Cake\Datasource\ModelAwareTrait;

/**
 * MailSend component
 */
class MailSendComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    use ModelAwareTrait;

    protected $_defaultConfig = [];
    public function initialize(array $config)
    {

        $this->email = new Email('default');
        //制限時間
        $this->limit = date("Y-m-d H:i:s", strtotime("+1 hour"));

        //管理者情報取得
        $this->users = $this->loadModel('Users');
        $this->admin = $this->users->find()->where([
            'role'=>1
        ])->first();
        $this->adminemail = $this->admin->email;

    }
    public function sends()
    {
        $this->email
            ->template('welcome')
            ->emailFormat('text')
            ->to('chiba@innovation-gate.jp')
            ->setBcc("chiba@se-sendai.co.jp")
            ->from('app@domain.com')
            ->subject("ssssss")
            ->viewVars(['name' => 12345])
            ->send();
    }
    public function userRegistSends($user){
        $this->email
            ->template('userregist')
            ->emailFormat('text')
            ->to($user->email)
            ->setBcc($this->adminemail)
            ->from($this->adminemail)
            ->subject(__("【LSS】会員登録が完了致しました"))
            ->viewVars([
                'campany' => $user->campany,
                'name' => $user->sei." ".$user->mei,
                'id' => $user->username,
                'password' => $this->request->getData("password")
                ])
            ->send();
    }
}
