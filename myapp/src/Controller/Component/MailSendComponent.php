<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Mailer\Email;
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
    protected $_defaultConfig = [];
    public function initialize(array $config)
    {

        $this->email = new Email('default');
        //制限時間
        $this->limit = date("Y-m-d H:i:s", strtotime("+1 hour"));
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
            ->setBcc(D_ADMIN_MAIL)
            ->from(D_ADMIN_MAIL)
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
