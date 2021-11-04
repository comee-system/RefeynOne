<div id="screen">
    <div class="spinner-border m-5" role="status">
    <span class="sr-only">Loading...</span>
    </div>
</div>
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
            <div class="col-12 d-flex">
                <?= $this->Form->button("png Export",[
                    "class"=>"btn btn-warning  text-white",
                    "type"=>"button",
                    "id"=>"pngExport"
                ])?>

                <?= $this->Html->link("CSV Export",[
                ],
                [
                    "escape"=>false,
                    "class"=>"btn btn-warning  text-white ml-2",
                    "id"=>"CSVExport"
                ])?>

                <?= $this->Form->create(null,[
                    "type"=>"post",
                    "id"=>"CSVExportForm",
                    "url"=>[
                        "controller"=>"graphs",
                        "action"=>"outputGraphe",
                        $id
                    ]
                ]);?>
                <?= $this->Form->hidden("CSVExport-analyticsBasic",['id'=>'CSVExport_analyticsBasic','value'=>""])?>
                <?= $this->Form->hidden("CSVExport-dataDisplay",['id'=>'CSVExport_dataDisplay','value'=>""])?>
                <?= $this->Form->hidden("CSVExport-min_x",['id'=>'CSVExport_min_x','value'=>""])?>
                <?= $this->Form->hidden("CSVExport-max_x",['id'=>'CSVExport_max_x','value'=>""])?>
                <?= $this->Form->hidden("CSVExport-min_y",['id'=>'CSVExport_min_y','value'=>""])?>
                <?= $this->Form->hidden("CSVExport-max_y",['id'=>'CSVExport_max_y','value'=>""])?>

                <?= $this->Form->end();?>
            </div>

        </div>
        <?= $this->Form->create("", [
            'enctype' => 'multipart/form-data',
            'url'=>'/graphs/step4/'.$id
            ]); ?>
            <div class="row mt-3">
                <div class="col-md-10">
                    <!-- LINE CHART -->
                    <div class="card card-info">
                        <div class="card-body" id="cardbody">
                            <div id="cardscreen"></div>
                            <div class="chart">
                                <canvas id="lineChart" style="height: 450px;max-width: 100%;"></canvas>
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
                                        $sop_id = "";
                                        if(isset($SopAreas[$i][ 'id' ])):
                                            $sop_id = $SopAreas[$i][ 'id' ];
                                        endif;
                                        ?>
                                    <td class="text-center" id="areaname-<?= $sop_id ?>">
                                        <?php if($i == 0): ?>
                                            <?= __("全範囲") ?>
                                        <?php else: ?>
                                            <?= __("エリア".$i) ?>
                                        <?php endif; ?>

                                    </td>
                                    <?php endfor; ?>
                                </tr>
                                                                <tr>
                                    <td nowrap><?= __("エリア最小値（<=）") ?></td>
                                    <?php for($i=0;$i<=4;$i++ ):?>
                                    <td class="text-center" >
                                        <div class="d-flex">
                                            <div>
                                                <?php
                                                    $text = "";
                                                    $sop_id = "";
                                                    if(isset($SopAreas[$i][ 'id' ])):
                                                        $sop_id = $SopAreas[$i][ 'id' ];
                                                        $text = $SopAreas[$i][ 'minpoint' ];
                                                    endif;
                                                ?>
                                                <?php if($i == 0): ?>
                                                <?php $diable = true;?>
                                                <?php else: ?>
                                                <?php $diable = false;?>
                                                <?php endif;?>
                                                <?= $this->Form->input("minpoint-".$sop_id,[
                                                    'class'=>'form-control sopArea',
                                                    'label'=>false,
                                                    'value'=>$text,
                                                    'readonly'=>$diable
                                                ])?>

                                            </div>
                                            <div class="mt-2 ml-2"><?= __("kDa") ?></div>
                                        </div>
                                    </td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <td nowrap><?= __("エリア最大値（>）") ?></td>
                                    <?php for($i=0;$i<=4;$i++ ):?>
                                    <?php if($i == 0): ?>
                                    <?php $diable = true;?>
                                    <?php else: ?>
                                    <?php $diable = false;?>
                                    <?php endif;?>
                                    <td class="text-center" >
                                        <div class="d-flex">
                                            <div>
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
                                                    'value'=>$text,
                                                    'readonly'=>$diable
                                                ])?>
                                            </div>
                                            <div class="mt-2 ml-2"><?= __("kDa") ?></div>
                                        </div>
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
                                        <?php if($i > 0): ?>
                                        <?= $this->Form->radio('reflect_graf',
                                        [$sop_id=>'text'],
                                        [
                                            'label'=>false
                                        ]);?>
                                        <?php endif; ?>
                                    </td>
                                    <?php endfor; ?>
                                </tr>
                            </table>

                            <div class="row mt-3">
                                <div class="col-6">
                                    <?= $this->Form->button("テーブル反映",[
                                        "class"=>"btn btn-primary w-50 text-white",
                                        "type"=>"button",
                                        "id"=>"tableReflect"
                                    ])?>
                                </div>
                                <div class="col-6 text-right">
                                    <?= $this->Html->link("SOP Export",[
                                        "controller"=>"graphs",
                                        "action"=>"outputSOP",
                                        $id
                                    ],
                                    [
                                        "escape"=>false,
                                        "class"=>"btn btn-warning w-50 text-white",

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
                        <div class="row">
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
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="card card-info">
                                    <div class="card-header"><?= __("データ表示形式") ?></div>
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
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="card card-info">
                                    <div class="card-header"><?= __("表示データ範囲") ?></div>
                                    <div class="card-body p-1">
                                        <div class="row">
                                            <div class="col-2 text-center"><small class="text-muted f6 text-nowrap"><?= __("範囲") ?></small></div>
                                            <div class="col-5 text-center"><small class="text-muted f6"><?= __("下限") ?></small></div>
                                            <div class="col-5 text-center"><small class="text-muted f6"><?= __("上限") ?></small></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 text-center"><small class="text-muted"><?= __("X") ?></small></div>
                                            <div class="col-5">
                                                <?= $this->Form->text("min_x",[
                                                    "class"=>"form-control-sm w-100"
                                                ])?>
                                            </div>
                                            <div class="col-5">
                                                <?= $this->Form->text("max_x",[
                                                    "class"=>"form-control-sm w-100"
                                                ])?>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-2 text-center"><small class="text-muted"><?= __("Y")?></small></div>
                                            <div class="col-5">
                                                <?= $this->Form->text("min_y",[
                                                    "class"=>"form-control-sm w-100"
                                                ])?>
                                            </div>
                                            <div class="col-5">
                                                <?= $this->Form->text("max_y",[
                                                    "class"=>"form-control-sm w-100"
                                                ])?>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-12 text-right">
                                                <a href="javascript:void(0);" id="dataResetButton" class="btn-sm  btn-gray text-black btn-secondary">リセット</a>
                                                <a href="javascript:void(0);" id="dataAreaButton" class="btn-sm text-white  btn-primary">反映</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <?= $this->Html->link("選択データ変更",$this->request->getParam('controller')."/step3_graph/".$id,[
                                'escape'=>false,
                                'class'=>'btn btn-primary w-100 text-white text-center'
                            ])?>
                        </div>
                        <!--
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card card-info">
                                    <div class="card-header"><?= __("スムージング")?></div>
                                    <div class="card-body">
                                        <?= $this->Form->select("smooth",$array_smooth,[
                                            "class"=>"form-control",
                                            "value"=>$smooth,
                                            "id"=>"selectSmoothId"
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="alert alert-success w-100" role="alert">
                   <?= __("エリア毎のテーブル表示") ?>

                </div>
                <div class="div-tableDataExport" >
                    <?= $this->Html->link("Table Data Export","javascript:void(0);",[
                        "class"=>"btn btn-warning  text-white ",
                        "id"=>"tableDataExport"
                    ])?>
                </div>
                <div class="areatable">

                    <table class="mt-3 table table-bordered bg-white lead table-striped blue-stripe" style="width:200%;">
                        <thead>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <?php for($i=1;$i<=5;$i++): ?>
                                <td colspan=5 >
                                    <?php if($i == 1):?>
                                        <?= __("全範囲") ?>
                                    <?php else:
                                        $num = $i-1;
                                        ?>
                                        <?= __("エリア".$num) ?>
                                    <?php endif; ?>
                                </td>
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
                                    <td rowspan=2><?= __("範囲内データ数") ?></td>
                                    <td>
                                        <?= __("エリア最小値") ?><br />
                                        <?= __("(<=)") ?>
                                    </td>
                                    <td id="areamins-<?=$sop_id?>">-</td>
                                    <td>
                                        <?= __("エリア最大値") ?><br />
                                        <?= __("(>)") ?>
                                    </td>
                                    <td id="areamaxs-<?=$sop_id?>">-</td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <?php for($i=1;$i<=5;$i++): ?>

                                    <td><?= __("割合(%)") ?></td>
                                    <td><?= __("平均値(kDa)") ?></td>
                                    <td><?= __("中間値(kDa)") ?></td>
                                    <td><?= __("モード値(kDa)") ?></td>
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
