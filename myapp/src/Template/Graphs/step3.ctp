
<div class="content">

    <div class="container">
        <?= $this->element("graph_step",['step'=>3]); ?>
        <?= $this->Form->create("", [
            'enctype' => 'multipart/form-data',
            'url'=>'/graphs/step4'
            ]); ?>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card ">
                    <div class="card-header bg-primary">
                        <?= __("以前のSOPファイル取込") ?>
                        <i class="fas fa-question-circle yubi" data-toggle="modal" data-target="#modal-default" ></i>
                    </div>
                    <div class="card-body">

                        <div id="upFileWrap">
                            <div id="inputFile">
                                <!-- ドラッグ&ドロップエリア -->
                                <p id="dropArea">ここにファイルをドロップしてください<br>または</p>

                                <!-- 通常のinput[type=file] -->
                                <div id="inputFileWrap">
                                    <input type="file" name="uploadFile" id="uploadFile">
                                    <div id="btnInputFile"><span>ファイルを選択する</span></div>
                                    <div id="btnChangeFile"><span>ファイルを変更する</span></div>
                                </div>
                                <div id="filename">-</div>
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
                                    <td><input type="number" value="" class="form-control" /></td>
                                </tr>
                                <tr>
                                    <td><?= __("表示範囲(最大値)") ?></td>
                                    <td><input type="number" value="" class="form-control" /></td>
                                </tr>
                                <tr>
                                    <td><?= __("Binサイズ(間隔)") ?></td>
                                    <td><input type="number" value="" class="form-control" /></td>
                                </tr>
                                <tr>
                                    <td><?= __("スムージング") ?></td>
                                    <td><input type="number" value="" class="form-control" /></td>
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
                                <tr>
                                    <td>エリア1</td>
                                    <td>2,000</td>
                                    <td ></td>
                                    <td>3,000</td>
                                </tr>
                                <tr>
                                    <td>エリア2</td>
                                    <td>2,000</td>
                                    <td></td>
                                    <td>3,000</td>
                                </tr>
                                <tr>
                                    <td>エリア3</td>
                                    <td>2,000</td>
                                    <td></td>
                                    <td>3,000</td>
                                </tr>


                            </tbody>
                        </table>


                    </div>
                </div>

            </div>

        </div>

        <div class="row m-3">
            <div class="col-md-6 text-center">
                <?= $this->Html->link("戻る","/graphs/step2",[
                    "class"=>"btn btn-secondary w-75",
                ])?>
            </div>
            <div class="col-md-6 text-center">
                <?= $this->Form->submit("データ選択",[
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


