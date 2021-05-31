<?php
namespace App\Controller;


use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure;
use Cake\Error\Debugger;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GraphsController extends AppController
{

    const RefeynOne = "RefeynOne";
    const Mesurement = "Mesurement";
    const noname = "noname";
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->uAuth = $this->Auth->user();
        if(!$this->uAuth){
            return $this->redirect(['controller'=>'/','action' => '/']);
        }
        $this->array_smooth = Configure::read("array_smooth");

        $this->Graphes = $this->loadModel("Graphes");
        $this->GrapheDatas = $this->loadModel("GrapheDatas");
        $this->GraphePoints = $this->loadModel("GraphePoints");
        $this->SopDefaults = $this->loadModel("SopDefaults");
        $this->SopAreas = $this->loadModel("SopAreas");
        $this->UploadComponent = $this->loadComponent("Upload",$this->uAuth);
        $this->set("uAuth",$this->uAuth);
        $this->set("array_smooth",$this->array_smooth);

    }

    public function index($id = ""){
        //IDが無いときは初期データの為新規登録を行う
        if(!$id){
            $this->add();
        }
        $this->set("id",$id);

    }
    public function step2($id){
        $this->editsop("",$id);
        $SopDefaults = $this->SopDefaults->find()->where([
            "user_id"=>$this->uAuth[ 'id' ],
            "graphe_id"=>$id,
        ])->first();

        $SopAreas = $this->SopAreas->find()->where([
            "user_id"=>$this->uAuth[ 'id' ],
            "graphe_id"=>$id,
        ])->toArray();

        $this->set("id",$id);
       // $this->set("SopDefaults",$SopDefaults);
        $this->set(compact('SopDefaults'));
        $this->set(compact('SopAreas'));
        $this->set("sopdefaultid",$SopDefaults[ 'id' ]);

    }
    public function step3($graphe_id){
        //グラフデータ取得
        $connection = ConnectionManager::get('default');
        $user_id = $this->uAuth['id'];

        $sql = " SELECT
              id,
              label
            FROM graphe_datas WHERE
                user_id='${user_id}' AND
                graphe_id = '${graphe_id}' AND
                disp = '1'
        ";
        $graphe_data = $connection->execute($sql)->fetchall('assoc');
        foreach($graphe_data as $key=>$val){
            $packet = "set Session group_concat_max_len = 10000000;";
            $connection->execute($packet);

            $graphe_data_id = $val[ 'id' ];
            $sql = "
                SELECT
                GROUP_CONCAT(pointdata) as point
                FROM graphe_points WHERE
                user_id='${user_id}'
                AND graphe_id = '${graphe_id}'
                AND graphe_data_id = '${graphe_data_id}'
                AND pointdata != ''
            ";
            $graphe_point[$graphe_data_id] = $connection->execute($sql)->fetch('assoc');
        }
        $this->set("id",$graphe_id);
        $this->set("graphe_data",$graphe_data);


        //グラフの間隔指定
        $SopDefaults = $this->___setSpace($graphe_id,$user_id);
        $defaultpoint = $SopDefaults[ 'defaultpoint' ];
        $dispareamax = $SopDefaults[ 'dispareamax' ];
        $binsize = $SopDefaults[ 'binsize' ];
        $smooth = $SopDefaults[ 'smooth' ];
        //ヒストグラムの作成
     //   var_dump($SopDefaults,$graphe_point);
        $points = [];
        foreach($graphe_point as $key=>$value){
            $points[] = explode(",",$value[ 'point' ]);

        }
        //比較対象の作成
        $compares = [];
        $no = 0;
        for($i=$defaultpoint;$i<=$dispareamax;$i=$i+$binsize){
            $compares[$no]['min'] = $i;
            $compares[$no]['max'] = $i+$binsize;
            if($i > $dispareamax){
                break;
            }
            $no++;
        }


//var_dump($points);
//var_dump($compares);
//exit();
        $grafpoint = [];
        foreach($compares as $ckey=>$compare){
            foreach($points as $pkey=>$point){
                $count = 0;
                foreach($point as $k=>$val){
                    //echo $compare['min']."=<".$val."<".$compare['max'];
                    //echo "<br />";
                    $this->log($compare['min']."=<".$val."<".$compare['max'],'debug');
                    if(
                        $val >= $compare['min'] &&
                        $val < $compare['max']
                        ){
                            $count += 1;
                    }
                }
                $grafpoint[$pkey][$ckey] = $count;
                //echo "total=>".$count;
                //echo "<hr />";
                $this->log("total=>".$count,'debug');
            }
        }

        $graphe_point = [];
        foreach($grafpoint as $key=>$value){
            $graphe_point[$key]['point'] = implode(",",$value);
        }

        $this->set("graphe_point",$graphe_point);
    }

    public function step3Graph($graphe_id = ""){
        $grafData = $this->GrapheDatas->find();

        $this->set("id",$graphe_id);
        $this->set("grafData",$grafData);
    }
    public function step4(){


    }


    public function ___setSpace($graphe_id,$user_id){
        $SopDefaults = $this->SopDefaults->find()->where([
            'user_id'=>$user_id,
            'graphe_id'=>$graphe_id
        ])->first();

        $bin=[];
        $start = $SopDefaults->defaultpoint;
        $end = $SopDefaults->dispareamax;
        $num = 1;
        for($i=$start;$i<=$end;$i=$i+10){
            $bin[] = $i;
            if($num > $end) break;
            $num++;
        }
        $binline = implode(",",$bin);

        $this->set("SopDefaults",$SopDefaults->toArray());
        $this->set("binline",$binline);
        return $SopDefaults;
    }

    public function setSop($graphe_id){
        $this->autoRender=false;
        $SopAreas = $this->SopAreas->newEntity();
        $SopAreas->user_id = $this->uAuth['id'];
        $SopAreas->graphe_id = $graphe_id;
        $SopAreas->name = self::noname;
        $SopAreas->minpoint = 0;
        $SopAreas->maxpoint = 0;
        $SopAreas->edit = 1;
        $this->SopAreas->save($SopAreas);
    }
    public function getSop($graphe_id){
        //SOPエリアデータ取得
        $SopAreas = $this->SopAreas->find()->where([
            "user_id"=>$this->uAuth[ 'id' ],
            "graphe_id"=>$graphe_id,
        ])->toArray();
        header('Content-type: application/json');
        echo json_encode($SopAreas,JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function upload($graphe_id,$type=""){
        $this->autoRender = false;

        if($this->request->is('ajax')){
            if($this->request->getData('upfile')[ 'error' ] === 0 ){
                //ファイルアップロード
                if($type == "sop"){
                    $this->UploadComponent->fileUploadSop($graphe_id);
                }else
                if($type == "mesurement" ){
                    $this->UploadComponent->fileUploadMesurement($graphe_id,self::Mesurement);
                }else{
                    $this->UploadComponent->fileUploadRefeynOne($graphe_id,self::RefeynOne);
                }
            }else{
                echo 1;
            }
            exit();
        }

    }

    //CSV出力
    public function outputMesurement($graphe_id){
        $this->autoRender = false;
        $data = $this->GrapheDatas->find('all',['contain'=>'GraphePoints'])
        ->where(
            [
                'GrapheDatas.graphe_id'=>$graphe_id,
                'GrapheDatas.user_id'=>$this->uAuth['id'],
//                'GrapheDatas.filename'=>self::Mesurement
            ]
        )->toArray();


        $list = [];
        $title = [];
        $valueid = 0;
        $no = 0;
        foreach($data as $key=>$value){
            if($valueid != $value->id) $no = 0;
            if($no == 0){
                $list[ $value->id][] = $value[ 'label' ];
            }else{
                $list[ $value->id ][] = $value['graphe_point'][ 'pointdata' ];
            }
            $valueid = $value->id;
            $no++;
        }


        //保存場所
        $filename = date('YmdHis') . '.csv';
        $file = WWW_ROOT.'csv/' .$filename;
        $f = fopen($file, 'w');
        foreach($list as $key=>$value){
            fputcsv($f, $value);
        }


        fclose($f);

        return $this->response->withFile(
            $file,
            [
              'download'=>true,
            ]
          );

    }
    //step1のデータ一覧表示部分
    public function graphdata($graphe_id){

        $this->autoRender = false;
        $data = $this->GrapheDatas->find()->where(
            [
                'graphe_id'=>$graphe_id,
                'user_id'=>$this->uAuth['id'],
            ]
        )->toArray();
        header('Content-type: application/json');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function add()
    {
        $graphe = $this->Graphes->newEntity();
        $graphe->user_id = $this->uAuth['id'];
        $graphe->name = time();
        if ($this->Graphes->save($graphe)) {

            return $this->redirect(['action' => 'index',$graphe->id]);
        }
        $this->Flash->error(__('登録に失敗しました'));
        return $this->redirect(['controller'=>'users','action' => 'index']);

    }
    public function edit($id = null)
    {
        $GrapheDatas = $this->GrapheDatas->get($id, [
            'contain' => [],
        ]);
        $GrapheDatas = $this->GrapheDatas->patchEntity($GrapheDatas, $this->request->getData());
        $this->GrapheDatas->save($GrapheDatas);
    }
    public function editDispStatus()
    {
        $this->autoRender = false;

        $id = $this->request->getData("id");
        $chk = $this->request->getData("chk");
        $userid = $this->uAuth['id'];

        $GrapheDatas = $this->GrapheDatas->find()->where([
            'user_id'=>$userid,
            'id'=>$id
        ])->first();
        $flag = 0;
        if($chk === "true" ) $flag = 1;
        $set[ 'disp' ] = $flag;

        $GrapheDatas->disp = $flag;
        $this->GrapheDatas->save($GrapheDatas);
        exit();
    }
    public function editsop($id = null,$graphe_id = "")
    {

        if($id){
            $this->autoRender = false;
            $SopDefaults = $this->SopDefaults->get($id, [
                'contain' => [],
            ]);
        }else{
            $SopDefaults = $this->SopDefaults->find()->where([
                "user_id"=>$this->uAuth['id'],
                "graphe_id"=>$graphe_id
                ])->first();
            if(empty($SopDefaults)){
                $SopDefaults = $this->SopDefaults->newEntity();
            }else{
                //idが無くデータがあれば処理を行わない
                return false;
            }
        }
        $set = [];
        if($this->request->getData("name")){
            $set[$this->request->getData('name')] = $this->request->getData('value');
        }
        $set[ 'user_id' ] = $this->uAuth['id'];
        if($graphe_id > 0){
            $set[ 'graphe_id' ] = $graphe_id;
            $set[ 'defaultpoint' ] = 0;
            $set[ 'dispareamax' ] = 0;
            $set[ 'binsize' ] = 0;
            $set[ 'smooth' ] = 0;
        }
        $SopDefaults = $this->SopDefaults->patchEntity($SopDefaults, $set,['validate'=>false]);
        $this->SopDefaults->save($SopDefaults);
    }


    public function delete($graph_id,$graph_data_id)
    {
        $graphdata = $this->GrapheDatas->find()->where([
            'id'=>$graph_data_id,
            'user_id'=>$this->uAuth[ 'id' ],
            'graphe_id'=>$graph_id,
        ])->first();


        if ($this->GrapheDatas->delete($graphdata)) {
            $this->GraphePoints->deleteAll([
                'graphe_data_id'=>$graph_data_id,
                'user_id'=>$this->uAuth[ 'id' ]
            ]);

            $this->Flash->success(__('データの削除を行いました。'));
        } else {
            $this->Flash->error(__('データの削除に失敗しました。'));
        }
        return $this->redirect(['action' => '/index/',$graph_id]);
    }


}
