<!--style start -->
<style>
    .requiredInput::before {
        content: '*';
        color: #f00;
    }

    .priceCenterBold{
        text-align:center;font-weight:900;
    }

    .resultLi{
        margin: 8px 0px;
    }

    .resultLi span{
        font-size: 16px;
    }

    .modal-open {
        overflow-y: auto;
        padding-right: 0!important;
    }

    .contractContent{
        height:100px;
        overflow-x:hidden;
        overflow-y:auto;
        font-size:14px;
        margin:10px 10px;
        text-align:left;
        /*padding:10px;*/
    }

    .title{
        margin-bottom: 10px;
        margin-top: 40px;
    }
</style>
<!-- style end -->

<header class="intro">
    <div class="intro-body">
        <div class="container StamentFontLeftTop80">
            <form role="form" id="confirmOrderForm" method="post" action="<?php echo(base_url() . 'OBO/payment');?>" class="form-inline">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-warning form-inline" role="alert">
                            <p class="text-center">
                                <?php echo($this->lang->line('confirmOrderView_6'));?>&nbsp;<?php echo(number_format($orderConfirmInfo->oboPrice));?>&nbsp;TWD
                            </p>
                            <p class="text-center">
                                <?php echo($this->lang->line('confirmOrderView_7'));?>&nbsp;<?php echo(number_format($orderConfirmInfo->room));?>&nbsp;<?php echo($this->lang->line('confirmOrderView_8'));?><?php echo(number_format($orderConfirmInfo->totalDay));?>&nbsp;<?php echo($this->lang->line('confirmOrderView_9'));?>
                            </p>
                            <p class="text-center">
                                <?php echo($this->lang->line('confirmOrderView_10'));?>&nbsp;&nbsp;<?php echo(number_format($orderConfirmInfo->totalPrice));?>&nbsp;&nbsp;TWD
                            </p>
                            <p class="text-center">
                                <?php echo($this->lang->line('confirmOrderView_11'));?>&nbsp;&nbsp;<?php echo(number_format($orderConfirmInfo->tax + $orderConfirmInfo->fees));?>&nbsp;&nbsp;TWD
                            </p>
                            <p class="text-center">
                                <?php echo($this->lang->line('confirmOrderView_12'));?>&nbsp;
                                <span id="grandTotalPriceText" style="color:#d9534f;font-weight:bold;font-size:30px;">&nbsp;<?php echo(number_format($orderConfirmInfo->grandTotalPrice));?>&nbsp;</span>
                                &nbsp;TWD
                            </p>
                            <p class="text-center requiredInput">
                                入住人姓名：
                                <input type="text" class="form-control validate[required]" name="orderCheckInName" value="訪客">
                            </p>
                            <p class="text-center requiredInput">
                                入住人電話：
                                <input type="text" class="form-control validate[required]" name="orderCheckInPhone" value="0987987987">
                            </p>
                        </div>
                        <div class="alert alert-success form-inline" role="alert" style="border-style:solid;margin-bottom:10px;">
                            <div class="contractContent">
                                <div style="text-align:center;font-size:20px;font-weight:bold;margin-bottom:10px;">
                                    <?php echo($this->lang->line('confirmOrderView_13'));?>
                                </div>
                                <ul>
                                    <li>
                                        <?php echo($this->lang->line('confirmOrderView_14'));?>
                                    </li>
                                    <li>
                                       <?php echo($this->lang->line('confirmOrderView_15'));?>
                                    </li>
                                    <li>
                                        <?php echo($this->lang->line('confirmOrderView_16'));?>
                                    </li>
                                    <li>
                                        <?php echo($this->lang->line('confirmOrderView_17'));?>
                                    </li>
                                    <li>
                                        <?php echo($this->lang->line('confirmOrderView_18'));?>
                                    </li>
                                    <li>
                                        <?php echo($this->lang->line('confirmOrderView_19'));?><a href="<?php echo(base_url() .'userPrivacy');?>"><?php echo($this->lang->line('confirmOrderView_20'));?></a><?php echo($this->lang->line('confirmOrderView_21'));?><a href="<?php echo(base_url() .'userTerms');?>"><?php echo($this->lang->line('confirmOrderView_22'));?></a>。
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-left">
                            <label style="cursor:pointer;color:#d9534f;text-align:left;">
                                <input type="checkbox" value="Y" class="validate[required]" id="agreedPolicyCheckBox" name="agreedPolicy">
                                &nbsp;<?php echo($this->lang->line('confirmOrderView_23'));?>
                            </label>
                        </p>
                        <div class="row" style="margin:20px 0px;">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right" style="text-align:center;margin-bottom:10px;">
                                <button id="goToPaymentButton" type="button" class="btn btn-success btn-block buttonCircle10" style="font-size:30px;">
                                    <?php echo($this->lang->line('confirmOrderView_24'));?>
                                </button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12" style="text-align:center;margin-bottom:10px;">
                                <button type="button" id="backToNamePriceButton" class="btn btn-danger btn-block buttonCircle10" style="font-size:30px;">
                                    <?php echo($this->lang->line('confirmOrderView_25'));?>
                                </button>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-info" role="alert" style="min-height:150px;font-size:16px;">
                            <div style="text-align:center;font-size:20px;font-weight:bold;margin-bottom:10px;">
                                <?php echo($this->lang->line('confirmOrderView_1'));?>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if(!empty($orderConfirmInfo->locationInfo->locationCountryName)) {?>
                                        <span style="margin-right:5px;">
                                            <?php if($this->session->userdata('language') == 'zh_tw') {echo($orderConfirmInfo->locationInfo->locationCountryName);} else {echo($orderConfirmInfo->locationInfo->locationCountryNameEN);}?>
                                        </span>
                                    <?php }?>
                                    <?php if(!empty($orderConfirmInfo->locationInfo->locationStateName)) {?>
                                        <span style="margin-right:5px;">
                                            <?php if($this->session->userdata('language') == 'zh_tw') {echo($orderConfirmInfo->locationInfo->locationStateName);} else {echo($orderConfirmInfo->locationInfo->locationStateNameEN);}?>
                                        </span>
                                    <?php }?>
                                    <?php if(!empty($orderConfirmInfo->locationInfo->locationCityName)) {?>
                                        <span style="margin-right:5px;">
                                            <?php if($this->session->userdata('language') == 'zh_tw') {echo($orderConfirmInfo->locationInfo->locationCityName);} else {echo($orderConfirmInfo->locationInfo->locationCityNameEN);}?>
                                        </span>
                                    <?php }?>
                                    <?php if(!empty($orderConfirmInfo->landmark->landmarkName)) {?>
                                        <span style="margin-right:5px;">
                                            <?php if($this->session->userdata('language') == 'zh_tw') {echo($orderConfirmInfo->landmark->landmarkName);} else {echo($orderConfirmInfo->landmark->landmarkNameEN);}?>
                                            <?php echo($this->lang->line('confirmOrderView_31'));?>
                                        </span>
                                    <?php }?>
                                    <br>
                                    <span style="margin-right:5px;">
                                        <?php echo($orderConfirmInfo->startDate . '&nbsp;' . OBO_CHECK_IN_TIME);?>
                                        &nbsp;~&nbsp;
                                        <?php echo($orderConfirmInfo->endDate . '&nbsp;' . OBO_CHECK_OUT_TIME);?>
                                    </span>
                                    <br>
                                    <span style="margin-right:5px;">
                                        <?php echo($orderConfirmInfo->people);?><?php echo($this->lang->line('confirmOrderView_2'));?>
                                    </span>
                                    <span style="margin-right:5px;">
                                        <?php echo($orderConfirmInfo->room);?><?php echo($this->lang->line('confirmOrderView_3'));?>
                                    </span>
                                    <br>
                                    <span style="margin-right:5px;">
                                        <?php echo($this->lang->line('confirmOrderView_4'));?>
                                    </span>
                                    <span style="margin-right:5px;color:#d9534f;">
                                        $<?php echo(number_format($orderConfirmInfo->minPrice));?>&nbsp;~&nbsp;
                                        $<?php echo(number_format($orderConfirmInfo->maxPrice));?>
                                    </span>
                                    <div style="max-height:400px;overflow-x:auto;margin-top:20px;">
                                        <ul id="searchResultUl" class="list-inline">
                                            <?php foreach($orderConfirmInfo->hotelList as $hotel) {?>
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
                <input type="hidden" name="country" value="<?php echo($orderConfirmInfo->countryId);?>">
                <input type="hidden" name="state" value="<?php echo($orderConfirmInfo->stateId);?>">
                <input type="hidden" name="city" value="<?php echo($orderConfirmInfo->cityId);?>">
                <input type="hidden" id="landmark" name="landmark" value="<?php echo($orderConfirmInfo->landmarkId);?>">
                <input type="hidden" name="startDate" value="<?php echo($orderConfirmInfo->startDate);?>">
                <input type="hidden" name="endDate" value="<?php echo($orderConfirmInfo->endDate);?>">
                <input type="hidden" name="people" value="<?php echo($orderConfirmInfo->people);?>">
                <input type="hidden" name="room" value="<?php echo($orderConfirmInfo->room);?>">
                <input type="hidden" name="hotelSubType" value="<?php echo($orderConfirmInfo->hotelSubType);?>">
                <input type="hidden" name="minPrice" value="<?php echo($orderConfirmInfo->minPrice);?>">
                <input type="hidden" name="maxPrice" value="<?php echo($orderConfirmInfo->maxPrice);?>">
                <input type="hidden" name="oboPrice" value="<?php echo($orderConfirmInfo->oboPrice);?>">
                <input type="hidden" name="avgPrice" value="<?php echo($orderConfirmInfo->avgPrice);?>">
                <input type="hidden" id="searchRadius" name="searchRadius" value="<?php echo($orderConfirmInfo->searchRadius);?>">
                <input type="hidden" id="totalPrice" value="<?php echo($orderConfirmInfo->totalPrice);?>">
                <input type="hidden" id="grandTotalPrice" value="<?php echo($orderConfirmInfo->grandTotalPrice);?>">
                <?php if(isset($orderConfirmInfo->removeHotel)) {?>
                    <?php foreach($orderConfirmInfo->removeHotel as $hotel) {?>
                        <input type="hidden" name="removeHotel[]" value="<?php echo($hotel);?>">
                    <?php }?>
                <?php }?>
                <?php foreach($orderConfirmInfo->hotelList as $hotel) {?>
                    <input type="hidden" name="hotelIds[]" value="<?php echo($hotel->hotelId);?>">
                <?php }?>
            </form>
            <div class="modal fade" data-backdrop='static' id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel"><?php echo($this->lang->line('confirmOrderView_26'));?></h4>
                        </div>
                        <div class="modal-body">
                            <input id="emailContent" class="form-control validate[required,custom[email]]" placeholder="Email" value="<?php if($memberEmail !='noemail@hitofun.com') {echo($memberEmail);}?>" style="width:100%;margin-bottom:10px;" <?php if($isValidate == 'Y') {echo('disabled');}?>>
                            <input id="cellphoneContent" class="form-control validate[required,minSize[10],maxSize[10]]" placeholder="cellPhone" value="<?php echo($memberCellphone);?>" style="width:100%;">
                            <label style="font-size:16px;margin:10px 0px;color:#d9534f;">
                                <?php echo($this->lang->line('confirmOrderView_27'));?>
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="sendEmail"><?php echo($this->lang->line('confirmOrderView_28'));?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="promotionCodeModal" tabindex="-1" role="dialog" aria-labelledby="promotionCodeModalLabel" data-keyboard="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="promotionCodeModalLabel">請輸入折扣碼</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <input type="text" id="promotionCode" class="form-control" placeholder="折扣碼" value="<?php echo($promotionCode);?>" style="font-size:30px;text-align:center;height:48px">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="button" class="btn btn-success btn-lg btn-block" id="sendpromotionCodeButton"><?php echo($this->lang->line('confirmOrderView_28'));?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="overlayDiv" style="display:none;">
        <div>
            <i class="fa fa-smile-o fa-spin fa-5x fa-fw"></i>
            <br>
            檢查中...
        </div>
    </div>
</header>

<!-- script start -->

    
<script>
    
    $(function() {
        //欄位檢查
        $('#confirmOrderForm').validationEngine({
            autoPositionUpdate: true
        });

        //設定overlay div
        $('#overlayDiv').css({
            'position': 'fixed',
            'z-index': 9999,
            'top': '0px',
            'left': '0px',
            'width': $(window).width(),
            'height': $(window).height(),
            'background': 'rgba(0, 0, 0, 0.5)',
            'padding-top': ($(window).height() / 2) - 50,
            'text-align': 'center',
            'color': '#fff'
        });

        //當按下重新篩選時，將form導至filter
        $('#backToNamePriceButton').click(function() {
            $('#confirmOrderForm').prop('action', '<?php echo(base_url() . 'OBO/namePrice');?>');
            $("#confirmOrderForm").validationEngine('detach');
            $('#confirmOrderForm').submit();
        });

        //檢查勾選同意checkbox是否正常
        $('#goToPaymentButton').click(function() {
            if($('#agreedPolicyCheckBox').is(':checkbox') && $('#agreedPolicyCheckBox').is(':visible') && $('#agreedPolicyCheckBox').is(':checked')) {
                $(this).prop('disabled', true);
                $('#confirmOrderForm').submit();
            } else {
                $('#confirmOrderForm').validationEngine('validate');
            }
        });
    });

    //加千分位
    function formatNumber(num) {
        var pattern = /(-?\d+)(\d{3})/;
        num = num.toString().replace(/,/g,'');

        while(pattern.test(num)) {
            num = num.replace(pattern, "$1,$2");
        }

        return num;
    }
</script>
<!-- script 