<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

<?php /*
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
*/ ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <?= $this->Html->css('/plugins/fontawesome-free/css/all.min.css') ?>
    <?= $this->Html->css('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>

    <?= $this->Html->css('/plugins/adminLTE/css/adminlte.css') ?>
    <?= $this->Html->script('/plugins/adminLTE/js/adminlte.js') ?>

    <?= $this->Html->css('/css/basic.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="hold-transition sidebar-mini ">

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <span class="brand-text font-weight-light text-white"></span>
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>会員情報</p>
            </a>
            <ul class="nav nav-treeview" style="display:block;">
                <li class="nav-item">
                    <?php
                        $url = $this->Url->build([
                            "controller" => "users",
                            "action" => "index",
                        ]);?>
                    <a href="<?= h($url) ?>" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>会員一覧</p>
                    </a>
                </li>
                <li class="nav-item">
                    <?php
                        $url = $this->Url->build([
                            "controller" => "users",
                            "action" => "edit",
                        ]);?>
                    <a href="<?= h($url) ?>" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>会員登録</p>
                    </a>
                </li>
                <li class="nav-item">
                    <?php
                        $url = $this->Url->build([
                            "controller" => "users",
                            "action" => "admin",
                        ]);?>
                    <a href="<?= h($url) ?>" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>管理者更新</p>
                    </a>
                </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->


        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>




    <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer mt-5">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>RefeynOneソフトウエア</strong> All rights reserved.
  </footer>

  <!-- /.control-sidebar -->
</div>

<!-- jQuery -->
<?= $this->Html->script('/plugins/jquery/jquery.min.js') ?>
<?= $this->Html->script('/plugins/jquery/jquery-ui.js') ?>

<!-- Bootstrap 4 -->
<?= $this->Html->script('/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>
<?= $this->Html->script('/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') ?>

<?= $this->Html->script('/plugins/chart.js/Chart.min.js') ?>

<!-- AdminLTE App -->
<?= $this->Html->script('/plugins/adminLTE/js/adminlte.min.js') ?>
<?= $this->Html->script('/dists/bundle.js') ?>


</body>
</html>
