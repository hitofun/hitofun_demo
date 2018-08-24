<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Hitofun 一口價，試試你的運氣！">
        <meta name="keywords" content="HitoFun, 一口價, 旅館預訂, 旅宿預訂, 飯店預訂, 飯店訂房, 預訂, 旅館, 訂房, 民宿, 住宿, 住房, 商旅, 汽車旅館, 摩鐵, 渡假村, 度假村, Hotel, Motel, Villa, 台灣, Taiwan, 台北市, 西門町, 信義區, 基隆市, 新北市, 桃園市, 新竹市, 新竹縣, 宜蘭縣, 苗栗縣, 台中市, 日月潭, 彰化縣, 南投縣, 嘉義市, 嘉義縣, 雲林縣, 台南市, 高雄市, 澎湖縣, 屏東縣, 台東縣, 花蓮縣, 金門縣, 連江縣, 優惠價格, 討價還價, 議價, 殺價, 飯店評論 網路預訂, 地圖, 租車, 喊價租車, 一口價租車, 資源共享, 資源共享平台" />
        <meta name="author" content="">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta property="wb:webmaster" content="b2b1df25e5312e5b" />
        <?php
            if(isset($lastMinuteRoom)) {
                echo('<meta property="og:title" content="當日最後一分鐘 - ' . $lastMinuteRoom->hotelName . ' ' . $lastMinuteRoom->hotelRoomName . ' 今日入住 只要$' . number_format($lastMinuteRoom->lowestPrice) . '起">');

                foreach($hotelRoomGallery as $hotelImage) {
                    list($width, $height) = getimagesize(base_url() . $hotelImage->hotelGalleryUrl);
                    echo('<meta property="og:image" content="' . base_url() . $hotelImage->hotelGalleryUrl . '">');
                    echo('<meta property="og:image:width" content="' . $width . '" />');
                    echo('<meta property="og:image:height" content="' . $height . '" />');
                }
            }
        ?>

        <title><?php echo $pageTitle;?></title>
        
        <!-- favicon -->
        <link rel="Shortcut Icon" type="image/x-icon" href="<?php echo(base_url() . 'images/favicon.png');?>">

        <!-- Bootstrap Core CSS -->

        <link rel="stylesheet" href="<?php echo(base_url() . 'third_party/dist/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo(base_url() . 'third_party/jQueryValidation/css/validationEngine.jquery.css');?>">
        <link rel="stylesheet" href="<?php echo(base_url() . 'third_party/jQueryUI/jquery-ui.min.css');?>">
        <link rel="stylesheet" href="<?php echo(base_url() . 'third_party/jQueryUI/jquery-ui.theme.min.css');?>">

        <link rel="stylesheet" href="<?php echo(base_url() . 'css/grayscale.css');?>">
        <link rel="stylesheet" href="<?php echo(base_url().'css/oboAllCss.css');?>">
        <link rel="stylesheet" href="<?php echo(base_url() . 'third_party/colorbox/colorbox.css');?>">
        <link rel="stylesheet" href="<?php echo(base_url() . 'third_party/sbAdmin/bower_components/font-awesome/css/font-awesome.min.css');?>">

        <script type="text/javascript" src="<?php echo(base_url() . 'js/jquery.js');?>"></script>
        <script type="text/javascript" src="<?php echo(base_url() . 'third_party/dist/js/bootstrap.js');?>"></script> 
        <script type="text/javascript" src="<?php echo(base_url() . 'third_party/jQueryValidation/js/jquery.validationEngine.js');?>"></script>
        <script type="text/javascript" src="<?php echo(base_url() . 'js/grayscale.js');?>"></script>
        <script type="text/javascript" src="<?php echo(base_url() . 'third_party/jQueryValidation/js/languages/jquery.validationEngine-zh_TW.js" type="text/javascript" charset="utf-8');?>"></script>
        <script type="text/javascript" src="<?php echo(base_url() . 'third_party/colorbox/jquery.colorbox.js');?>"></script> 
        <script type="text/javascript" src="<?php echo(base_url() . 'third_party/jQueryUI/jquery-ui.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo(base_url() . 'third_party/moment.js');?>"></script> 

        <style>
            <?php if($this->session->userdata('language') == 'zh_cn') {?>
                @import url(http://fonts.googleapis.com/earlyaccess/notosanssc.css);
                * {
                    font-family: 'Arial', 'Noto Sans SC', sans-serif;
                }
                .btn, h1, h2, h3, h4, h5, h6 {
                    font-family: 'Arial', 'Noto Sans SC', sans-serif !important;
                }
            <?php } else if($this->session->userdata('language') == 'zh_tw') {?>
                @import url(http://fonts.googleapis.com/earlyaccess/cwtexyen.css);
                * {
                    font-family: 'Arial', 'cwTeXYen', sans-serif;
                }
                .btn, h1, h2, h3, h4, h5, h6 {
                    font-family: 'Arial', 'cwTeXYen', sans-serif !important;
                }
            <?php } else if($this->session->userdata('language') == 'korean') {?>
                @import url('http://fonts.googleapis.com/earlyaccess/nanumgothic.css');
                * {
                    font-family: 'Arial', 'Nanum Gothic', sans-serif;
                }
                .btn, h1, h2, h3, h4, h5, h6 {
                    font-family: 'Arial', 'Nanum Gothic', sans-serif !important;
                }
            <?php } else {?>
                @import url('https://fonts.googleapis.com/css?family=Khula');
                * {
                    font-family: 'cwTeXYen', 'Khula', sans-serif;
                }
                .btn, h1, h2, h3, h4, h5, h6 {
                    font-family: 'cwTeXYen', 'Khula', sans-serif !important;
                }
            <?php }?>
            
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

            .footerLink:hover, .footerLink:focus {
                color: #c9b4e0;
            }

            .footerLink:visited, .footerLink:link {
                color: #d7f2f0;   
            }

            .footerIcon:hover, .footerIcon:focus {
                color: #fff;
            }
            
            .footerIcon:visited, .footerIcon:link {
                color: #fff;   
            }
            .scrollTitle {
                text-shadow: 3px 3px 10px #000;
            }

            #logoImg {
                -webkit-filter: drop-shadow(3px 3px 10px #000);
                width: 120px;
            }

            .scrollTitle:hover ,.scrollTitle:focus {
                color: #fff;
                text-decoration:underline !important;
            }
            .navbar-custom .nav .changeLanguage:hover, .navbar-custom .nav .loginButton:hover {
                color: #000;
                outline: none; 
                background-color: #f5f5f5;
            }
            /*Social Bar*/
            #socialBarDiv {
                position: fixed;
                width: 45px;
                height: 100px;
                background: rgba(255, 255, 255, 0.8);
                left: 0px;
                top: 100px;
                text-align: center;
                font-size: 40px;
                -webkit-border-top-right-radius: 8px;
                -webkit-border-bottom-right-radius: 8px;
                -moz-border-radius-topright: 8px;
                -moz-border-radius-bottomright: 8px;
                border-top-right-radius: 8px;
                border-bottom-right-radius: 8px;
            }

            @media (max-width: 767px) {
                .dropdown-menu>li>a {
                    color: #fff;
                }
            }
        </style>
    
    </head>
    
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        
        <!-- Navigation -->
        <nav class="navbar navbar-custom navbar-fixed-top top-nav-collapse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                        Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" style="padding-top:5px;" href="<?php echo base_url();?>">
                        <img id="logoImg" class="img-responsive img-rounded"  alt="Responsive image" src="<?php echo(base_url() . 'images/logo_horizontal.png');?>">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse" style="font-family: 'cwTeXYen', sans-serif">
                    <ul class="nav navbar-nav">
                        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <!-- Intro Header -->
        <?php $this->load->view($view, $contentData);?>
        <!-- Footer start -->
        <footer>
            <div class="container">
                <div class="pull-right" style="font-size: 25px;">
                    <a class="footerIcon" href="https://www.facebook.com/hitofun/"><i class="fa fa-facebook-square" aria-hidden="true" style="margin: 0px 5px;"></i></a>
                    <a class="footerIcon" href="https://www.youtube.com/channel/UCTJMxXqE3CwVMUo6GvI1gow"><i class="fa fa-youtube" aria-hidden="true" style="margin: 0px 5px;"></i></a>
                </div>
                <div class="text-center">
                    <a class="footerLink" href="#"><?php echo($this->lang->line('webTemplate_5'));?></a>&nbsp;&nbsp;&nbsp;
                    <a class="footerLink" href="<?php echo base_url();?>userTerms"><?php echo($this->lang->line('webTemplate_6'));?></a>&nbsp;&nbsp;&nbsp;
                    <a class="footerLink" href="<?php echo base_url();?>userPrivacy""><?php echo($this->lang->line('webTemplate_7'));?></a>&nbsp;&nbsp;&nbsp;
                    <a class="footerLink" href="<?php echo base_url();?>faq"><?php echo($this->lang->line('webTemplate_8'));?></a>&nbsp;&nbsp;&nbsp;
                    <a class="footerLink" href="<?php echo base_url();?>investment"><?php echo($this->lang->line('webTemplate_12'));?></a>
                    <p style="font-size:15px;">Copyright &copy; hitofun.com 2017</p>
                </div>
            </div>
        </footer>
        <!-- Footer end -->

        <!-- Social Bar start -->
        <!-- <div id="socialBarDiv" class="hidden-xs" style="z-index:500;">
            <div>
                <a class="footerIcon" href="https://www.facebook.com/hitofun/" style="color:#3b5998;">
                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                </a>
            </div>
            <div style="margin-top:-15px;">
                <a class="footerIcon" href="https://www.youtube.com/channel/UCTJMxXqE3CwVMUo6GvI1gow" style="color:#ee0f0f;">
                    <i class="fa fa-youtube-square" aria-hidden="true"></i>
                </a>
            </div>
        </div> -->
        <!-- social Bar end -->

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

            //換語言session
            $('.changeLanguage').click(function() {
                $.ajax({
                    url: '<?php echo(base_url() . 'changeLanguage/');?>' + $(this).attr('id'),
                    dataType: 'json',
                    success: function(response) {
                        if(response) {
                            location.reload();
                        }
                    }
                });
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
        ga('create', 'UA-65590788-4', 'auto');
        ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
</html>
