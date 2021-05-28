<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Datasource\ModelAwareTrait;
use Cake\Datasource\ConnectionManager;
use Exception;

/**
 * MailSend component
 */
class UploadComponent extends Component
{

    const noName = "No Name";
    /**
     * Default configuration.
     *
     * @var array
     */
    use ModelAwareTrait;
    protected $_defaultConfig = [];
    public function initialize(array $config)
    {
        ini_set('max_execution_time', 0);
        ini_set("memory_limit", "3G");
        $this->uAuth = $config;
        $this->Graphes = $this->loadModel("Graphes");
        $this->GrapheDatas = $this->loadModel("GrapheDatas");
        $this->GraphePoints = $this->loadModel("GraphePoints");
        $this->SopDefaults = $this->loadModel("SopDefaults");
        $this->SopAreas = $this->loadModel("SopAreas");

    }
    //RefeynOneデータがE列
    public function fileUploadRefeynOne($graphe_id,$filename){

        $connection = ConnectionManager::get('default');
        $connection->begin();
        try{
            $tmp = $this->request->getData('upfile')[ 'tmp_name' ];
            $fp   = fopen($tmp, "r");
            //配列に変換する
            $asins = [];
            while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
                $asins[] = $data;
            }
            //E列のみ取得(4)
            $eRow = [];
            foreach($asins as $key=>$value){
                foreach($value as $k=>$val){
                    if($k == 4){
                        $eRow[] = $val;
                    }
                }
            }
            //親データの作成
            $GrapheDatas = $this->GrapheDatas->newEntity();
            $GrapheDatas->user_id   = $this->uAuth[ 'id' ];
            $GrapheDatas->graphe_id = $graphe_id;
            $GrapheDatas->label = $eRow[0];
            $GrapheDatas->filename = $filename;
            $GrapheDatas->counts = count($eRow)-1;
            $this->GrapheDatas->save($GrapheDatas);

            $graphe_data_id = $GrapheDatas->id;

            $data = [];
            $i=0;
            foreach ($eRow as $key=>$value) {
                if($key > 0 ){
                    $data[$i]['user_id'  ] = $this->uAuth[ 'id' ];
                    $data[$i]['graphe_id'] = $graphe_id;
                    $data[$i]['graphe_data_id'] = $graphe_data_id;
                    $data[$i]['pointdata'] = $value;
                    $data[$i]['created'] = date('Y-m-d H:i:s');
                    $data[$i]['modified'] = date('Y-m-d H:i:s');
                    $i++;
                }
            }

            //配列を1000件毎に分ける
            $split = array_chunk($data,1000);
            $sql = " INSERT INTO graphe_points (graphe_id, graphe_data_id , user_id , pointdata , created,modified ) VALUES ";
            foreach($split as $key=>$value){
                if(env('HTTP_HOST') == "local-refeynone:8080" ){
                    $packet = "SET GLOBAL max_allowed_packet = 33554423;";
                    $connection->execute($packet);
                }
                $imp = [];
                foreach($value as $k=>$val){
                    $imp[]= "('".$val['graphe_id']."',
                    '".$val[ 'graphe_data_id' ]."',
                    '".$val[ 'user_id' ]."',
                    '".$val[ 'pointdata' ]."',
                    '".date('Y-m-d H:i:s')."',
                    '".date('Y-m-d H:i:s')."') ";
                }
                $sql2 = implode(",",$imp);
                $query = $sql.$sql2;
                $connection->execute($query);
            }


