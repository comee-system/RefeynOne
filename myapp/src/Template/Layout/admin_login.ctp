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




        <!-- Content Header (Page header) -->


        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>





<!-- jQuery -->
<?= $this->Html->script('/plugins/jquery/jquery.min.js') ?>
<!-- Bootstrap 4 -->
<?= $this->Html->script('/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>
<!-- AdminLTE App -->
<?= $this->Html->script('/plugins/adminLTE/js/adminlte.min.js') ?>

<?= $this->Html->script('/dists/bundle.js') ?>


</body>
</html>
