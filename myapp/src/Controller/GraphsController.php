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
        $this->GrapheDislays = $this->loadModel("GrapheDisplays");
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
        $user_id = $this->uAuth['id'];
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



        //グラフ横軸
        $sopDefaults = $this->SopDefaults->find()->where([
                    'user_id'=>$user_id,
                    'graphe_id'=>$graphe_id
                ])->first();

        $defaultpoint = $sopDefaults[ 'defaultpoint' ];
        $dispareamax  = $sopDefaults[ 'dispareamax' ];
        $binsize      = $sopDefaults[ 'binsize' ];
        $smooth       = $sopDefaults[ 'smooth' ];

        $line = [];
        $compares = [];
        $no = 0;
        for($i=$defaultpoint;$i<=$dispareamax;$i=$i+$binsize){
            $line[] = $i;
            $compares[$no]['min'] = $i;
            $compares[$no]['max'] = $i+$binsize;
            $no++;
        }
        $binline = implode(",",$line);
        $this->set("binline",$binline);


        //グラフ取得範囲
        //比較対象の作成
//var_dump($graphe_data,$compares);
        $data = [];
        $insert = "";

        $query = $this->GrapheDislays->find()->where([
            'user_id'=>$user_id,
            'graphe_id'=>$graphe_id
            ])->count();

        if($query){
            //既に登録済みなので何もしない
        }else{
            $cnt = [];
            $cnt2 = [];
            $cnt3 = [];
            $cnt4 = [];
            $sum = [];//ヒストグラムの値を範囲のデータ総数
            $sum2 = []; //Mass範囲のデータ総数
            $center=[];

            //smoothの計算
            $plus = $smooth-ceil($smooth/2);
            $start = 0;
            foreach($graphe_data as $key=>$value){

                foreach($compares as $k=>$comp){
                    $graphePoints = "";
                    $graphePoints = $this->GraphePoints->find();
                    $graphePoints = $graphePoints
                        ->select([
                            'count'=>$graphePoints->func()->count( 'id' )
                        ])
                        ->where([
                        'user_id'=>$user_id,
                        'graphe_id'=>$graphe_id,
                        'graphe_data_id'=>$value[ 'id' ],
                        'pointdata != '=> "",
                        'pointdata >= '.$comp[ 'min' ],
                        'pointdata < '.$comp[ 'max' ],
                    ])->first();

                    $center[$key][$k] = ($comp[ 'min' ]+$comp[ 'max' ])/2;
                    $cnt[$key][$k] = $graphePoints->count;
                    $cnt2[$key][$k] = $graphePoints->count*$center[$key][$k];

                    $s = (isset($sum[$key]))?$sum[$key]:0;
                    $sum = sprintf("%d",$s+$graphePoints->count);
                    if($cnt[$key][$k] == 0 || $sum == 0){
                        $cnt3[$key][$k] = 0;
                    }else{
                        $cnt3[$key][$k] = round(((int)$cnt[$key][$k]/(int)$sum),5);
                    }

                    $s2 = (isset($sum2[$key]))?$sum2[$key]:0;
                    $sum2 = sprintf("%d",$s2+($cnt[$key][$k]*$center[$key][$k]));
                    if($cnt2[$key][$k] == 0 || $sum2 == 0){
                        $cnt4[$key][$k] = 0;
                    }else{
                        $cnt4[$key][$k] = round(((int)$cnt2[$key][$k]/(int)$sum2),5);
                    }
                    //var_dump($graphePoints->count);
                    //exit();

                }



                // $data[$key][$k] = $graphePoints->count;
                //    $this->log("Label=>".$value[ 'label' ]."/count=>".$graphePoints->count."/min=>:".$comp['min']."/max=>:".$comp['max'],'debug');
                foreach($compares as $k=>$comp){

                    //smoothの設定
                    $num = 0;
                    $avecount = 0;
                    $avecount2 = 0;
                    $avecount3 = 0;
                    $avecount4 = 0;
                    for($i=$start-$plus;$i<=$start+$plus;$i++){
                        $avecount += (isset($cnt[$key][$i]))?$cnt[$key][$i]:0;
                        $avecount2 += (isset($cnt2[$key][$i]))?$cnt2[$key][$i]:0;
                        $avecount3 += (isset($cnt3[$key][$i]))?$cnt3[$key][$i]:0;
                        $avecount4 += (isset($cnt4[$key][$i]))?$cnt4[$key][$i]:0;
                        $num++;
                    }

                    $start += $plus;
                    $ave1 = round($avecount/$smooth,5);
                    $ave2 = round($avecount2/$smooth,5);
                    $ave3 = round($avecount3/$smooth,5);
                    $ave4 = round($avecount4/$smooth,5);


                    $ctr = $center[$key][$k];
                    $counts1 = $cnt[$key][$k];
                    $counts2 = $cnt2[$key][$k];
                    //$counts2 = $counts1*$ctr;
                   // $counts3 = round($counts1/(int)$sum[$key],5);
                    $counts3 = $cnt3[$key][$k];
                    $counts4 = $cnt4[$key][$k];
                    //$counts4 = round($counts2/(int)$sum2[$key],5);
                    $insert .= "(
                        '".$user_id."',
                        '".$graphe_id."',
                        '".$value[ 'id' ]."',
                        '".$counts1."',
                        '".$counts2."',
                        '".$counts3."',
                        '".$counts4."',
                        '".$ave1."',
                        '".$ave2."',
                        '".$ave3."',
                        '".$ave4."',
                        '".$comp[ 'max' ]."',
                        '".$comp[ 'min' ]."',
                        '".$ctr."',
                        '".date('Y-m-d H:i:s')."',
                        '".date('Y-m-d H:i:s')."'
                    ),";
                }
            }

            //取得したデータをデータパターン毎に登録処理を行う
            //次回アクセス時、表示データ切り替えの際の処理を高速にする
            if($insert){
                $sql = "
                    INSERT INTO graphe_displays (
                        user_id,
                        graphe_id,
                        graphe_data_id,
                        counts1,
                        counts2,
                        counts3,
                        counts4,
                        scounts1,
                        scounts2,
                        scounts3,
                        scounts4,
                        max,
                        min,
                        center,
                        created,
                        modified
                    ) VALUES ";
                $sql .= trim($insert,",");
                $connection->execute($sql);
            }
        }

        //表示用のデータ取得を行う
        $sql = "
            SELECT
                GROUP_CONCAT( counts1 ) as cnt
            FROM
                graphe_displays
            WHERE
                user_id='${user_id}' AND
                graphe_id = '${graphe_id}'
            GROUP BY graphe_data_id
            ";
        $display = $connection->execute($sql)->fetchall('assoc');


        $graphe_point = [];
        foreach($display as $key=>$value){
            $graphe_point[]['point'] = $value[ 'cnt' ];
        }

        $this->set("id",$graphe_id);
        $this->set("graphe_data",$graphe_data);
        $this->set("graphe_point",$graphe_point);




    }

    public function step3Graph($graphe_id = ""){
        $grafData = $this->GrapheDatas->find();

        $this->set("id",$graphe_id);
        $this->set("grafData",$grafData);
    }
    public function step4(){


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
