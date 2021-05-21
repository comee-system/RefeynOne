<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>グラフ一覧</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">グラフ一覧</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <?= $this->Html->link("グラフ作成","/graphs/",[
                    "class"=>"btn btn-primary"
                ])?>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>グラフ</th>
                        <th>作成日</th>
                        <th >機能</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Update software</td>
                            <td>
                            2021.05.21 10:00
                            </td>
                            <td>
                                <a href="" class="btn-sm btn-success">編集</a>
                                <a href="" class="btn-sm btn-danger">削除</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Clean database</td>
                            <td>
                            2021.05.21 10:00
                            </td>
                            <td>
                                <a href="" class="btn-sm btn-success">編集</a>
                                <a href="" class="btn-sm btn-danger">削除</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</div>
