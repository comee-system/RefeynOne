
<div class="content">
    <div class="container">
        <?= $this->element("graph_step",['step'=>3]); ?>
        <?= $this->Form->hidden("id",['id'=>'id','value'=>h($id)])?>
        <?= $this->Form->hidden("defaultpoint",['id'=>'defaultpoint','value'=>h($defaultpoint)])?>
        <?= $this->Form->hidden("dispareamax",['id'=>'dispareamax','value'=>h($dispareamax)])?>
        <?= $this->Form->hidden("binsize",['id'=>'binsize','value'=>h($binsize)])?>
        <?= $this->Form->hidden("smooth",['id'=>'smooth','value'=>h($smooth)])?>

        <?= $this->Form->hidden("binline",['id'=>'binline','value'=>h($binline)])?>
        <div class="row mt-3">
            <div class="col-4">
                <?= $this->Form->button("pngExport",[
                    "class"=>"btn btn-warning w-100 text-white",
                    "type"=>"button",
                    "id"=>"pngExport"
                ])?>
            </div>
            <div class="col-4">
                <?= $this->Html->link("CSVExport",[
                    "controller"=>"graphs",
                    "action"=>"outputGraphe",
                    $id
                ],
                [
                    "escape"=>false,
                    "class"=>"btn btn-warning w-100 text-white",

                ])?>

            </div>
            <div class="col-4">
                <?= $this->Html->link("グラフ表示変更",$this->request->getParam('controller')."/step3_graph/".$id,[
                    'escape'=>false,
                    'class'=>'btn btn-warning w-100 text-white text-center'
                ])?>
            </div>
        </div>
        <?= $this->Form->create("", [
            'enctype' => 'multipart/form-data',
            'url'=>'/graphs/step4'
            ]); ?>
            <div class="row mt-3">
                <div class="col-md-10">
                    <!-- LINE CHART -->
                    <div class="card card-info">
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="lineChart" style="height: 700px;max-width: 100%;"></canvas>
                            </div>
                        </div>

                        <?php $no=1;foreach($graphe_point as $key=>$value): ?>
                        <input type="hidden" class="graphe_point" id="line<?=$no?>" value="<?= h($value[ 'point' ]) ?>" />
                        <?php $no++; endforeach; ?>
                        <?php $no=1; foreach($graphe_data as $key=>$value): ?>
                        <input type="hidden" class="graphe_data" id="label<?=$no?>" value="<?= h($value[ 'label' ]) ?>" />
                        <?php $no++; endforeach; ?>

                        <!-- /.card-body -->
                    </div>
                    <!--
                    <a href="" class="btn btn-outline-info w-100">SOPエリアの設定</a>
                    -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title"><?= __("SOPエリアの設定") ?></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr class="bg-info">
                                    <th class="text-center" colspan=6><?= __("エリア設定") ?></th>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <?php for($i=0;$i<=4;$i++ ):
                                        $num = $i+1;
                                        $sop_id = "";
                                        if(isset($SopAreas[$i][ 'id' ])):
                                            $sop_id = $SopAreas[$i][ 'id' ];
                                        endif;
                                        ?>
                                    <td class="text-center" id="areaname-<?= $sop_id ?>"><?= __("エリア".$num) ?></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <td><?= __("上限") ?></td>
                                    <?php for($i=0;$i<=4;$i++ ):?>
                                    <td class="text-center" >
                                        <?php
                                            $text = "";
                                            $sop_id = "";
                                            if(isset($SopAreas[$i][ 'id' ])):
                                                $sop_id = $SopAreas[$i][ 'id' ];
                                                $text = $SopAreas[$i][ 'maxpoint' ];
                                            endif;
                                        ?>
                                        <?= $this->Form->input("maxpoint-".$sop_id,[
                                            'class'=>'form-control sopArea',
                                            'label'=>false,
                                            'value'=>$text
                                        ])?>
                                    </td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <td><?= __("下限") ?></td>
                                    <?php for($i=0;$i<=4;$i++ ):?>
                                    <td class="text-center" >
                                        <?php
                                            $text = "";
                                            $sop_id = "";
                                            if(isset($SopAreas[$i][ 'id' ])):
                                                $sop_id = $SopAreas[$i][ 'id' ];
                                                $text = $SopAreas[$i][ 'minpoint' ];
                                            endif;
                                        ?>
                                        <?= $this->Form->input("minpoint-".$sop_id,[
                                            'class'=>'form-control sopArea',
                                            'label'=>false,
                                            'value'=>$text
                                        ])?>
                                    </td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <td nowrap><?= __("グラフ反映") ?></td>
                                    <?php for($i=0;$i<=4;$i++):?>
                                    <?php
                                        $sop_id = "";
                                        if(isset($SopAreas[$i][ 'id' ])):
                                            $sop_id = $SopAreas[$i][ 'id' ];
                                        endif;
                                    ?>
                                    <td class="text-center">
                                        <?= $this->Form->radio('reflect_graf',
                                        [$sop_id=>'text'],
                                        [
                                            'label'=>false
                                        ]);?>
                                    </td>
                                    <?php endfor; ?>
                                </tr>
                            </table>

                            <div class="row mt-3">
                                <div class="col-4">
                                    <?= $this->Form->button("テーブル反映",[
                                        "class"=>"btn btn-warning w-100 text-white",
                                        "type"=>"button",
                                        "id"=>"tableReflect"
                                    ])?>
                                </div>
                                <div class="col-4">
                                    <?= $this->Html->link("SOPExport",[
                                        "controller"=>"graphs",
                                        "action"=>"outputSOP"
                                    ],
                                    [
                                        "escape"=>false,
                                        "class"=>"btn btn-warning w-100 text-white",

                                    ])?>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>


                    <!-- /.card -->
                </div>
                <div class="col-md-2">
                    <div class="ml-2">



                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card card-info">
                                    <div class="card-header">解析基準</div>
                                    <div class="card-body">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="analyticsBasic1" name="analyticsBasic" checked>
                                            <label for="analyticsBasic1" class="custom-control-label">Number</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="analyticsBasic2" name="analyticsBasic" >
                                            <label for="analyticsBasic2" class="custom-control-label">Mass</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card card-info">
                                    <div class="card-header"><?= __("データ表示") ?></div>
                                    <div class="card-body">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="dataDisplay1" name="dataDisplay" checked >
                                            <label for="dataDisplay1" class="custom-control-label">Count</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="dataDisplay2" name="dataDisplay" >
                                            <label for="dataDisplay2" class="custom-control-label">Normalized</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card card-info">
                                    <div class="card-header"><?= __("データ範囲") ?></div>
                                    <div class="card-body p-1">
                                        <div class="row">
                                            <div class="col-2 text-center"><small class="text-muted f6 text-nowrap"><?= __("範囲") ?></small></div>
                                            <div class="col-5 text-center"><small class="text-muted f6"><?= __("下限") ?></small></div>
                                            <div class="col-5 text-center"><small class="text-muted f6"><?= __("上限") ?></small></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 text-center"><small class="text-muted"><?= __("X") ?></small></div>
                                            <div class="col-5">
                                                <input type="text" name="" value=""  class="form-control-sm w-100" />
                                            </div>
                                            <div class="col-5">
                                                <input type="text" name="" value=""  class="form-control-sm w-100" />
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-2 text-center"><small class="text-muted"><?= __("Y")?></small></div>
                                            <div class="col-5">
                                                <input type="text" name="" value=""  class="form-control-sm w-100" />
                                            </div>
                                            <div class="col-5">
                                                <input type="text" name="" value=""  class="form-control-sm w-100" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card card-info">
                                    <div class="card-header"><?= __("スムージング")?></div>
                                    <div class="card-body">
                                        <input type="text" name="" value=""  class="form-control-sm w-100" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="alert alert-success w-100" role="alert">
                   <?= __("エリア毎のテーブル表示") ?>

                </div>
                <?= $this->Html->link("TableDataExport","/graphs/tableDataExport/".$id,[
                        "class"=>"btn btn-warning w-25 text-white",
                    ])?>
                <div class="areatable">
                    <table class="mt-3 table table-bordered bg-white" style="width:200%;">
                        <thead>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <?php for($i=1;$i<=5;$i++): ?>
                                <td colspan=4 ><?= __("エリア".$i) ?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td rowspan="2" ><?= __("Label") ?></td>
                                <?php for($i=0;$i<5;$i++):
                                    $sop_id = "";
                                    if(isset($SopAreas[$i][ 'id' ])):
                                        $sop_id = $SopAreas[$i][ 'id' ];
                                    endif;
                                    ?>

                                    <td><?= __("範囲最小値") ?></td>
                                    <td id="areamins-<?=$sop_id?>">-</td>
                                    <td><?= __("範囲最大値") ?></td>
                                    <td id="areamaxs-<?=$sop_id?>">-</td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <?php for($i=1;$i<=5;$i++): ?>
                                    <td><?= __("割合%") ?></td>
                                    <td><?= __("平均値") ?></td>
                                    <td><?= __("中間値") ?></td>
                                    <td><?= __("モード値") ?></td>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody id="areaTables">

                        </tbody>
                    </table>
                    <div class="spinner"></div>
                </div>

            </div>
            <div class="row m-3">
                <div class="col-md-6 text-center">
                    <?= $this->Html->link("戻る","/graphs/step2/".$id,[
                        "class"=>"btn btn-secondary w-75",
                    ])?>
                </div>
                <div class="col-md-6 text-center">
                    <?= $this->Form->submit("次へ(データ出力)",[
                        "class"=>"btn btn-primary w-75"
                    ])?>
                </div>
            </div>
        <?= $this->Form->end(); ?>
    </div>
</div>
