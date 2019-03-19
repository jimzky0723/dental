<?php
$controller = new Controller();
$config = new Config();
?>
<div class="col-md-9 wrapper">
    <div class="alert alert-jim">
        <h2 class="page-header">Change Password</h2>
        <div class="page-divider"></div>
        <form method="POST" class="form-horizontal" action="<?php echo $config->base_url('password/change'); ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label">Current Password</label>
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="current">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">New Password</label>
                <div class="col-sm-7">
                    <input type="password" pattern=".{3,}" title="New password - minimum of 3 Character" class="form-control" name="new" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Confirm Password</label>
                <div class="col-sm-7">
                    <input type="password" pattern=".{3,}" title="Confirm password - minimum of 3 Character" class="form-control" name="confirm" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-send"></i> Change Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $controller->view('sidebar/home'); ?>
