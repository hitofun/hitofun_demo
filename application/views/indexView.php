<!--style start -->
	<link href="<?php echo(base_url() . 'css/oboIndexCss.css');?>" rel="stylesheet">
    <link href="<?php echo(base_url() . 'third_party/dateRangePicker/daterangepicker.css');?>" rel="stylesheet">
<style>
    /* 日期輸入框style */
    .dateInput {
        cursor: pointer;
    }
    /*字體分開置中*/
    div.avgAligh {
        text-align: justify;
        text-justify: inter-ideograph;
        -ms-text-justify: inter-ideograph; /*IE9*/
        -moz-text-align-last: justify; /*Firefox*/
        -webkit-text-align-last: justify; /*Chrome*/
    }
    div.avgAligh:after {
        content: '';
        display: inline-block;
        width: 100%;
    }

    .lastMinuteTheme {
        margin-top: 10px;
    }

    .lastMinuteTheme p{
        font-size: 45px;
        color: #2ea7e0;
        font-weight: bold;
         /* 設定文字間距 */
        letter-spacing: 2px;
    }

    .lastMinuteContent {
        text-align: left;
        margin-bottom: 70px;
    }

    .lastMinuteContent p {
        font-size: 26px;
        /* 設定文字行距 */
        line-height: 40px;
        /* 設定文字間距 */
        letter-spacing: 4px;
    }
    .pointerButton {
        cursor: pointer;
    }

    .lastMinuteImage {
        position: absolute;
        top: 60px;
        left: 35px;
        width:190px;
        background-color: #080808;
    }
    /*hotelcombined style*/
    .hcsb_poweredBy{
        display: none !important;
    }

    .intro{
        background:url(<?php echo(base_url() . 'images/indexBg/indexBg_' . rand(1, 8) . '.jpg');?>) bottom center no-repeat #cbdde8;
    }

    .modal {
        text-align: center;
        padding: 0!important;
    }

    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }

    .modal-dialog {
        display: inline-block;
        vertical-align: middle;
    }

</style>
<!-- style end -->

<div style="display:none;">
    <div id="inline_content">
        <div class="row descriptionComics">
            <div class="closeComics">
                <img alt="Hitofun" class="img-responsive" id="closeImageComics" src="<?php echo(base_url() . 'images/comicsClose.png');?>" width="30" style="position:fixed;right:-2px;top:-2px;">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 descriptionComics1">
                <img class="img-responsive" alt="Hitofun"  src="<?php echo(base_url() . 'images/comics-1.png');?>"><p class="comicsFontThemeP"><?php echo($this->lang->line('indexView_1'));?></p><p class="comicsFontSateP"><?php echo($this->lang->line('indexView_2'));?></p>                   
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 descriptionComics2">
                <img class="img-responsive" alt="Hitofun" src="<?php echo(base_url() . 'images/comics-2.png');?>"><p class="comicsFontThemeP"><?php echo($this->lang->line('indexView_3'));?></p><p  class="comicsFontSateP"><?php echo($this->lang->line('indexView_4'));?><br/><?php echo($this->lang->line('indexView_5'));?></p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 descriptionComics3">
                <img class="img-responsive" alt="Hitofun" src="<?php echo(base_url() . 'images/comics-3.png');?>"><p class="comicsFontThemeP"><?php echo($this->lang->line('indexView_6'));?></p><p class="comicsFontSateP"><?php echo($this->lang->line('indexView_7'));?></p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 descriptionComics4">
                <img class="img-responsive" alt="Hitofun" src="<?php echo(base_url() . 'images/comics-4.png');?>"><p class="comicsFontThemeP"><?php echo($this->lang->line('indexView_8'));?></p><p class="comicsFontSateP"><?php echo($this->lang->line('indexView_9'));?></p>
            </div>
        </div>
    </div>
