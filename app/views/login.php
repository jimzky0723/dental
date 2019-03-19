<?php
    $config = new Config();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DOHRO7 TSEKAP | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $config->base_url('dist/assets/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $config->base_url('dist/assets/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo $config->base_url('dist/assets/css/AdminLTE.min.css'); ?>">
    <link rel="icon" href="<?php echo $config->base_url('dist/img/favicon.png'); ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body class="hold-transition login-page">

<div class="login-box">
    <div class="login-logo">
        <img src="<?php echo $config->base_url('dist/img/logo.png');?>" />
        <br />
        <a href="#"><b>OFFLINE</b> TSEKAP</a>
    </div><!-- /.login-logo -->

    <form role="form" method="POST" action="<?php echo $config->base_url('login/validate');?>">
        <div class="login-box-body">
            <p class="login-box-msg">
                Version 1.2<br/>
                Sign in to start your session
            </p>
            <?php if(isset($_GET['login']) && $_GET['login']=='error'): ?>
                <div class="alert alert-danger">
                    Invalid username of incorrect password!
                </div>
            <?php endif; ?>

            <?php if(isset($_GET['login']) && $_GET['login']=='invalid'): ?>
                <div class="alert alert-danger">
                    Invalid data type!
                </div>
            <?php endif; ?>

            <?php if(isset($_GET['upload']) && $_GET['upload']=='ok'): ?>
                <div class="alert alert-success">
                    <i class="fa fa-check"></i> Successfully added/updated!
                </div>
            <?php endif; ?>
            <div class="form-group has-feedback <?php if($_GET['login']=='error') echo 'has-error'; ?>">
                <input id="username" type="text" placeholder="Login ID" class="form-control" name="username" value="" autocomplete="off">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback <?php if($_GET['login']=='error') echo 'has-error'; ?>">
                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <a href="#addAccount" data-toggle="modal" class="col-sm-12 btn btn-warning btn-flat"><i class="fa fa-user-plus"></i> Account</a>
                </div>
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-unlock"></i> Sign In</button>
                </div><!-- /.col -->
            </div>
        </div><!-- /.login-box-body -->

    </form>
</div><!-- /.login-box -->


<div class="modal fade" role="dialog" id="addAccount">
    <div class="modal-dialog modal-sm" role="document">
        <form method="POST" action="<?php echo $config->base_url('login/upload'); ?>" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #028482;color:#fff;font-weight: bold;">
                    <i class="fa fa-user-plus"></i> UPLOAD ACCOUNT
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="file" class="form-control" required accept=".DOH7" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-sm" ><i class="fa fa-send"></i> Upload</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php if(isset($_SESSION['username'])): ?>
<div class="modal fade" role="dialog" id="loginInfo">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #028482;color:#fff;font-weight: bold;">
                <i class="fa fa-user"></i> LOGIN INFORMATION:
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <tr>
                        <td class="text-right">Username</td>
                        <td>:</td>
                        <td class="text-info"><?php echo $_SESSION['username'];?></td>
                    </tr>
                    <tr>
                        <td class="text-right">Password</td>
                        <td>:</td>
                        <td class="text-info"><?php echo $_SESSION['username'];?></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    <?php unset($_SESSION['username']);?>
</div><!-- /.modal -->
<?php endif; ?>
<!-- jQuery 2.1.4 -->
<script src="<?php echo $config->base_url('dist/assets/js/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo $config->base_url('dist/assets/js/bootstrap.min.js'); ?>"></script>
<script>
    $('#loginInfo').modal('show');
</script>
<!-- iCheck -->
</body>
</html>
