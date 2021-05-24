<div class="login-box mx-auto mt-5">
  <div class="login-logo">
        <?=$this->Html->image("lss-logo_1.png",[
            'url'=>[],
            'dev'=>false,
            'class'=>'__logo'
        ],
        ); ?>
  </div>

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

        <?= $this->Form->create("",[
        ])?>
        <div class=" mb-3">
            <label>ログインID</label>
          <?= $this->Form->control('username',[
              'label'=>false,
              'class'=>'form-control'
          ]) ?>
        </div>
        <div class=" mb-3">
        <label>パスワード</label>
            <?= $this->Form->control('password',[
              'label'=>false,
              'type'=>'password',
              'class'=>'form-control'
          ]) ?>
        </div>
        <div class="row">
          <div class="col-12 mx-auto">
            <?= $this->Form->button('ログイン',[
              'label'=>false,
              'type'=>'submit',
              'class'=>'btn btn-primary w-100'
          ]) ?>
          </div>
          <!-- /.col -->
        </div>
      <?= $this->Form->end() ?>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
