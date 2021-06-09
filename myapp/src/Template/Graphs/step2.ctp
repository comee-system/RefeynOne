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
                        <?= __("SOPファイル取込") ?>
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
                        <?= __("解析条件") ?>
                        <?= $this->Form->hidden("sopdefaultid",[
                            'value'=>$sopdefaultid
                        ])?>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr class="bg-info">
                                <th class="text-center" colspan=5><?= __("基本設計") ?></th>
                            </tr>
                            <tr>
                                <td><?= __("項目") ?></td>
                                <td><?= __("グラフの開始値") ?><span class="ml-3 badge badge-danger">必須</span></td>
                                <td><?= __("グラフの終了値") ?><span class="ml-3 badge badge-danger">必須</span></td>
                                <td><?= __("Binサイズ") ?><span class="ml-3 badge badge-danger">必須</span></td>
                                <td><?= __("スムージング") ?><span class="ml-3 badge badge-danger">必須</span></td>
                            </tr>
                            <tr>
                                <td><?= __("値") ?></td>
                                <td>
                                    <?= $this->Form->control("defaultpoint",[
                                            "class"=>"form-control sopText",
                                            "type"=>"number",
                                            "value"=>(!empty($SopDefaults->defaultpoint))?$SopDefaults->defaultpoint:"0",
                                            "label"=>false,
                                            "min"=>"0",
                                        ]) ?>
                                </td>
                                <td>
                                    <?= $this->Form->control("dispareamax",[
                                            "class"=>"form-control sopText",
                                            "type"=>"number",
                                            "value"=>(!empty($SopDefaults->dispareamax))?$SopDefaults->dispareamax:"0",
                                            "label"=>false,
                                            "min"=>"0",
                                        ]) ?>
                                </td>
                                <td>
                                    <?= $this->Form->control("binsize",[
                                            "class"=>"form-control sopText",
                                            "type"=>"number",
                                            "min"=>"0",
                                            "value"=>(!empty($SopDefaults->binsize))?$SopDefaults->binsize:"0",
                                            "label"=>false,

                                        ]) ?>
                                </td>
                                <td>
                                    <?= $this->Form->select("smooth",$array_smooth,[
                                            "class"=>"form-control sopText",
                                            "value"=>(!empty($SopDefaults->smooth))?$SopDefaults->smooth:"0",
                                        ]) ?>
                                </td>
                            </tr>
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
                            <tr class="bg-info">
                                <th class="text-center" colspan=6><?= __("エリア設定") ?></th>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <?php for($i=1;$i<=5;$i++ ):?>
                                <td><?= __("エリア".$i) ?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td><?= __("上限") ?></td>
                                <?php for($i=0;$i<=4;$i++ ):?>
                                <td >
                                    <?php if(isset($SopAreas[$i][ 'maxpoint' ])): ?>
                                    <?= h(number_format($SopAreas[$i][ 'maxpoint' ])) ?>
                                    <?php endif; ?>
                                </td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td><?= __("下限") ?></td>
                                <?php for($i=0;$i<=4;$i++ ):?>
                                <td >
                                    <?php if(isset($SopAreas[$i][ 'minpoint' ])): ?>
                                    <?= h(number_format($SopAreas[$i][ 'minpoint' ])) ?>
                                    <?php endif; ?>
                                </td>
                                <?php endfor; ?>
                            </tr>
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
                <?= $this->Html->link("次へ(解析)","/graphs/beforeStep3/".$id,[
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


