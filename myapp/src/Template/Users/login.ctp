<?php /*
<div class="users form">
  <?= $this->Flash->render() ?>
  <?= $this->Form->create() ?>
  <fieldset>
    <legend><?= __('ユーザ名とパスワードを入力してください') ?></legend>
    <?= $this->Form->control('username') ?>
    <?= $this->Form->control('password') ?>
  </fieldset>
  <?= $this->Form->button(__('Login')); ?>
  <?= $this->Form->end() ?>
</div>
*/?>

<div class="col-md-6 mx-auto mt-5">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="/" class="h1"><b>LOGIN</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><?= __("ユーザー名とパスワードを入力") ?></p>

      <?= $this->Form->create() ?>
        <div class="input-group mb-3">
          <?= $this->Form->text('username',[
              "type"=>"text",
              "class"=>"form-control ",
              "placeholder"=>"username",
              "label"=>false,
              "div"=>false
          ]) ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <?= $this->Form->password('password',[
              "type"=>"password",
              "class"=>"form-control ",
              "placeholder"=>"password",
              "label"=>false,
              "div"=>false
          ]) ?>

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8"></div>
          <!-- /.col -->
          <div class="col-4">
            <?= $this->Form->button(__('Login'),[
                "class"=>"btn btn-primary btn-block"
            ]); ?>
          </div>
          <!-- /.col -->
        </div>
        <?= $this->Form->end() ?>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<div class="mt-5 mb-5">
    <div class="col-sm-8 mx-auto  mb-5">
        <h5>推奨OS・推奨ブラウザ</h5>
        <hr />
        <p>
        安全で快適にご利用いただくために、下記OSと下記バージョンのブラウザのご利用をお勧めいたします。</p>
        <p>推奨ウェブブラウザ以外でのご利用や、推奨ウェブブラウザでもお客さまの設定によっては、ご利用できない場合や正しく表示されない場合があります。
        </p>
        <div class="row">
            <div class="col-md-6">
                <b>Windowsをお使いの場合</b>
                <ul>
                    <li>推奨OS：Windows10以上</li>
                    <li>Microsoft Edge 最新版</li>
                    <li>Mozilla FireFox 最新版</li>
                    <li>Google Chrome 最新版</li>
                </ul>
            </div>
            <div class="col-md-6">
                <b>Macをお使いの場合</b>
                <ul>
                    <li>推奨OS：最新版</li>
                    <li>Safari 最新版</li>
                </ul>
            </div>
        </div>

        <h5 class="mt-2">Javascript・cookieの設定</h5>
        <hr />
        <p>
        ブラウザ設定でJavascriptの設定を有効にしてください。<br />
        Javascriptの設定を無効にされている場合、正しく機能しない、もしくは正しく表示されないことがあります。<br />
        また、一部cookieを利用したコンテンツがございます。Javascript同様設定を有効にしてください。

        </p>

    </div>
</div>
