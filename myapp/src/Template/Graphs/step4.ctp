
<div class="content">

    <div class="container">
        <?= $this->element("graph_step",['step'=>4]); ?>
        <?= $this->Form->create("", [
            'enctype' => 'multipart/form-data',
            'url'=>'/graphs/step5'
            ]); ?>
            <div class="row mt-3">
                <div class="col-12">

                    <div class="card card-default">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">グラフの初期表示データの設定</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option selected>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>


                </div>
            </div>
            <div class="row m-3">
                <div class="col-md-6 text-center">
                    <?= $this->Html->link("戻る","/graphs/step3",[
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
