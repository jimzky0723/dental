<?php
    $config = new Config();
    date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $config->base_url('dist/img/favicon.png'); ?>">
    <meta http-equiv="cache-control" content="max-age=0" />
    <title>Monthly Tsekap Report: Offline Version</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $config->base_url('dist/assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo $config->base_url('dist/assets/css/font-awesome.min.css');?>" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo $config->base_url('dist/assets/css/ie10-viewport-bug-workaround.css');?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo $config->base_url('dist/assets/css/style.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $config->base_url('dist/plugin/Lobibox/lobibox.css');?>">
    <link href="<?php echo $config->base_url('dist/plugin/chosen/chosen.css');?>" rel="stylesheet">
    <link href="<?php echo $config->base_url('dist/plugin/select2/select2.min.css');?>" rel="stylesheet">
    <link href="<?php echo $config->base_url('dist/plugin/daterangepicker/daterangepicker-bs3.css');?>" rel="stylesheet">
    <style>
        body {
            background: url('<?php echo $config->base_url('dist/img/backdrop.png');?>'), -webkit-gradient(radial, center center, 0, center center, 460, from(#ccc), to(#ddd));
        }
        .loading {
            opacity:0.4;
            background:#ccc url('<?php echo $config->base_url('dist/img/spin.gif');?>') no-repeat center;
            position:fixed;
            width:100%;
            height:100%;
            top:0px;
            left:0px;
            z-index:9999;
            display: none;
        }

    </style>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <script src="<?php echo $config->base_url('dist/assets/js/ie-emulation-modes-warning.js');?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Fixed navbar -->

<nav class="navbar navbar-default navbar-static-top">
    <div class="header" style="background-color:#2F4054;padding:10px;">
        <div class="col-md-4">
            <span class="title-info">Welcome,</span> <span class="title-desc"><?php echo $_SESSION['name']; ?></span>
        </div>
        <div class="col-md-4">
            <span class="title-info">Location:</span>

            <span class="title-desc">
                <?php echo $_SESSION['muncity']; ?>
            </span>
        </div>
        <div class="col-md-4">
            <span class="title-info">Date:</span> <span class="title-desc"><?php echo date('M d, Y'); ?></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="header" style="background-color:#028482;padding:15px;">
        <div class="container">
            <img src="<?php echo $config->base_url('dist/img/banner.png'); ?>" class="img-responsive" />
        </div>
    </div>
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo $config->base_url('home'); ?>"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="<?php echo $config->base_url('population'); ?>"><i class="fa fa-users"></i> Population</a></li>
                <li><a href="<?php echo $config->base_url('services'); ?>"><i class="fa fa-stethoscope"></i>Services Availed</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-line-chart"></i> Report<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $config->base_url('report'); ?>"><i class="fa fa-table"></i>&nbsp;&nbsp; Services Availed</a></li>
                        <li><a href="<?php echo $config->base_url('report/cases'); ?>"><i class="fa fa-table"></i>&nbsp;&nbsp; Cases Referred</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Settings<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#uploadData" data-toggle="modal"><i class="fa fa-upload"></i>&nbsp;&nbsp; Upload Data</a></li>
                        <li class="divider"></li>
                        <li><a href="#downloadData" data-toggle="modal"><i class="fa fa-download"></i>&nbsp;&nbsp; Download Data</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Account<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $config->base_url('password'); ?>"><i class="fa fa-unlock"></i>&nbsp;&nbsp; Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $config->base_url('logout'); ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="loading"></div>
    <?php require_once 'app/views/'.$data['main'].'.php'; ?>
    <div class="clearfix"></div>
</div> <!-- /container -->
<footer class="footer">
    <div class="container">
        <p class="pull-right">
            Version 1.2
        </p>
        <p>Copyright &copy; 2017 DOH-RO7 All rights reserved</p>
    </div>
</footer>
<?php $controller->view('modal/upload'); ?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo $config->base_url('dist/assets/js/jquery.min.js') ; ?>"></script>
<script src="<?php echo $config->base_url('dist/assets/js/jquery-validate.js') ; ?>"></script>
<script src="<?php echo $config->base_url('dist/assets/js/bootstrap.min.js') ; ?>"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo $config->base_url('dist/assets/js/ie10-viewport-bug-workaround.js') ; ?>"></script>
<script>var loadingState = '<center><img src="<?php echo $config->base_url('dist/img/spin.gif') ; ?>" width="150" style="padding:20px;"></center>'; </script>
<!-- bootstrap datepicker -->
<script src="<?php echo $config->base_url('dist/assets/js/script.js') ; ?>?v=1"></script>
<script src="<?php echo $config->base_url('dist/assets/js/form-justification.js') ; ?>"></script>
<script src="<?php echo $config->base_url('dist/plugin/Lobibox/Lobibox.js') ; ?>"></script>
<script src="<?php echo $config->base_url('dist/plugin/chosen/chosen.jquery.js') ; ?>"></script>
<script src="<?php echo $config->base_url('dist/plugin/select2/select2.full.js') ; ?>"></script>
<script src="<?php echo $config->base_url('dist/plugin/daterangepicker/moment.min.js') ; ?>"></script>
<!-- DATE RANGE SELECT -->
<script src="<?php echo $config->base_url('dist/plugin/daterangepicker/daterangepicker.js') ; ?>"></script>

<script>
    $('.chosen-select').chosen({width: "100%"});
    $(".select2").select2();
    $('.form-submit').on('submit',function(){
        $('.btn-submit').attr('disabled',true);
    });
</script>
<?php require_once 'app/views/'.$data['js'].'.php'; ?>
<?php
$config = new Config();
$status = isset($_SESSION['status']) ? $_SESSION['status']:null;
unset($_SESSION['status']);
if($status=='dataAdded'){
    ?>
    <script>
        Lobibox.notify('success', {
            msg: 'Data uploaded successfully!'
        });
    </script>
    <?php
}
?>
</body>
</html>
