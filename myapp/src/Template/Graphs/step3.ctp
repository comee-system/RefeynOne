
<div class="content">

    <div class="container">
        <?= $this->element("graph_step",['step'=>3]); ?>
        <?= $this->Form->hidden("id",['id'=>'id','value'=>h($id)])?>
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
                            <div class="text-right mb-3 ">
                                <?= $this->Form->button("追加",[
                                    "class"=>"btn-sm btn-warning text-white",
                                    "type"=>"button",
                                    "id"=>"addSop"
                                ])?>
                            </div>
                            <table class="table table-bordered" id="sopTable">
                                <tr class="bg-info text-center">
                                    <th></th>
                                    <th><?= __("エリア下限") ?></th>
                                    <th><?= __(" ≦ X ≦") ?></th>
                                    <th><?= __("エリア上限") ?></th>
                                    <th><?= __("グラフに反映") ?></th>
                                </tr>
                                <tbody id="soptbody"></tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>


                    <!-- /.card -->
                </div>
                <div class="col-md-2">
                    <div class="ml-2">
                        <div class="row">
                            <?= $this->Form->button("png<br />Export",[
                                "class"=>"btn btn-warning w-100 text-white",
                                "type"=>"button",
                                "id"=>"pngExport"
                            ])?>
                        </div>
                        <div class="row mt-3">
                            <?= $this->Form->button("CSV<br />Export",[
                                "class"=>"btn btn-warning w-100 text-white",
                                "type"=>"button"
                            ])?>
                        </div>
                        <div class="row mt-3">
                            <?= $this->Html->link("グラフ<br />表示変更",$this->request->getParam('controller')."/step3_graph/",[
                                'escape'=>false,
                                'class'=>'btn btn-warning w-100 text-white text-center'
                            ])?>
                        </div>


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
                <a href="" class="btn btn-outline-success w-100">エリア毎のテーブル表示</a>
            </div>
            <div class="row m-3">
                <div class="col-md-6 text-center">
                    <?= $this->Html->link("戻る","/graphs/step2/".$id,[
                        "class"=>"btn btn-secondary w-75",
                    ])?>
                </div>
                <div class="col-md-6 text-center">
                    <?= $this->Form->submit("解析",[
                        "class"=>"btn btn-primary w-75"
                    ])?>
                </div>
            </div>
        <?= $this->Form->end(); ?>
    </div>
</div>
