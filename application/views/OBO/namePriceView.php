<!-- style start -->
<style>

    .priceCenterBold{
        text-align:center;font-weight:900;
    }

    .resultLi{
        margin: 8px 0px;
    }

    .resultLi span{
        font-size: 16px;
    }

    /* tooltip style */
    .tooltip{
        opacity: 1;
    }

    .tooltip-inner{
        font-size: 20px;
        background-color: #d9534f;
        max-width: 180px;
        text-align: left;
    }

    .tooltip.bottom .tooltip-arrow{
        border-bottom-color: #d9534f;
    }


</style>
<!-- style end -->

<header class="intro">
    <div class="intro-body">
        <div class="container StamentFontLeftTop80">
            <form role="form" id="namePriceForm" method="post" action="<?php echo(base_url() . 'OBO/confirmOrder');?>" class="form-inline">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-warning form-inline text-center" role="alert">
                            <span style="font-weight:bold;font-size:20px;color:#d9534f;"><?php echo($this->lang->line('namePriceView_5'));?></span>
                            <h3 class="text-center" style="margin-top:60px;"><?php echo($this->lang->line('namePriceView_6'));?></h3>
                            <h5 class="text-center" style="font-weight:bold;margin-top:-30px;margin-bottom:80px;"><?php echo(sprintf($this->lang->line('namePriceView_7'), OBO_REQUIRE_TIME));?></h5>
                            <div class="center-block" style="position:relative;width:90%;">
                                <div id="tipDiv" class="tooltip bottom" role="tooltip" style="position:absolute;top:20px;z-index:0;">
                                    <div id="tipArrowDiv" class="tooltip-arrow"></div>
                                    <div id="tipTextDiv" class="tooltip-inner" id="tipTextDiv"><?php echo($this->lang->line('namePriceView_8'));?></div>
                                </div>
                            </div>
                            <div class="progress center-block" style="width:90%;">
                                <div class="progress-bar progress-bar-danger progress-bar-striped" style="width:20%;">
                                    <span class="sr-only"></span>
                                </div>
                                <div class="progress-bar progress-bar-success" style="width:60%;">
                                    <span class="sr-only"></span>
                                </div>
                                <div class="progress-bar progress-bar-danger progress-bar-striped" style="width:20%;">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                        <div style="margin-top:110px;">
                            <p class="text-center">
                                <?php echo($this->lang->line('namePriceView_18'));?><span style="color:#d9534f;font-weight:bold;"><?php echo($this->lang->line('namePriceView_9'));?></span><?php echo($this->lang->line('namePriceView_10'));?><span style="color:#d9534f;font-weight:bold;"><?php echo($this->lang->line('namePriceView_11'));?></span><?php echo($this->lang->line('namePriceView_12'));?>
                                <br>
                                <input type="tel" name="oboPrice" id="namePriceInput" class="form-control validate[required, min[1]]" value="<?php echo($filterResult->oboPrice);?>" style="font-size:20px;text-align:center;" placeholder="建議出價：<?php echo(number_format($filterResult->minPrice * 0.9));?>">
                                TWD
                                <span style="font-size:10px;"><?php echo($this->lang->line('namePriceView_13'));?></span>
                            </p>
                            <div style="margin-top:-20px;margin-bottom:10px;">
                                <span class="label label-info" style="font-size:20px;font-weight:100;">
                                    HitoFun 訂房保証 買貴退差價
                                </span>
                            </div>
                        </div>
                        </div>
                        <div id ="functionButtonDiv" class="row" style="position:fixed;bottom:0px;left:0px;width:100%;z-index:100;padding:0px 0px 10px 0px;margin:0px;background:rgba(0,0,0,0.8);">
                            <div class="col-md-4 col-md-pull-1 col-sm-6 col-xs-12 pull-right" style="text-align:center;margin-top:10px;">
                                <button id="namePriceButton" type="submit" class="btn btn-success btn-block buttonCircle10" style="font-size:30px;">
                                    <?php echo($this->lang->line('namePriceView_14'));?>
                                </button>
                            </div>
                            <div class="col-md-4 col-md-offset-1 col-sm-6 col-xs-12" style="text-align:center;margin-top:10px;">
                                <button type="button" id="backToFilterButton" class="btn btn-danger btn-block buttonCircle10" style="font-size:30px;">
                                    <?php echo($this->lang->line('namePriceView_15'));?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-info" role="alert" style="font-size:16px;">
                            <div style="text-align:center;font-size:20px;font-weight:bold;margin-bottom:10px;">
                                <?php echo($this->lang->line('namePriceView_1'));?>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if(!empty($filterResult->locationInfo->locationCountryName)) {?>
                                        <span style="margin-right:5px;">
                                            <?php if($this->session->userdata('language') == 'zh_tw') {echo($filterResult->locationInfo->locationCountryName);} else {echo($filterResult->locationInfo->locationCountryNameEN);}?>
                                        </span>
                                    <?php }?>
                                    <?php if(!empty($filterResult->locationInfo->locationStateName)) {?>
                                        <span style="margin-right:5px;">
                                            <?php if($this->session->userdata('language') == 'zh_tw') {echo($filterResult->locationInfo->locationStateName);} else {echo($filterResult->locationInfo->locationStateNameEN);}?>
                                        </span>
                                    <?php }?>
                                    <?php if(!empty($filterResult->locationInfo->locationCityName)) {?>
                                        <span style="margin-right:5px;">
                                            <?php if($this->session->userdata('language') == 'zh_tw') {echo($filterResult->locationInfo->locationCityName);} else {echo($filterResult->locationInfo->locationCityNameEN);}?>
                                        </span>
                                    <?php }?>
                                    <?php if(!empty($filterResult->landmark->landmarkName)) {?>
                                        <span style="margin-right:5px;">
                                            <?php if($this->session->userdata('language') == 'zh_tw') {echo($filterResult->landmark->landmarkName);} else {echo($filterResult->landmark->landmarkNameEN);}?>
                                            <?php echo($this->lang->line('namePriceView_20'));?>
                                        </span>
                                    <?php }?>
                                    <br>
                                    <span style="margin-right:5px;">
                                        <?php echo($filterResult->startDate . '&nbsp;' . OBO_CHECK_IN_TIME);?>
                                        &nbsp;~&nbsp;
                                        <?php echo($filterResult->endDate . '&nbsp;' . OBO_CHECK_OUT_TIME);?>
                                    </span>
                                    <br>
                                    <span style="margin-right:5px;">
                                        <?php echo($filterResult->people);?><?php echo($this->lang->line('namePriceView_2'));?>
                                    </span>
                                    <span style="margin-right:5px;">
                                        <?php echo($filterResult->room);?><?php echo($this->lang->line('namePriceView_3'));?>
                                    </span>
                                    <br>
                                    <span style="margin-right:5px;">
                                        <?php echo($this->lang->line('namePriceView_4'));?>
                                    </span>
                                    <span style="margin-right:5px;color:#d9534f;">
                                        $<?php echo(number_format($filterResult->minPrice));?>&nbsp;~&nbsp;
                                        $<?php echo(number_format($filterResult->maxPrice));?>
                                    </span>
                                    <div style="max-height:300px;overflow-x:auto;margin-top:20px;">
                                        <ul id="searchResultUl" class="list-inline">
                                            <?php foreach($filterResult->hotelList as $hotel) {?>
                                                <li id="hotel_<?php echo($hotel->hotelId);?>" class="resultLi">
                                                    <span class="label label-info">
                                                        <?php echo($hotel->hotelName);?>    
                                                    </span>
                                                    <input type="hidden" class="hotelId" value="<?php echo($hotel->hotelId);?>">
                                                </li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="country" value="<?php echo($filterResult->countryId);?>">
                <input type="hidden" name="state" value="<?php echo($filterResult->stateId);?>">
                <input type="hidden" name="city" value="<?php echo($filterResult->cityId);?>">
                <input type="hidden" id="landmark" name="landmark" value="<?php echo($filterResult->landmarkId);?>">
                <input type="hidden" name="startDate" value="<?php echo($filterResult->startDate);?>">
                <input type="hidden" name="endDate" value="<?php echo($filterResult->endDate);?>">
                <input type="hidden" name="people" value="<?php echo($filterResult->people);?>">
                <input type="hidden" name="room" value="<?php echo($filterResult->room);?>">
                <input type="hidden" name="hotelSubType" value="<?php echo($filterResult->hotelSubType);?>">
                <input type="hidden" id="minPrice" name="minPrice" value="<?php echo($filterResult->minPrice);?>">
                <input type="hidden" id="maxPrice" name="maxPrice" value="<?php echo($filterResult->maxPrice);?>">
                <input type="hidden" id="avgPrice" name="avgPrice" value="<?php echo($filterResult->avgPrice);?>">
                <input type="hidden" id="searchRadius" name="searchRadius" value="<?php echo($filterResult->searchRadius);?>">
                <?php if(isset($filterResult->removeHotel)) {?>
                    <?php foreach($filterResult->removeHotel as $hotel) {?>
                        <input type="hidden" name="removeHotel[]" value="<?php echo($hotel);?>">
                    <?php }?>
                <?php }?>
                <?php foreach($filterResult->hotelList as $hotel) {?>
                    <input type="hidden" name="hotelIds[]" value="<?php echo($hotel->hotelId);?>">
                <?php }?>
            </form>
        </div>
    </div>
</header>

<!-- script start -->
<script>
    $(function() {
        //欄位檢查
        $('#namePriceForm').validationEngine({
            autoPositionUpdate: true
        });

        //當按下重新篩選時，將form導至filter
        $('#backToFilterButton').click(function() {
            $('#namePriceForm').prop('action', '<?php echo(base_url() . 'OBO/filter');?>');
            $("#namePriceForm").validationEngine('detach');
            $('#namePriceForm').submit();
        });

        //價格提示bar設定
        $('#tipDiv').fadeIn(500);

        //自動填入喊價金額功能
        $('#namePriceButton').click(function() {
            if(!$('#namePriceInput').val()) {
                $('#namePriceInput').val(<?php echo($filterResult->minPrice * 0.9);?>);
            }
        });

        //價格輸入框動作設定
        $('#namePriceInput').keydown(function(event) {
            if(event.shiftKey) {
                return false;
            }

            if((event.which >= 48 && event.which <= 57) || (event.which >= 96 && event.which <= 105) || event.which == 8 || event.which == 13) {
            } else {
                return false;
            }
        });

        $('#namePriceInput').keyup(function() {
            var tempNum = parseInt($(this).val());
            var avg = parseInt($('#avgPrice').val());
            var min = parseInt($('#minPrice').val());

            //喊價保護值檢查
            if(isNaN(tempNum) || tempNum == 0) {
                $('#tipTextDiv').css({
                    'font-size': '20px',
                    'background-color': '#c4e0ad',
                    'color': '#3c763d'

                }).text('<?php echo($this->lang->line('namePriceView_19'));?>');
                $('#tipArrowDiv').css({
                    'margin-left': '-' + ($('#tipTextDiv').width() / 2) + 'px',
                    'border-bottom-color': '#c4e0ad'
                });
                $('#tipDiv').stop(true).animate({
                    left: '0%'
                }, 1000, 'easeOutCubic');
            } else if(tempNum != '' && tempNum < (avg / 2) && tempNum < (min * 0.7)) {
                $('#tipTextDiv').css({
                    'font-size': '20px',
                    'background-color': '#d9534f',
                    'color': '#fff'

                }).text('<?php echo($this->lang->line('namePriceView_16'));?>');
                $('#tipArrowDiv').css({
                    'margin-left': '-' + ($('#tipTextDiv').width() / 2) + 'px',
                    'border-bottom-color': '#d9534f'
                });
                $('#tipDiv').stop(true).animate({
                    left: '5%'
                }, 1000, 'easeOutCubic');
            } else if(tempNum != '' && tempNum > min) {
                $('#tipArrowDiv').css({
                    'margin-left': '-5px',
                    'border-bottom-color': '#d9534f'
                });
                $('#tipTextDiv').css({
                    'font-size': '20px',
                    'background-color': '#d9534f',
                    'color': '#fff'

                }).text('<?php echo($this->lang->line('namePriceView_17'));?>');
                $('#tipDiv').stop(true).animate({
                    left: '75%'
                }, 1000, 'easeOutCubic');
            } else {
                $('#tipArrowDiv').css({
                    'margin-left': '-5px',
                    'border-bottom-color': '#5cb85c'
                });
                $('#tipTextDiv').css({
                    'font-size': '20px',
                    'background-color': '#5cb85c',
                    'color': '#fff'
                }).text('Good！');
                $('#tipDiv').stop(true).animate({
                    left: '44%'
                }, 1000, 'easeOutCubic');
            }
        });
        $('#namePriceInput').focus(function() {
            if($(this).val() == 0) {
                $(this).val('');
            }
            $('#namePriceInput').keyup();
        });
        $('#namePriceInput').keyup();
        
    });
</script>
<!-- script 