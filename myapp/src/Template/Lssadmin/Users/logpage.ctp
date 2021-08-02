

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <?php foreach($pan as $value): ?>
                            <li class="breadcrumb-item">
                                <?php if($value[ 'link' ]): ?>
                                    <a href="<?= h($value[ 'link' ]) ?>"><?= h($value[ 'title' ]) ?></a>
                                <?php else: ?>
                                    <span><?= h($value[ 'title' ]) ?></span>
                                <?php endif;?>
                            </li>
                        <?php endforeach ;?>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->numbers() ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('{{page}}/全{{pages}}ページ　{{current}} / 全{{count}}件 ')]) ?></p>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col"><?= __("アクセス時間")?></th>
                    <th scope="col"><?= __("ユーザーID")?></th>
                    <th scope="col"><?= __("会員名")?></th>
                    <th scope="col"><?= __("IPアドレス")?></th>
                    <th scope="col" style="width:100px;"><?= __("ブラウザ名(ver)")?></th>
                    <th scope="col"><?= __("アクション")?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sessions as $value): ?>
                <tr>
                    <td><?= date("Y/m/d H:i:s",strtotime($value->created)) ?></td>
                    <td><?= h($value->user_id) ?></td>
                    <td><?= $value->user->username ?></td>
                    <td><?= h($value->ip) ?></td>
                    <td><?= h($value->brauz) ?></td>
                    <td><?= h($value->action) ?></td>


                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

