<?php
$controller = new Controller();
$config = new Config();
?>
<div class="col-md-9 wrapper">
    <div class="alert alert-jim">
        <h2 class="page-header"><i class="fa fa-home"></i> Home</h2>
        <div class="page-divider"></div>
    </div>
</div>
<?php $controller->view('sidebar/home'); ?>
<?php $controller->view('modal/upload'); ?>
