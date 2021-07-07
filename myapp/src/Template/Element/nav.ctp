  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <?=$this->Html->image("lss-logo_1.png",[
            'url'=>[],
            'dev'=>false,
            'class'=>'__logo'
        ],
        ); ?>
      </li>

    </ul>
    <!-- Right navbar links -->
    <?php if(empty($this->noNavi)): ?>
    <ul class="navbar-nav ml-auto">
        <?php /*if($uAuth): ?>
        <li>
            <?= $this->Html->link("グラフ一覧",
            "/users",
            [
                "class"=>"btn btn-outline-primary mr-2"
            ])?>
        </li>
        <?php endif;*/ ?>
        <li>
        <?php if(!$uAuth): ?>
            <?= $this->Html->link("ログイン",
            "/users/login",
            [
                "class"=>"btn btn-outline-primary"
            ])?>
        <?php else: ?>
            <?= $this->Html->link("ログアウト",
            "/users/logout",
            [
                "class"=>"btn btn-outline-danger"
            ])?>

        <?php endif; ?>
        </li>
    </ul>
    <?php endif; ?>
  </nav>
