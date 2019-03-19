<?php
$controller = new Controller();
$config = new Config();
?>
<div class="col-md-9 wrapper">
    <div class="alert alert-jim">
        <h2 class="page-header"><i class="fa fa-home"></i> Home</h2>
        <div class="page-divider"></div>
        <div class="col-sm-4 col-xs-12">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3 class="target"><i class="fa fa-refresh fa-spin"></i></h3>
                    <p>Target Population</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">
                    &nbsp;
                </a>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 class="population"><i class="fa fa-refresh fa-spin"></i></h3>
                    <p>Population Profiled</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">
                    &nbsp;
                </a>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 class="percentage"><i class="fa fa-refresh fa-spin"></i></h3>
                    <p>Goal Completion</p>
                </div>
                <div class="icon">
                    <i class="fa fa-percent"></i>
                </div>
                <a href="#" class="small-box-footer">
                    &nbsp;
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <h3 class="page-header">Monthly
            <small>Progress</small>
        </h3>
        <canvas id="montlyProgress" width="400" height="200"></canvas>
    </div>
</div>
<?php $controller->view('sidebar/home'); ?>
