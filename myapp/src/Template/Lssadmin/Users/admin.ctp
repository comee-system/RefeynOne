<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <?= $this->Flash->render() ?>
    <fieldset>
        <legend><?= __('管理者情報変更') ?></legend>
        <div class="row">
            <div class="col-md-6">
            <?php
                echo $this->Form->control('campany',[
                    'class'=>'form-control',
                    'label'=>'会社名'
                ]);
            ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $this->Form->control('sei',[
                    'class'=>'form-control',
                    'label'=>'姓'
                ]); ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->control('mei',[
                    'class'=>'form-control',
                    'label'=>'名'
                ]); ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $this->Form->control('sei_kana',[
                    'class'=>'form-control',
                    'label'=>'姓かな'
                ]); ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->control('mei_kana',[
                    'class'=>'form-control',
                    'label'=>'名かな'
                ]); ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <?php
                    echo $this->Form->control('email',[
                        'class'=>'form-control',
                        'label'=>'メールアドレス'
                    ]);
                ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <?php
                    echo $this->Form->control('username',[
                        'class'=>'form-control',
                        'label'=>'ID'
                    ]);
                ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <?php
                    echo $this->Form->control('password',[
                        'class'=>'form-control',
                        'value'=>'',
                        'required'=>false,
                        'placeholder'=>'更新しないときは未入力',
                        'label'=>'パスワード'
                    ]);
                ?>
            </div>
        </div>
    </fieldset>
    <?= $this->Form->button(__('更新'),[
        'class'=>'btn btn-primary mt-3'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
