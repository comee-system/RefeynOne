

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
                    <!--
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    -->
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
                    <th scope="col"><?= __("機能") ?></th>
                    <th scope="col"><?= __("企業名")?></th>
                    <th scope="col"><?= __("担当者氏名")?></th>
                    <th scope="col"><?= __("メールアドレス")?></th>
                    <th scope="col"><?= __("利用終了日")?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td class="actions">
                        <?= $this->Html->link(__('編集'), [
                            'action' => 'edit', $user->id
                        ],[
                            'class'=>'btn-sm btn-success'
                        ]); ?>

                        <?= $this->Form->postLink(__('削除'),
                         ['action' => 'delete', $user->id],
                         ['confirm' => __('削除を行います。 # {0}?', $user->id),
                         'class'=>'btn-sm btn-danger'
                         ]
                        ); ?>
                    </td>
                    <td><?= h($user->campany) ?></td>
                    <td><?= h($user->sei) ?><?= h($user->mei) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td>
                        <?php if($user->datestatus == 1): ?>
                            期限なし
                        <?php else: ?>
                            <?= h(date("Y/m/d",strtotime($user->startdate))) ?>～
                            <?= h(date("Y/m/d",strtotime($user->enddate))) ?>
                        <?php endif;?>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

