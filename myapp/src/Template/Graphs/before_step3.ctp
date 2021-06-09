
<div class="content" >

    <div class="container">
        <?= $this->element("graph_step",['step'=>3]); ?>
        <?= $this->Form->hidden("id",['id'=>'id','value'=>h($id)])?>

        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card " >
                    <div class="card-header bg-primary">
                        <?= __("グラフの作成中") ?>
                    </div>
                    <div class="card-body text-center" id="createGraf">
                        <p>現在グラフの作成中です。</p>
                        <p>そのままでお待ちください。</p>
                        <img src="/img/create.gif" />
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<?= $this->Form->hidden("id",[
    "value"=>$id
]);?>
<script type="text/javascript">
    //画面の高さ
    var _height = window.innerHeight/2;
    document.getElementById("createGraf").style.height = _height+"px";

</script>


