<div id="screen">
    <div class="spinner-border m-5" role="status">
    <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="content">

    <div class="container">
        <?= $this->element("graph_step",['step'=>2]); ?>
        <?= $this->Form->hidden("id",['id'=>'id','value'=>h($id)])?>
        <?= $this->Form->create("", [
            'enctype' => 'multipart/form-data',
            'url'=>'/graphs/step3'
            ]); ?>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card ">
                    <div class="card-header bg-primary">
                        <?= __("初期値設定：以前のSOPファイル取込") ?>
                        <i class="fas fa-question-circle yubi" data-toggle="modal" data-target="#modal-default" ></i>
                    </div>
                    <div class="card-body">

                        <div id="upFileWrap3">
                            <div id="inputFile3">
                                <!-- ドラッグ&ドロップエリア -->
                                <p id="dropArea3">ここにファイルをドロップしてください<br>または</p>

                                <!-- 通常のinput[type=file] -->
                                <div id="inputFileWrap">
                                    <input type="file" name="uploadFile3" id="uploadFile3">
                                    <div id="btnInputFile3"><span>ファイルを選択する</span></div>
                                    <div id="btnChangeFile3"><span>ファイルを変更する</span></div>
                                </div>
                                <div id="filename3">-</div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card ">
                    <div class="card-header bg-primary">
                        <?= __("SOP（初期設定）") ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-info text-center">
                                <tr>
                                <th>&nbsp;</th>
                                <th><?= __("Mw") ?></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr>
                                    <td><?= __("グラフの初期値") ?></td>
                                    <td>
                                        <?= $this->Form->control("defaultpoint",[
                                            "class"=>"form-control",
                                            "type"=>"number",
                                            "value"=>(!empty($SopDefaults->defaultpoint))?$SopDefaults->defaultpoint:"",
                                            "label"=>false
                                        ]) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= __("表示範囲(最大値)") ?></td>
                                    <td>
                                        <?= $this->Form->control("dispareamax",[
                                            "class"=>"form-control",
                                            "type"=>"number",
                                            "value"=>(!empty($SopDefaults->dispareamax))?$SopDefaults->dispareamax:"",
                                            "label"=>false
                                        ]) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= __("Binサイズ(間隔)") ?></td>
                                    <td>
                                        <?= $this->Form->control("binsize",[
                                            "class"=>"form-control",
                                            "type"=>"number",
                                            "value"=>(!empty($SopDefaults->binsize))?$SopDefaults->binsize:"",
                                            "label"=>false
                                        ]) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= __("スムージング") ?></td>
                                    <td>
                                        <?= $this->Form->control("smooth",[
                                            "class"=>"form-control",
                                            "type"=>"number",
                                            "value"=>(!empty($SopDefaults->smooth))?$SopDefaults->smooth:"",
                                            "label"=>false
                                        ]) ?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12 mt-3">
                <div class="card ">
                    <div class="card-header bg-primary">
                        <?= __("エリア設定") ?>
                        <small>※エリア設定は解析時に入力可能です。</small>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead class="bg-info text-center">
                                <tr>

                                <th></th>
                                <th><?= __("エリア下限")?></th>
                                <th><?= __("≦X＜")?></th>
                                <th><?=__("エリア上限")?></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white text-center no-boarder">
                                <?php foreach( $SopAreas as $key=>$value):?>
                                    <tr>
                                        <td><?= h($value->name) ?></td>
                                        <td><?= number_format($value->minpoint) ?></td>
                                        <td ></td>
                                        <td><?= number_format($value->maxpoint) ?></td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>


                    </div>
                </div>

            </div>

        </div>

        <div class="row m-3">
            <div class="col-md-6 text-center">
                <?= $this->Html->link("戻る","/graphs/index/".$id,[
                    "class"=>"btn btn-secondary w-75",
                ])?>

            </div>
            <div class="col-md-6 text-center">
                <?= $this->Html->link("次へ(解析)","/graphs/step3/".$id,[
                    "class"=>"btn btn-primary w-75"
                ])?>
            </div>
        </div>
        <?= $this->Form->end(); ?>


    </div>
</div>


<!-- モーダル表示 -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p><?= __("「保存された各データフォルダ中の「eventsFitted.csv」というファイルをカーソルで持っていきます」") ?></p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>


