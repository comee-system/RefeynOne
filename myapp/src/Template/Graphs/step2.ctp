
<div class="content">

    <div class="container">
        <?= $this->element("graph_step",['step'=>2]); ?>
        <?= $this->Form->create("", [
            'url'=>'/graphs/step3'
            ]); ?>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card ">
                    <div class="card-header bg-primary">
                        <?= __("取込みデータ確認") ?>
                        <i class="fas fa-question-circle yubi" data-toggle="modal" data-target="#modal-default" ></i>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th style="width: 10px">#</th>
                                <th>Label</th>
                                <th>データ数</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Update software</td>
                                    <td>1,000</td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Update software</td>
                                    <td>1,000</td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Update software</td>
                                    <td>1,000</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
        <div class="row m-3">
            <div class="col-md-6 text-center">
                <?= $this->Html->link("戻る","/graphs",[
                    "class"=>"btn btn-secondary w-75",
                ])?>
            </div>
            <div class="col-md-6 text-center">
                <?= $this->Form->submit("SOPの設定",[
                    "class"=>"btn btn-primary w-75"
                ])?>
            </div>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>




