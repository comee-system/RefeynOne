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
        <?php
            echo $this->Form->control('username',[
                'class'=>'form-control'
            ]);
            echo $this->Form->control('password',[
                'class'=>'form-control',
                'value'=>'',
                'required'=>false,
                'placeholder'=>'更新しないときは未入力'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('更新'),[
        'class'=>'btn btn-primary mt-3'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
