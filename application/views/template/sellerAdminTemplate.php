<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="none" />

    <title><?php echo $pageTitle;?></title>
        
    <!-- favicon -->
    <link rel="Shortcut Icon" type="image/x-icon" href="<?php echo(base_url() . 'images/favicon.png');?>">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>third_party/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>third_party/sbAdmin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>third_party/sbAdmin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>third_party/sbAdmin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQueryValidation -->
    <link rel="stylesheet" href="<?php echo(base_url() . 'third_party/jQueryValidation/css/validationEngine.jquery.css');?>">

    <!-- jQuery UI -->
    <link rel="stylesheet" href="<?php echo(base_url() . 'third_party/jQueryUI/jquery-ui.min.css');?>">
    <link rel="stylesheet" href="<?php echo(base_url() . 'third_party/jQueryUI/jquery-ui.theme.min.css');?>">
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>third_party/jQuery/jquery.min.js"></script>
    <!-- <script src="<?php echo(base_url() . 'js/jquery.js');?>"></script> -->

    <!-- jQuery UI -->
    <script type="text/javascript" src="<?php echo(base_url() . 'third_party/jQueryUI/jquery-ui.min.js');?>"></script>

    <!-- jQueryValidation -->
    <script src="<?php echo(base_url() . 'third_party/jQueryValidation/js/languages/jquery.validationEngine-zh_TW.js');?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo(base_url() . 'third_party/jQueryValidation/js/jquery.validationEngine.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>third_party/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>third_party/sbAdmin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>third_party/sbAdmin/dist/js/sb-admin-2.js"></script>
    
    <style>

        .customNotification {
            position: fixed;
            top: 60px;
            right: -300px;
            z-index: 100000;
            width: 250px;
        }

        #hintsDiv {
            position: fixed;
            top:-100px;
            right: 0px;
            z-index: 100000;
            width: 100%;
            text-align: center;
            font-size: 20px;
            padding: 10px 0px;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav id="navigationNavar" class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url();?>sellerAdmin/">HitoFun</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>&nbsp;<?php echo($this->ion_auth_seller->user()->row()->first_name . $this->ion_auth_seller->user()->row()->last_name);?>&nbsp;<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url();?>sellerAdmin/dashboard/changePassword"><i class="fa fa-gear fa-fw"></i> 修改密碼</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url();?>sellerAdmin/login/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php if(array_key_exists('menu_dashboard', $userMenuList)) {?>
                            <li>
                                <a href="<?php echo base_url();?>sellerAdmin/dashboard" class="<?php if($this->uri->segment(2) == 'dashboard') {echo('active');}?>"><i class="fa fa-dashboard fa-fw"></i> <?php echo($userMenuList['menu_dashboard']);?></a>
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_seller', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-child fa-fw"></i> 賣家<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_seller', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo (base_url() . 'sellerAdmin/seller/edit/' . $this->ion_auth_seller->user()->row()->id);?>" class="<?php if($this->uri->segment(2) == 'seller') {echo('active');}?>"><?php echo($userMenuList['menu_seller']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_sellerProduct', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> 商品<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_sellerProduct', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo (base_url() . 'sellerAdmin/sellerProduct/');?>" class="<?php if($this->uri->segment(2) == 'sellerProduct') {echo('active');}?>"><?php echo($userMenuList['menu_sellerProduct']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_order', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> 訂單<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_order', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo (base_url() . 'sellerAdmin/order/');?>" class="<?php if($this->uri->segment(2) == 'order') {echo('active');}?>"><?php echo($userMenuList['menu_order']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <?php $this->load->view('sellerAdmin/' . $view, $contentData);?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Notifications start -->
    <div id="successMessage" class="alert alert-success customNotification">
        <?php echo($this->session->flashdata('successMessage'));?>
    </div>
    <div id="errorMessage" class="alert alert-danger customNotification">
        <?php echo($this->session->flashdata('errorMessage'));?>
    </div>

    <div id="hintsDiv">
    </div>
    <!-- Notifications end -->
</body>
<!-- script start -->
<script>
    $(function() {
        $('#inputForm').validationEngine();
        //設定提示訊息顯示
        <?php if(strlen($this->session->flashdata('successMessage')) > 0) {?>
            hints('<?php echo(trim($this->session->flashdata('successMessage')));?>', 'correctness');
        <?php } elseif(strlen($this->session->flashdata('errorMessage')) > 0) { ?>
            hints('<?php echo(trim($this->session->flashdata('errorMessage')));?>', 'error');
        <?php }?>
        
        //menu相關設定
        $('#side-menu li .active').closest('ul').addClass('in').closest('li').addClass('active');

        //提示框點擊消失動作
        $('#hintsDiv').click(function() {
            $('#hintsDiv').stop().fadeOut(300);
        });
    });

    function hints(message, type) {
        //若提示框已展開，則先隱藏
        if($('#hintsDiv').position().top != -100) {
            $('#hintsDiv')
                .stop()
                .hide()
                .html('')
                .css('top', '-100px');
        }

        //將提示框設為顯示
        $('#hintsDiv').show();

        //依據提示類型調整顯示顏色
        if(type == 'correctness') {
            $('#hintsDiv').css({
                'background': 'rgba(223, 240, 216, 0.8)',
                'color': '#3c763d'
            });
            $('#hintsDiv').html('<i class="fa fa-check-circle fa-fw"></i>' + message);
        } else {
            $('#hintsDiv').css({
                'background': 'rgba(242, 222, 222, 0.8)',
                'color': '#a94442'
            });
            $('#hintsDiv').html('<i class="fa fa-times-circle fa-fw"></i>' + message);
        }

        //下滑動畫
        $('#hintsDiv')
            .stop()
            .animate({
                top: 0
            }, 400, 'easeOutExpo')
            .delay(3000)
            .fadeOut(300, function() {
                $('#hintsDiv').css('top', '-100px');
            });
    }
</script>
<!-- script end -->

<!-- Google Analytics -->
<script>
    window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
    ga('create', 'UA-65590788-5', 'auto');
    ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>

</html>