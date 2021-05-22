
<div class="content">

    <div class="container">
        <?= $this->element("graph_step",['step'=>5]); ?>
        <?= $this->Form->create("", [
            'enctype' => 'multipart/form-data',
            'url'=>'/graphs/step6'
            ]); ?>
            <div class="row mt-3">
                <div class="col-md-10">
                    <!-- LINE CHART -->
                    <div class="card card-info">
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="lineChart" style="min-height: 250px; height: 300px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <a href="" class="btn btn-outline-info w-100">SOPエリアの設定</a>
                    <!-- /.card -->
                </div>
                <div class="col-md-2">
                    <div class="ml-2">
                        <div class="row">
                            <?= $this->Form->button("png<br />Export",[
                                "class"=>"btn btn-warning w-100 text-white",
                                "type"=>"button"
                            ])?>
                        </div>
                        <div class="row mt-3">
                            <?= $this->Form->button("CSV<br />Export",[
                                "class"=>"btn btn-warning w-100 text-white",
                                "type"=>"button"
                            ])?>
                        </div>
                        <div class="row mt-3">
                            <?= $this->Form->button("グラフ<br />表示変更",[
                                "class"=>"btn btn-warning w-100 text-white",
                                "type"=>"button"
                            ])?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-3">
                    <div class="card card-info">
                        <div class="card-header">解析基準</div>
                        <div class="card-body">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="analyticsBasic1" name="analyticsBasic">
                                <label for="analyticsBasic1" class="custom-control-label">Number</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="analyticsBasic2" name="analyticsBasic" checked>
                                <label for="analyticsBasic2" class="custom-control-label">Mass</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card card-info">
                        <div class="card-header"><?= __("データ表示") ?></div>
                        <div class="card-body">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="dataDisplay1" name="dataDisplay">
                                <label for="dataDisplay1" class="custom-control-label">Count</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="dataDisplay2" name="dataDisplay" checked>
                                <label for="dataDisplay2" class="custom-control-label">Normalized</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card card-info">
                        <div class="card-header"><?= __("データ範囲") ?></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4 text-center"><small class="text-muted"><?= __("下限") ?></small></div>
                                <div class="col-4 text-center"><small class="text-muted"><?= __("上限") ?></small></div>
                            </div>
                            <div class="row">
                                <div class="col-4 text-center"><small class="text-muted"><?= __("X軸の範囲") ?></small></div>
                                <div class="col-4">
                                    <input type="text" name="" value=""  class="form-control-sm w-100" />
                                </div>
                                <div class="col-4">
                                    <input type="text" name="" value=""  class="form-control-sm w-100" />
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-4 text-center"><small class="text-muted"><?= __("Y軸の範囲")?></small></div>
                                <div class="col-4">
                                    <input type="text" name="" value=""  class="form-control-sm w-100" />
                                </div>
                                <div class="col-4">
                                    <input type="text" name="" value=""  class="form-control-sm w-100" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card card-info">
                        <div class="card-header"><?= __("スムージング")?></div>
                        <div class="card-body">
                            <input type="text" name="" value=""  class="form-control-sm w-100" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <a href="" class="btn btn-outline-success w-100">エリア毎のテーブル表示</a>
            </div>
            <div class="row m-3">
                <div class="col-md-6 text-center">
                    <?= $this->Html->link("戻る","/graphs/step4",[
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