</div>
<!-- Intro Header -->
<header class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="logoDistance" id="sloganDiv">
                    <p class="logoThemeFont bigLogoFont" id="bigLogo"></p>
                    <p class="logoThemeFont smallLogoFont" id="smallLogo"></p>
                </div>
            </div>
            <div class="row">
                <div class="index_Button_Top">
                    <p><a id="OBOInfo" class="inline btn btn-default HowUseOBOBtn" href="#inline_content" style="display:none;"><?php echo($this->lang->line('indexView_17'));?></a></p>

                    <div class="col-md-12 index_Container"> 
                        <div>
                            <ul class="nav nav-tabs" id="button">
                                <li id="oboTab" class="active index_Ul-Color"><a data-toggle="tab" href="#home"><?php echo($this->lang->line('indexView_15'));?></a></li>
                            </ul>
                        </div>
                        <div class="tab-content" style="text-align:left;">
                            <div id="home" class="tab-pane fade in active">
                                <form role="form" id="oboSearchForm" method="post" action="<?php echo(base_url() . 'OBO/filter');?>">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label><?php echo($this->lang->line('indexView_24'));?></label>
                                            <select class="form-control validate[required] citySelect" name="city">
                                                <option value=""><?php echo($this->lang->line('indexView_21'));?></option>
                                                <?php foreach ($locationCity as $row) {?>
                                                    <option value="<?php echo($row->locationCityId);?>">
                                                        <?php if($this->session->userdata('language') == 'zh_tw') {echo($row->locationCityName);} else {echo($row->locationCityNameEN);}?>
                                                    </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label style="color:#aaa;"><?php echo($this->lang->line('indexView_25'));?></label>
                                            <select class="form-control validate[required] landmarkSelect" name="landmark" disabled>
                                                <option value=""><?php echo($this->lang->line('indexView_21'));?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label><?php echo($this->lang->line('indexView_26'));?></label>
                                            <input type="input" class="form-control dateInput validate[required]" id="startDate" name="startDate" placeholder="<?php echo($this->lang->line('indexView_26'));?>">
                                        </div>
                                        <div class="col-lg-3">
                                            <label><?php echo($this->lang->line('indexView_27'));?></label>
                                            <input type="input" class="form-control dateInput validate[required]" id="endDate" name="endDate"  placeholder="<?php echo($this->lang->line('indexView_27'));?>" disabled>
                                        </div>
                                        <div class="col-lg-2">
                                            <label><?php echo($this->lang->line('indexView_28'));?></label>
                                            <select name="people" class="form-control validate[required]">
                                                <option value="1">1</option>
                                                <option value="2" selected>2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <label><?php echo($this->lang->line('indexView_29'));?></label>
                                            <select name="room" class="form-control validate[required]">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <label></label>
                                            <div style="text-align:center;">
                                                <button class="btn btn-warning buttonCircle10" type="submit" style="width:100px;font-size:20px;"><?php echo($this->lang->line('indexView_30'));?></button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="country" value="1">
                                    <input type="hidden" name="state" value="0">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="oboNoticeModal" tabindex="-1" role="dialog" data-keyboard="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12" style="font-size:28px;font-weight:bold;">
                            對！HitoFun 就是要你
                            <br><br>
                            喊的安心 住的安心
                            <br><br>
                            HitoFun 訂房保証 買貴退差價
                            <br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-success btn-lg btn-block" data-dismiss="modal">開始喊價！</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- script start -->
<script type="text/javascript" src="<?php echo(base_url() . 'third_party/dateRangePicker/daterangepicker.js');?>"></script>
<script>
    var language = '<?php echo($this->session->userdata('language'));?>';
    var oboBigSloganText = [
        "<?php echo($this->lang->line('indexView_32'));?>",
        "<?php echo($this->lang->line('indexView_32'));?>",
        "<?php echo($this->lang->line('indexView_33'));?>",
        "<?php echo($this->lang->line('indexView_32'));?>",
        "<?php echo($this->lang->line('indexView_34'));?>",
        "<?php echo($this->lang->line('indexView_32'));?>",
        "<?php echo($this->lang->line('indexView_32'));?>",
        "<?php echo($this->lang->line('indexView_32'));?>",
        "<?php echo($this->lang->line('indexView_32'));?>",
        "<?php echo($this->lang->line('indexView_50'));?>"
    ];
    var oboSmallSloganText = [
        "<?php echo($this->lang->line('indexView_35'));?>",
        "<?php echo($this->lang->line('indexView_36'));?>",
        "<?php echo($this->lang->line('indexView_37'));?>",
        "<?php echo($this->lang->line('indexView_38'));?>",
        "<?php echo($this->lang->line('indexView_39'));?>",
        "<?php echo($this->lang->line('indexView_40'));?>",
        "<?php echo($this->lang->line('indexView_41'));?>",
        "<?php echo($this->lang->line('indexView_42'));?>",
        "<?php echo($this->lang->line('indexView_43'));?>",
        "<?php echo($this->lang->line('indexView_51'));?>"
    ];
    var lmBigSloganText = [
        "<?php echo($this->lang->line('indexView_53'));?>",
        "<?php echo($this->lang->line('indexView_53'));?>",
        "<?php echo($this->lang->line('indexView_53'));?>",
        "<?php echo($this->lang->line('indexView_53'));?>",
        "<?php echo($this->lang->line('indexView_53'));?>"
    ];
    var lmSmallSloganText = [
        "<?php echo($this->lang->line('indexView_54'));?>",
        "<?php echo($this->lang->line('indexView_55'));?>",
        "<?php echo($this->lang->line('indexView_56'));?>",
        "<?php echo($this->lang->line('indexView_57'));?>",
        "<?php echo($this->lang->line('indexView_58'));?>"
    ];
    var sloganTimer;

    $(function(){
        //欄位檢查
        $('#oboSearchForm').validationEngine({
            autoPositionUpdate: true,
            promptPosition: 'topLeft'
        });

        //使用說明colorbox
        $("#OBOInfo").colorbox({
            inline: true,
            maxWidth: "80%",
            maxHeight: "90%",
            closeButton: false,
            opacity: 0.6,
            onComplete: function() {
                $('#colorbox, #cboxWrapper').css('overflow', 'visible');
            },
            onClosed: function() {
                $('#colorbox, #cboxWrapper').css('overflow', 'hidden');
            }
        });

        //關閉colorbox
        $('.closeComics').click(function() {
            $.colorbox.close();
        });

        //一口價tab點擊動作
        $('#oboTab').click(function() {
            $('#OBOInfo').fadeIn(500);
            clearTimeout(sloganTimer);
            showTime(1);
            <?php if(is_null(get_cookie('alreadySeenOnoNotice'))) {?>
                $('#oboNoticeModal').modal('show');
                $.ajax({
                method: 'POST',
                url: '<?php echo(base_url() . 'setAlreadySeenOnoNoticeCookie');?>',
                dataType: 'json',
                success: function(response) {
                }
            });
            <?php }?>
        });

        //城市下拉選單動作
        $('.citySelect').change(function() {
            var cityElement = $(this);
            var landmarkElement = $(this).closest('.row').find('.landmarkSelect');

            landmarkElement.find('option:gt(0)').remove();
            landmarkElement.prop('disabled', true);

            $.ajax({
                method: 'POST',
                url: '<?php echo(base_url() . 'getLandmark');?>',
                data: {
                    'countryId': 1,
                    'stateId': 0,
                    'cityId': cityElement.val()
                },
                dataType: 'json',
                success: function(response) {
                    if(response.length > 0) {
                        for(var i = 0;i < response.length;i++) {
                            if(language == 'zh_tw') {
                                landmarkElement.append('<option value="' + response[i].landmarkId + '">' + response[i].landmarkName + '</option>');
                            } else {
                                landmarkElement.append('<option value="' + response[i].landmarkId + '">' + response[i].landmarkNameEN + '</option>');
                            }
                        }
                        landmarkElement.prop('disabled', false);
                        landmarkElement.siblings('label').css('color', '#000');
                    } else {
                        landmarkElement.prop('disabled', true);
                        landmarkElement.siblings('label').css('color', '#aaa');
                    }
                }
            });
        });

        //入住及退房時間datepicker
        $('#startDate, #endDate').keydown(function() {
            return false;
        });

        $('#startDate').datepicker({
            dateFormat: 'yy/mm/dd',
            minDate: new Date(),
            onClose: function() {
                $("#startDate").validationEngine('validate');
            }
        });

        $('#endDate').datepicker({
            dateFormat: 'yy/mm/dd',
            onClose: function() {
                $("#endDate").validationEngine('validate');
            }
        });

        $('#startDate').change(function() {
            if($(this).val() != '') {
                $('#endDate').prop('disabled', false);
                addTime = 60 * 60 * 24 * 1000;
                startTime = Date.parse($(this).val());
                endMinDate = new Date(startTime + addTime);

                $('#endDate').datepicker('option', 'minDate', endMinDate);
            } else {
                $('#endDate').prop('disabled', true);
            }
        });

        //hotelsCombined API
        $('#hotelsCombinedSearchDiv').width($('#home').width());
        $('#hotelsCombinedSearchDiv').show().appendTo('#menu1');

        //set default tab
        <?php if(isset($defaultTab) && $defaultTab == 'compare') {?>
            $('#compareTab').click();
        <?php }?>
    });

    function showTime(type) {
        var randomIndex;
        var bigSloganText;
        var smallSloganText;
        if(type == 1) {
            randomIndex = Math.floor((Math.random() * oboBigSloganText.length) + 1);
            bigSloganText = oboBigSloganText[randomIndex];
            smallSloganText = oboSmallSloganText[randomIndex];
        } else if(type == 2) {
            randomIndex = Math.floor((Math.random() * lmBigSloganText.length) + 1);
            bigSloganText = lmBigSloganText[randomIndex];
            smallSloganText = lmSmallSloganText[randomIndex];
        }

        $('#sloganDiv').stop().fadeOut(200, function() {
            $('#bigLogo').text(bigSloganText);
            $('#smallLogo').text(smallSloganText);
            $('#sloganDiv').fadeIn(500);
        });

        sloganTimer = setTimeout('showTime(' + type + ')', 5000);
    }

    //執行showTime()
    showTime(2);

    function checkDateTime(field, rules, i, options){
        var startDate = new Date(Date.parse($('#startDate_car').val() + ' ' + $('#startTime_car').val()));
        // startDate.setHours($('#startTime_car').val());
        var endDate = new Date(Date.parse($('#endDate_car').val() + ' ' + $('#endTime_car').val()));
        // endDate.setHours($('#endTime_car').val());
        
        if(startDate.getTime() > endDate.getTime()){
            return "*租車日期不能大於還車日期";
        } else if(startDate.getTime() == endDate.getTime()){
            return "*租車日期不能等於還車日期";
        }
    }
</script>
<!-- script end -->
<!-- End Google Analytics