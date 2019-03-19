<?php
    $s = $_SESSION;
    $config = new Config();
?>
<div class="col-md-3 wrapper">
    <div class="panel panel-jim">
        <div class="panel-heading">
            <h3 class="panel-title">Welcome, <?php echo $s['fname'];?></h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label>Account Name</label>
                <input type="text" readonly class="form-control" value="<?php echo $s['name'];?>" />
            </div>

            <div class="form-group">
                <label>Municipality / City</label>
                <input type="text" readonly class="form-control" value="<?php echo $s['muncity'];?>" />
            </div>

            <div class="form-group">
                <label>Province</label>
                <input type="text" readonly class="form-control" value="<?php echo $s['province'];?>" />
            </div>
            <div class="form-group">
                <a href="<?php echo $config->base_url('logout'); ?>" class="btn btn-success col-sm-12"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>
    </div>
</div>