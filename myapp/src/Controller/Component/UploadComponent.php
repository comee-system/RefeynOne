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

            foreach ($eRow as $key=>$value) {
                if($key > 0 ){
                    $GraphePoints = $this->GraphePoints->newEntity();
                    $GraphePoints->user_id   = $this->uAuth[ 'id' ];
                    $GraphePoints->graphe_id = $graphe_id;
                    $GraphePoints->graphe_data_id = $graphe_data_id;
                    $GraphePoints->pointdata = $value;

                    $this->GraphePoints->save($GraphePoints);
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
            foreach($asins as $key=>$value){
                if($key){
                    foreach($value as $k=>$val){
                        if(strlen($val)) $c[$k][] = $val;
                    }
                }
            }
            //親データの作成
            $i = 0;
            $insert = [];

            foreach($asins[0] as $key=>$value){
                $insert[$i]['user_id'  ] = $this->uAuth[ 'id' ];
                $insert[$i]['graphe_id'] = $graphe_id;
                $insert[$i]['label'] = $value;
                $insert[$i]['filename'] = $filename;
                $insert[$i]['counts'] = count($c[$i]);
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

            //子データの保存
            $child = [];
            $i = 0;
            foreach($data as $key=>$value){
                foreach($asins as $k=>$val){
                    if($k > 0 ){
                        $child[$i]['user_id'       ] = $this->uAuth[ 'id' ];
                        $child[$i]['graphe_id'     ] = $graphe_id;
                        $child[$i]['graphe_data_id'] = $value;
                        $child[$i]['pointdata'     ] = $val[$key];
                        $i++;
                    }
                }
            }

            foreach ($child as $key=>$value) {
                $GraphePoints = $this->GraphePoints->newEntity();
                $GraphePoints->user_id   = $value[ 'user_id' ];
                $GraphePoints->graphe_id = $value[ 'graphe_id' ];
                $GraphePoints->graphe_data_id = $value[ 'graphe_data_id' ];
                $GraphePoints->pointdata = ($value[ 'pointdata' ])?$value[ 'pointdata' ]:"";

                $this->GraphePoints->save($GraphePoints);
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