            fclose($fp);
            $connection->commit();
            echo "OK";
        }catch(Exception $e){
            echo $e;
            $connection->rollback();
        }
    }


    //Mesurementファイルは、すべてのデータを取り込みます
    public function fileUploadMesurement($graphe_id,$filename){
        $connection = ConnectionManager::get('default');
        $connection->begin();
        try{
            $tmp = $this->request->getData('upfile')[ 'tmp_name' ];
            $fp   = fopen($tmp, "r");
            //配列に変換する
            $asins = [];
            while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
                $asins[] = $data;
            }
            //親データの登録
            //配列の分割カウント用
            $c = [];
            $i=0;
            foreach($asins as $key=>$value){
                $count = 0;
                foreach($value as $k=>$val){
                    if($k > 0 && strlen($val) > 0 ){
                        $count += 1;
                    }
                }
                $c[] = $count;
                $i++;
            }
            //親データの作成
            $i = 0;
            $insert = [];
            foreach($asins as $key=>$value){
                $insert[$i]['user_id'  ] = $this->uAuth[ 'id' ];
                $insert[$i]['graphe_id'] = $graphe_id;
                $insert[$i]['label'] = $value[0];
                $insert[$i]['filename'] = $filename;
                $insert[$i]['counts'] = $c[$i];
                $i++;
            }

            $entities = $this->GrapheDatas->newEntities($insert);
            $data = [];
            $i=0;
            foreach ($entities as $key=>$entity) {
                // Save entity
                $this->GrapheDatas->save($entity);
                $data[$i] = $entity->id;
                $i++;
            }

            $child = [];
            $i = 0;
            foreach($data as $key=>$value){
                foreach($asins[$key] as $k=>$val){
                    if($k > 0 ){
                        $child[$i][ 'graphe_id' ] = $graphe_id;
                        $child[$i][ 'graphe_data_id' ] = $value;
                        $child[$i][ 'user_id'   ] = $this->uAuth[ 'id' ];
                        $child[$i][ 'pointdata' ] = $val;
                        $child[$i][ 'created'   ] = date("Y-m-d H:i:s");
                        $child[$i][ 'modified'  ] = date("Y-m-d H:i:s");
                        $i++;
                    }
                }
            }
            //配列を1000件毎に分ける
            $split = array_chunk($child,1000);
            $sql = " INSERT INTO graphe_points (graphe_id, graphe_data_id , user_id , pointdata , created,modified ) VALUES ";
            foreach($split as $key=>$value){
               if(env('HTTP_HOST') == "local-refeynone:8080" ){
                    $packet = "SET GLOBAL max_allowed_packet = 33554423;";
                    $connection->execute($packet);
                }
                $imp = [];
                foreach($value as $k=>$val){
                    $imp[]= "('".$val['graphe_id']."',
                    '".$val[ 'graphe_data_id' ]."',
                    '".$val[ 'user_id' ]."',
                    '".$val[ 'pointdata' ]."',
                    '".date('Y-m-d H:i:s')."',
                    '".date('Y-m-d H:i:s')."') ";
                }
                $sql2 = implode(",",$imp);
                $query = $sql.$sql2;
                $connection->execute($query);
            }

            fclose($fp);
            $connection->commit();
            echo "OK";
        }catch(Exception $e){
            echo $e;
            $connection->rollback();
        }
    }


    public function fileUploadSop($graphe_id){
        $connection = ConnectionManager::get('default');
        $connection->begin();
        try{
            $tmp = $this->request->getData('upfile')[ 'tmp_name' ];
            $fp   = fopen($tmp, "r");
            //配列に変換する
            $asins = [];
            while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
                $asins[] = $data;
            }

            $sop = $this->SopDefaults->find()->where([
                'user_id'=>$this->uAuth[ 'id' ],
                'graphe_id'=>$graphe_id,
            ])->first();
            $SopDefaults = $this->SopDefaults->newEntity();
            if($sop){
                $SopDefaults->id = $sop->id;
            }
            $SopDefaults->user_id = $this->uAuth[ 'id' ];
            $SopDefaults->graphe_id = $graphe_id;
            $SopDefaults->defaultpoint = $asins[0][1]; //グラフの初期値
            $SopDefaults->dispareamax = $asins[1][1]; //表示範囲
            $SopDefaults->binsize = $asins[2][1]; //Binサイズ（間隔）
            $SopDefaults->smooth = $asins[3][1]; //スムージング

            $this->SopDefaults->save($SopDefaults);

            //エリア情報の登録
            $this->SopAreas->deleteAll([
                'graphe_id'=>$graphe_id,
                'user_id'=>$this->uAuth[ 'id' ]
            ]);
            foreach($asins as $key=>$value){
                if($key >= 6){
                    $SopAreas = $this->SopAreas->newEntity();
                    $SopAreas->user_id   = $this->uAuth[ 'id' ];
                    $SopAreas->graphe_id = $graphe_id;
                    $SopAreas->name = mb_convert_encoding($value[0],"UTF-8","SJIS");
                    $SopAreas->minpoint = $value[1];
                    $SopAreas->maxpoint = $value[2];
                    $this->SopAreas->save($SopAreas);
                }
            }


            fclose($fp);
            $connection->commit();
            echo "OK";
        }catch(Exception $e){
            echo $e;
            $connection->rollback();
        }
    }
}
