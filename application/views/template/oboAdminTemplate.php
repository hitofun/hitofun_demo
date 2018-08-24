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
                <a class="navbar-brand" href="<?php echo base_url();?>oboAdmin/">HitoFun</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>&nbsp;<?php echo($this->ion_auth->user()->row()->first_name . $this->ion_auth->user()->row()->last_name);?>&nbsp;<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url();?>oboAdmin/dashboard/changePassword"><i class="fa fa-gear fa-fw"></i> 修改密碼</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url();?>oboAdmin/login/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                                <a href="<?php echo base_url();?>oboAdmin/dashboard" class="<?php if($this->uri->segment(2) == 'dashboard') {echo('active');}?>"><i class="fa fa-dashboard fa-fw"></i> <?php echo($userMenuList['menu_dashboard']);?></a>
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_user', $userMenuList) || array_key_exists('menu_userGroup', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-user fa-fw"></i> 員工管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_user', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/user" class="<?php if($this->uri->segment(2) == 'user') {echo('active');}?>"><?php echo($userMenuList['menu_user']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_userGroup', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/userGroup" class="<?php if($this->uri->segment(2) == 'userGroup') {echo('active');}?>"><?php echo($userMenuList['menu_userGroup']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_member', $userMenuList) || array_key_exists('menu_oboRefund', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-users fa-fw"></i> 會員管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_member', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/member" class="<?php if($this->uri->segment(2) == 'member') {echo('active');}?>"><?php echo($userMenuList['menu_member']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_oboRefund', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/oboRefund" class="<?php if($this->uri->segment(2) == 'oboRefund') {echo('active');}?>"><?php echo($userMenuList['menu_oboRefund']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_dealer', $userMenuList) || array_key_exists('menu_userGroupDealer', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-smile-o fa-fw"></i> 經銷商管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_dealer', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/dealer" class="<?php if($this->uri->segment(2) == 'dealer') {echo('active');}?>"><?php echo($userMenuList['menu_dealer']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_userGroupDealer', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/userGroupDealer" class="<?php if($this->uri->segment(2) == 'userGroupDealer') {echo('active');}?>"><?php echo($userMenuList['menu_userGroupDealer']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_hotel', $userMenuList) || array_key_exists('menu_hotelPropertyItem', $userMenuList) || array_key_exists('menu_landmark', $userMenuList)
                                || array_key_exists('menu_hotelier', $userMenuList) || array_key_exists('menu_userGroupHotelier', $userMenuList) || array_key_exists('menu_lastMinutePolicy', $userMenuList)
                                || array_key_exists('menu_lastMinuteRoom', $userMenuList) || array_key_exists('menu_hitofunCalendar', $userMenuList) || array_key_exists('menu_oboAutoOrderSetting', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-home fa-fw"></i> 旅館管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_hotelier', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/hotelier" class="<?php if($this->uri->segment(2) == 'hotelier') {echo('active');}?>"><?php echo($userMenuList['menu_hotelier']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_userGroupHotelier', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/userGroupHotelier" class="<?php if($this->uri->segment(2) == 'userGroupHotelier') {echo('active');}?>"><?php echo($userMenuList['menu_userGroupHotelier']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_hotel', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/hotel" class="<?php if($this->uri->segment(2) == 'hotel') {echo('active');}?>"><?php echo($userMenuList['menu_hotel']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_hitofunCalendar', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/hitofunCalendar" class="<?php if($this->uri->segment(2) == 'hitofunCalendar') {echo('active');}?>"><?php echo($userMenuList['menu_hitofunCalendar']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_hotelPropertyItem', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/hotelPropertyItem" class="<?php if($this->uri->segment(2) == 'hotelPropertyItem') {echo('active');}?>"><?php echo($userMenuList['menu_hotelPropertyItem']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_landmark', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/landmark" class="<?php if($this->uri->segment(2) == 'landmark') {echo('active');}?>"><?php echo($userMenuList['menu_landmark']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_lastMinutePolicy', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/lastMinutePolicy" class="<?php if($this->uri->segment(2) == 'lastMinutePolicy') {echo('active');}?>"><?php echo($userMenuList['menu_lastMinutePolicy']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_lastMinuteRoom', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/lastMinuteRoom" class="<?php if($this->uri->segment(2) == 'lastMinuteRoom') {echo('active');}?>"><?php echo($userMenuList['menu_lastMinuteRoom']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_car', $userMenuList) || array_key_exists('menu_carRental', $userMenuList) || array_key_exists('menu_userCarRental', $userMenuList) || array_key_exists('menu_userGroupCarRental', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-car fa-fw"></i> 租車管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_userCarRental', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/userCarRental" class="<?php if($this->uri->segment(2) == 'userCarRental') {echo('active');}?>"><?php echo($userMenuList['menu_userCarRental']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_userGroupCarRental', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/userGroupCarRental" class="<?php if($this->uri->segment(2) == 'userGroupCarRental') {echo('active');}?>"><?php echo($userMenuList['menu_userGroupCarRental']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_carRental', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/carRental" class="<?php if($this->uri->segment(2) == 'carRental') {echo('active');}?>"><?php echo($userMenuList['menu_carRental']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_car', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/car" class="<?php if($this->uri->segment(2) == 'car') {echo('active');}?>"><?php echo($userMenuList['menu_car']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_seller', $userMenuList) || array_key_exists('menu_userGroupSeller', $userMenuList) || array_key_exists('menu_product', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> 滯銷品販售管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_seller', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/seller" class="<?php if($this->uri->segment(2) == 'seller') {echo('active');}?>"><?php echo($userMenuList['menu_seller']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_userGroupSeller', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/userGroupSeller" class="<?php if($this->uri->segment(2) == 'userGroupSeller') {echo('active');}?>"><?php echo($userMenuList['menu_userGroupSeller']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_product', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/product" class="<?php if($this->uri->segment(2) == 'product') {echo('active');}?>"><?php echo($userMenuList['menu_product']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_hotelContractTemplate', $userMenuList) || array_key_exists('carRentalContractTemplate', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-file-text-o fa-fw"></i> 合約管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_hotelContractTemplate', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/hotelContractTemplate" class="<?php if($this->uri->segment(2) == 'hotelContractTemplate') {echo('active');}?>"><?php echo($userMenuList['menu_hotelContractTemplate']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_carRentalContractTemplate', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/carRentalContractTemplate" class="<?php if($this->uri->segment(2) == 'carRentalContractTemplate') {echo('active');}?>"><?php echo($userMenuList['menu_carRentalContractTemplate']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_order', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> <?php echo($userMenuList['menu_order']);?><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url();?>oboAdmin/order/general" class="<?php if($this->uri->segment(2) == 'order' && ($this->uri->segment(3) == 'general' || $this->uri->segment(5) == '1')) {echo('active');}?>">一般訂房</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>oboAdmin/order/lastMinute" class="<?php if($this->uri->segment(2) == 'order' && ($this->uri->segment(3) == 'lastMinute' || $this->uri->segment(5) == '2')) {echo('active');}?>">最後一分鐘</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>oboAdmin/order/obo" class="<?php if($this->uri->segment(2) == 'order' && ($this->uri->segment(3) == 'obo' || $this->uri->segment(5) == '3')) {echo('active');}?>">一口價</a>
                                    </li>
                                    
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_orderCar', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> <?php echo($userMenuList['menu_orderCar']);?><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url();?>oboAdmin/orderCar/obo" class="<?php if($this->uri->segment(2) == 'orderCar' && ($this->uri->segment(3) == 'obo' || $this->uri->segment(5) == '3')) {echo('active');}?>">一口價</a>
                                    </li>
                                    
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_orderProduct', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> <?php echo($userMenuList['menu_orderProduct']);?><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url();?>oboAdmin/orderProduct" class="<?php if($this->uri->segment(2) == 'orderProduct' && ($this->uri->segment(3) == 'obo' || $this->uri->segment(5) == '3')) {echo('active');}?>">一口價</a>
                                    </li>
                                    
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_promotionCompany', $userMenuList)) {?>
                            <li>
                                <a href="#"><i class="fa fa-magic fa-fw"></i> 促銷折扣管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_promotionCompany', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/promotionCompany" class="<?php if($this->uri->segment(2) == 'promotionCompany') {echo('active');}?>"><?php echo($userMenuList['menu_promotionCompany']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php }?>
                        <?php if(array_key_exists('menu_EDM', $userMenuList) || array_key_exists('menu_mailTemplate', $userMenuList) || array_key_exists('menu_rebate', $userMenuList) || array_key_exists('menu_priceStrategiesParameter', $userMenuList)) {?>

                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> Marketing<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if(array_key_exists('menu_EDM', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/EDM" class="<?php if($this->uri->segment(2) == 'EDM') {echo('active');}?>"><?php echo($userMenuList['menu_EDM']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_mailTemplate', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/mailTemplate" class="<?php if($this->uri->segment(2) == 'mailTemplate') {echo('active');}?>"><?php echo($userMenuList['menu_mailTemplate']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_rebate', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/rebate" class="<?php if($this->uri->segment(2) == 'rebate') {echo('active');}?>"><?php echo($userMenuList['menu_rebate']);?></a>
                                        </li>
                                    <?php }?>
                                    <?php if(array_key_exists('menu_priceStrategiesParameter', $userMenuList)) {?>
                                        <li>
                                            <a href="<?php echo base_url();?>oboAdmin/priceStrategiesParameter" class="<?php if($this->uri->segment(2) == 'priceStrategiesParameter') {echo('active');}?>"><?php echo($userMenuList['menu_priceStrategiesParameter']);?></a>
                                        </li>
                                    <?php }?>
                                </ul>
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
            <?php $this->load->view('oboAdmin/' . $view, $contentData);?>
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
</html>