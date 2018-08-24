<!-- style start -->
<link rel="stylesheet" href="<?php echo(base_url() . 'third_party/dateRangePicker/daterangepicker.css');?>">
<link rel="stylesheet" href="<?php echo(base_url() . 'third_party/animate/animate.css');?>">

<style>
    /* tooltip style */
    .tooltip-inner {
        font-size: 18px;
    }

    /* 選項radio style */
    .disabledOption > label {
        color: #ddd;
    }

    .resultLi {
        margin: 5px -2px;
    }

    .resultLi span{
        font-size: 16px;
    }

    .ui-slider span {
        outline: none;
    }

    /* 日期輸入框style */
    .dateInput {
        cursor: pointer;
    }
    @media (min-width: 768px) {
        .dateInput {
            width: 110px !important;
        }
    }

    .searchCheckBoxStyle{
        border-bottom-style:ridge;
        border-top-style:ridge;
        padding:5px;
        color:black;
        text-align:left;
        font-size:20px;
        line-height: 25px;
        letter-spacing: 1px;
    }

    .searchCheckBoxFontStyle p{
        margin-bottom: 10px;
        font-size:16px;
    }

    .searchThemFront{
        font-size:25px;
    }

    .searchPFront{
        font-size:18px;
    }

    .searchButton{
        margin:5px;
    }

    .searchAVG{
        text-align:center;
        border-top:ridge;
        padding:10px;
    }
    /*rating start css*/
    .rating > fieldset, .rating > label { margin: 0; padding: 0; }
    .rating > h1 { font-size: 1.5em; margin: 10px; }

    /****** Style Star Rating Widget *****/

    .rating { 
        border: none;
        float: left;
    }

    .rating > input {
        display: none;
    } 
    .rating > label:before { 
        margin: 5px;
        font-size: 1.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
    }

    .rating > .half:before { 
        content: "\f089";
        position: absolute;
    }

    .rating > label { 
        color: #ddd; 
        float: right;
        cursor: pointer;
    }

    /***** CSS Magic to Highlight Stars on Hover *****/

    .rating > input:checked ~ label, /* show gold star when clicked */
    .rating:not(:checked) > label:hover, /* hover current star */
    .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

    .rating > input:checked + label:hover, /* hover current star when changing rating */
    .rating > input:checked ~ label:hover,
    .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
    .rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 

</style>
<!-- style end -->

<header class="intro">
    <div class="intro-body">
        <div class="container StamentFontLeftTop80">
            <!-- search condition star -->
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        <nav class="navbar navbar-default" style="background-color:rgba(0,0,0,0);border-color:rgba(0,0,0,0);margin-bottom:0px;">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <a role="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#searchDiv" aria-expanded="false" style="background:#337ab7;color:#fff;cursor:pointer;">
                                        <i class="fa fa-search fa-fw"></i>
                                    </a>
                                </div>
                                <div class="collapse navbar-collapse" id="searchDiv">
                                    <form id="searchForm" class="navbar-form navbar-left" method="post" action="">
                                        <div class="form-group">
                                            <label><i class="fa fa-paper-plane fa-fw"></i></label>
                                            <label class="visible-xs" style="text-align:center;"><i class="fa fa-arrow-down fa-fw"></i></label>
                                            <select class="form-control" id="citySelect" name="city" <?php if(count($locationCity) == 0) {echo('disabled');}?> data-toggle="tooltip" data-placement="top" title="<?php echo($this->lang->line('filterView_4'));?>">
                                                <option value="0"><?php echo($this->lang->line('filterView_1'));?></option>
                                                    <?php foreach ($locationCity as $row) {?>
                                                        <option value="<?php echo($row->locationCityId);?>" <?php if($row->locationCityId == $searchResult->cityId) {echo('selected');}?>>
                                                            <?php if($this->session->userdata('language') == 'zh_tw') {echo($row->locationCityName);} else {echo($row->locationCityNameEN);}?>
                                                        </option>
                                                    <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="hidden-xs"><i class="fa fa-arrow-right fa-fw"></i></label>
                                            <label class="visible-xs" style="text-align:center;"><i class="fa fa-arrow-down fa-fw"></i></label>
                                            <select class="form-control searchChange" id="landmarkSelect" name="landmark" <?php if(count($landmarkList) == 0) {echo('disabled');}?> data-toggle="tooltip" data-placement="top" title="<?php echo($this->lang->line('filterView_5'));?>">
                                                <option value="0"><?php echo($this->lang->line('filterView_1'));?></option>
                                                    <?php foreach ($landmarkList as $row) {?>
                                                        <option value="<?php echo($row->landmarkId);?>" <?php if($row->landmarkId == $searchResult->landmarkId) {echo('selected');}?>>
                                                            <?php if($this->session->userdata('language') == 'zh_tw') {echo($row->landmarkName);} else {echo($row->landmarkNameEN);}?>
                                                        </option>
                                                    <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group hidden-xs">
                                            <label style="margin-left:20px;"></label>
                                        </div>
                                        <div class="form-group">
                                            <label><i class="fa fa-calendar fa-fw"></i></label>
                                            <input type="text" class="form-control dateInput" id="startDate" name="startDate" placeholder="<?php echo($this->lang->line('filterView_6'));?>" value="<?php echo($searchResult->startDate);?>" data-toggle="tooltip" data-placement="top" title="<?php echo($this->lang->line('filterView_6'));?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control dateInput" id="endDate" name="endDate"  placeholder="<?php echo($this->lang->line('filterView_7'));?>" value="<?php echo($searchResult->endDate);?>" data-toggle="tooltip" data-placement="top" title="<?php echo($this->lang->line('filterView_7'));?>">
                                        </div>
                                        <div class="form-group hidden-xs">
                                            <label style="margin-left:20px;"></label>
                                        </div>
                                        <div class="form-group">
                                            <label><i class="fa fa-male fa-fw"></i></label>
                                            <select name="people" id="people" class="form-control" data-toggle="tooltip" data-placement="top" title="<?php echo($this->lang->line('filterView_8'));?>">
                                                <?php for($i = 1;$i <= 8;$i++) {?>
                                                    <option value="<?php echo($i);?>" <?php if($i == $searchResult->people) {echo('selected');}?>><?php echo($i);?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group hidden-xs">
                                            <label style="margin-left:20px;"></label>
                                        </div>
                                        <div class="form-group">
                                            <label><i class="fa fa-building fa-fw"></i></label>
                                            <select name="room" id="room" class="form-control" data-toggle="tooltip" data-placement="top" title="<?php echo($this->lang->line('filterView_9'));?>">
                                                <?php for($i = 1;$i <= 8;$i++) {?>
                                                    <option value="<?php echo($i);?>" <?php if($i == $searchResult->room) {echo('selected');}?>><?php echo($i);?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="country" value="1">
                                        <input type="hidden" name="state" value="0">
                                    </form>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- search condition end -->
            <?php if(isset($searchResult->hotelListTemp)) {?>
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center" style="color:#c3121e;"><?php echo($this->lang->line('filterView_10'));?></h1>
                    </div>
                </div>
            <?php } else {?>
                <div class="row">
                    <!-- advance condition star -->
                    <div class="col-md-4">
                        <!-- filter bar star -->
                        <div class="alert alert-info text-center" role="alert" style="font-weight:bold;font-size:18px;">
                            <span style="font-size:20px;color:#d9534f;"><?php echo($this->lang->line('filterView_14'));?></span>
                            <div class="row" style="margin-top:30px;">
                                <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
                                    <div style="display:none;">
                                        <?php echo($this->lang->line('filterView_15'));?>
                                        <br>
                                        <span id="avgOboPrice"><?php echo(number_format($searchResult->avgOboPrice));?></span><?php echo($this->lang->line('filterView_16'));?>
                                    </div>
                                    <div>
                                        <span id="minPrice" style="font-size:24px;"></span>
                                        <span style="font-size:24px;">&nbsp;-&nbsp;</span>
                                        <span id="maxPrice" style="font-size:24px;"></span>
                                    </div>
                                    <div id="slider-range" class="ui-slider-handle ui-state-default ui-corner-all" style="margin:20px 5px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
                                    <form role="form" id="namePriceForm" method="post" action="<?php echo(base_url() . 'OBO/namePrice');?>" class="form-inline">
                                        <input type="hidden" name="country" value="<?php echo($searchResult->countryId);?>">
                                        <input type="hidden" name="state" value="<?php echo($searchResult->stateId);?>">
                                        <input type="hidden" name="city" value="<?php echo($searchResult->cityId);?>">
                                        <input type="hidden" id="landmark" name="landmark" value="<?php echo($searchResult->landmarkId);?>">
                                        <input type="hidden" id="searchStartDate" name="startDate" value="<?php echo($searchResult->startDate);?>">
                                        <input type="hidden" id="searchEndDate" name="endDate" value="<?php echo($searchResult->endDate);?>">
                                        <input type="hidden" id="searchPeople" name="people" value="<?php echo($searchResult->people);?>">
                                        <input type="hidden" id="searchRoom" name="room" value="<?php echo($searchResult->room);?>">
                                        <input type="hidden" id="searchRadius" name="searchRadius" value="<?php echo($searchResult->searchRadius);?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- filter bar end -->
                        <!-- <span style="font-size:22px;color:#555;"><?php echo($this->lang->line('filterView_11'));?></span> -->
                        <div class="alert alert-info" role="alert">
                            <div>
                                <span style="font-size:18px;"><?php echo('搜尋範圍');?></span>
                                <div>
                                    <div class="btn-group pull-left" role="group" style="margin-right:10px;">
                                        <button type="button" id="resetRadius" class="btn btn-info searchOption" value="<?php echo($searchResult->searchRadius);?>"><i class="fa fa-repeat"></i></button>
                                    </div>
                                    <div class="pull-left" style="margin-top:-3px;width:80px;text-align:right;">
                                        <span id="searchRadiusText" style="font-size:30px;font-weight:bold;"><?php echo($searchResult->searchRadius / 1000);?></span><span style="font-size:14px;">KM</span>
                                    </div>
                                    <div class="btn-group" role="group" style="margin-left:10px;">
                                        <button type="button" id="reduceRadius" class="btn btn-info searchOption" <?php if($searchResult->searchRadius <= SEARCH_RADIUS){echo('disabled');}?>><i class="fa fa-minus"></i></button>
                                        <button type="button" id="addRadius" class="btn btn-info searchOption" <?php if($searchResult->searchRadius >= MAX_SEARCH_RADIUS || count($searchResult->hotelList) >= MAX_OBO_SEARCH_SIZE){echo('disabled');}?>><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:20px;">
                                <span style="font-size:18px;"><?php echo($this->lang->line('filterView_12'));?></span>
                                <ul class="list-inline">
                                    <li>
                                        <div class="radio" style="margin-top:5px;">
                                            <label style="padding-left:0px;">
                                                <input type="radio" class="hotelTypeRadio searchOption" name="optionsRadios" value="0" <?php if(0 == $searchResult->filterOptions->nowOption) {echo('checked');}?> style="display:none;">
                                                <span class="label label-<?php if(0 == $searchResult->filterOptions->nowOption) {echo('primary');} else {echo('info');}?>" style="font-size:16px;">
                                                    <?php echo($this->lang->line('filterView_13'));?>
                                                </span>
                                            </label>
                                        </div>
                                    </li>
                                    <?php foreach($searchResult->filterOptions->options as $options) {?>
                                        <li>
                                            <div class="radio <?php if($options->size == 0) {echo('disabledOption');}?>" style="font-size:16px;margin-top:5px;">
                                                <label style="padding-left:0px;">
                                                    <input type="radio" name="optionsRadios" class="hotelTypeRadio searchOption" value="<?php echo($options->id);?>" <?php if($options->id == $searchResult->filterOptions->nowOption) {echo('checked');}?> <?php if($options->size == 0) {echo('disabled');}?> style="display:none;">
                                                    <span class="label label-<?php if($options->size == 0) {echo('default');} elseif($options->id == $searchResult->filterOptions->nowOption) {echo('primary');} else {echo('info');}?>" style="font-size:16px;">
                                                        <?php echo($options->name);?>
                                                        <!-- <span class="badge typeCount" style="font-family:Microsoft JhengHei;background-color:rgba(255, 255, 255, 0);"><?php echo($options->size);?></span> -->
                                                    </span>
                                                    
                                                </label>
                                                <?php if($options->id == 1) {?>
                                                    <div id="hotelGradeDiv" style="font-size:16px:5px;float:right;margin-top:-7px;<?php if($searchResult->filterOptions->nowOption != 1) {echo('display:none;');}?>">
                                                        <fieldset class="rating">
                                                            <?php for($i = 5;$i >= 1;$i--) {?>
                                                                <input type="radio" id="star<?php echo($i);?>" class="hotelGradeRadio searchOption" name="hotelGrade" value="<?php echo($i);?>" <?php if($searchResult->filterGrade == $i) {echo('checked');}?>><label class="full" for="star<?php echo($i);?>"></label>
                                                            <?php }?>
                                                        </fieldset>
                                                    </div>
                                                <?php }?>
                                            </div>
                                        </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- advance condition end -->
                    <div class="col-md-8">
                        <div class="alert alert-info" role="alert" style="font-size:20px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if(isset($searchResult->hotelListTemp)) {?>
                                        <h1 class="text-center" style="color:#c3121e;"><?php echo($this->lang->line('filterView_18'));?></h1>
                                    <?php } else {?>
                                        <span id="hotelCount" style="color:#d9534f;font-size:30px;"><?php echo(count($searchResult->hotelList));?></span>&nbsp;<?php echo($this->lang->line('filterView_19'));?>
                                    <?php }?>
                                </div>
                                <!-- hotel list star -->
                                <div class="col-md-6">
                                    <?php if(isset($searchResult->hotelListTemp)) {?>
                                    <?php } else {?>
                                        <div id="scrollDownTipDiv" style="position:absolute;bottom:-20px;right:20px;z-index:10000;">
                                            <h3 class="animated infinite tada" style="animation-duration:1s;"><i class="fa fa-hand-o-down fa-fw"></i>下面還有喔</h3>
                                        </div>
                                        <div id="filterResultDiv" style="max-height:400px;overflow-x:auto;margin-bottom:10px;">
                                            <ul id="searchResultUl" class="list-inline">
                                                <?php foreach($searchResult->hotelList as $hotel) {?>
                                                    <li id="hotel_<?php echo($hotel->hotelId);?>" class="resultLi" style="cursor:pointer;">
                                                        <span class="label label-info">
                                                            <?php echo($hotel->hotelName);?>
                                                        </span>
                                                        <input type="hidden" class="hotelReferanceOBO" value="<?php echo($hotel->hotelReferanceOBO);?>">
                                                        <input type="hidden" class="hotelUrl" value="<?php echo($hotel->hotelUrl);?>">
                                                        <input type="hidden" class="hotelLat" value="<?php echo($hotel->hotelLat);?>">
                                                        <input type="hidden" class="hotelLng" value="<?php echo($hotel->hotelLng);?>">
                                                        <input type="hidden" class="hotelId" value="<?php echo($hotel->hotelId);?>">
                                                    </li>
                                                <?php }?>
                                            </ul>
                                            <div id="loadingImgDiv" style="position:absolute;top:50px;display:none;">
                                                <div class="row">
                                                    <div class="col-xs-2 col-xs-offset-5 col-md-4 col-md-offset-4">
                                                        <img class="img-responsive" src="<?php echo(base_url() . '/images/loading.gif');?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                </div>
                                <!-- gogle map star -->
                                <div id="mapAnchor" class="col-md-6">
                                    <div id="map" style="margin:0px;">
                                    </div>
                                </div>
                                <!-- gogle map end -->
                                <!-- hotel list end -->
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <button id="namePriceButton" class="btn btn-block btn-success buttonCircle10 btn-lg center-block" style="margin-top:10px;"><?php echo($this->lang->line('filterView_17'));?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" data-keyboard="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12" style="font-size:20px;">
                                        <?php echo(sprintf($this->lang->line('filterView_24'), '<span id="confirmModalHotelCount" style="color:#d9534f;"></span>'));?>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-8" style="margin-top:10px;">
                                        <img class="img-responsive" src="<?php echo(base_url() . 'images/filterTip.gif'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-sm-offset-1 col-sm-4 col-xs-6">
                                        <button type="button" class="btn btn-danger btn-lg btn-block" id="canConfirmModalButton"><?php echo($this->lang->line('filterView_23'));?></button>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-4 col-xs-6">
                                        <button type="button" class="btn btn-success btn-lg btn-block" id="sendNamePriceFormButton"><?php echo($this->lang->line('filterView_22'));?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</header>
<!-- script start -->
<script type="text/javascript" src="<?php echo(base_url() . 'third_party/dateRangePicker/daterangepicker.js');?>"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script>
    var hotelListJson = <?php echo(json_encode($searchResult));?>;
    var minOboSize = <?php echo(MIN_OBO_SIZE);?>;
    var searchRadius = <?php echo(SEARCH_RADIUS);?>;
    var maxSearchRadius = <?php echo(MAX_SEARCH_RADIUS);?>;
    var maxOboSearchSize = <?php echo(MAX_OBO_SEARCH_SIZE);?>;
    var searchRadiusExpand= <?php echo(SEARCH_RADIUS_EXPAND);?>;
    var language = '<?php echo($this->session->userdata('language'));?>';

    var map;
    var bounds;
    var markers = [];
    var infowindow;
    var nowHotelTypeRadio = $('.hotelTypeRadio:checked');

    $(function() {
        //tooltip設定
        $('[data-toggle="tooltip"]').tooltip();

        //loading圖片設定
        $('#loadingImgDiv').width($('#filterResultDiv').width());
        $(window).resize(function() {
            $('#loadingImgDiv').width($('#filterResultDiv').width());
        });

        //旅館列表下拉提示設定
        setScrollDownTipDiv();

        //搜尋form改變條件自動送出
        $('.searchChange').change(function() {
            if($(this).is('#landmarkSelect') && $(this).val() == 0){
                return false;
            }
            $('#searchForm').submit();
        });

        $('#room').change(function() {
            $('#searchRoom').val($(this).val());
        });

        $('#people').change(function() {
            $('#searchPeople').val($(this).val());
        });

        //filterResultDiv滾動時將提示藏
        $('#filterResultDiv').scroll(function() {
            $('.resultLi span').find('a').remove();
            $('#scrollDownTipDiv').fadeOut(800,function() {
                $('#scrollDownTipDiv').remove();
            });
        });

        //喊價按鈕動作
        $('#namePriceButton').click(function() {
            $('#confirmModal').modal('show');
        });

        $('#confirmModal').on('show.bs.modal', function (e) {
            $('#confirmModalHotelCount').text($('#hotelCount').text());
        });

        $('#canConfirmModalButton').click(function() {
            $('#confirmModal').modal('hide');
        });
        
        $('#sendNamePriceFormButton').click(function() {
            $('#namePriceForm').submit();
        });

        //喊價form送出設定
        $('#namePriceForm').submit(function() {
            $('.resultLi:visible').not('#resultNoShowLi').each(function() {
                $('#namePriceForm').append('<input type="hidden" name="hotelIds[]" value="' + $(this).find('.hotelId').val() + '">');
            });
            $('#namePriceForm').append('<input type="hidden" name="minPrice" value="' + $('#slider-range').slider('values', 0) + '">');
            $('#namePriceForm').append('<input type="hidden" name="maxPrice" value="' + $('#slider-range').slider('values', 1) + '">');
            $('#namePriceForm').append('<input type="hidden" name="avgPrice" value="' + $('#avgOboPrice').text().replace(/,/g,'') + '">');
            $('#namePriceForm').append('<input type="hidden" name="hotelSubType" value="' + $('.hotelTypeRadio:checked').val() + '">');

            return true;
        });

        //價格篩選slide bar動作
        var minValue = Math.floor(<?php echo($searchResult->minOboPrice);?> / 100) * 100;
        var maxValue = Math.ceil(<?php echo($searchResult->maxOboPrice);?> / 100) * 100;
        $('#slider-range').slider({
            range: true,
            min: minValue,
            max: maxValue,
            values: [minValue, minValue],
            animate: 'slow',
            step: 100,
            //slider bar 產生時將range調到最大，並顯示價格
            create: function(event, ui) {
                $('#slider-range').slider('values', [minValue, maxValue]);
                $('#slider-range').slider('widget').find('span').css({
                    width: '30px',
                    height: '30px',
                    top: '-10px'
                });
                $('#slider-range').slider('widget').find('span').css('cursor', 'pointer');
                $('#slider-range').slider('widget').find('span').first().html('<i class="fa fa-angle-double-right fa-fw"></i>');
                $('#minPrice').text(formatNumber($('#slider-range').slider('values', 0)));
                $('#maxPrice').text(formatNumber($('#slider-range').slider('values', 1)));
                // $('#slider-range').slider('widget').find('span').first().append('<div id="minPrice">' + '$' +  formatNumber($('#slider-range').slider('values', 0)) + '</div>');
                $('#slider-range').slider('widget').find('span').last().html('<i class="fa fa-angle-double-left fa-fw"></i>');
                // $('#slider-range').slider('widget').find('span').last().append('<div id="maxPrice" style="margin-left:-30px;margin-top:-55px;">' + '$' +  formatNumber($('#slider-range').slider('values', 1)) + '</div>');
            },
            //slider bar 滑動時，顯示range內的旅館，並隱藏range外的旅館，並計算平均值
            slide: function(event, ui) {
                var sumOboPrice = 0;
                $('#slider-range').slider('option', 'step', 100);
                $('.hotelReferanceOBO').each(function() {
                    if($(this).val() >= ui.values[0] && $(this).val() <= ui.values[1]) {
                        $(this).closest('li').show();
                        for (var i = 0; i < markers.length; i++) {
                            if(markers[i].id == $(this).siblings('.hotelId').val() && markers[i].marker.getMap() == null) {
                                markers[i].marker.setMap(map);
                                break;
                            }
                        }
                        sumOboPrice += parseInt($(this).val());
                    } else {
                        $(this).closest('li').hide();
                        for (var i = 0; i < markers.length; i++) {
                            if(markers[i].id == $(this).siblings('.hotelId').val()) {
                                markers[i].marker.setMap(null);
                                break;
                            }
                        }
                    }
                });

                //將移除的旅館家數歸零
                $('.removeHotel').remove();

                //若顯示的旅館間數少於四家，則隱藏
                if($('.resultLi:visible').not('#resultNoShowLi').length < minOboSize) {
                    $('#resultNoShowLi').remove();
                    $('.resultLi').hide();
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].marker.setMap(null);
                    }
                    $('#searchResultUl').append('<li id="resultNoShowLi" class="resultLi"></li>');
                    $('#searchResultUl li:last').append('<span class="label label-danger"><?php echo($this->lang->line('filterView_20') . MIN_OBO_SIZE . $this->lang->line('filterView_21'));?></span>');
                    sumOboPrice = 0;
                    $('#namePriceButton').prop('disabled', true);
                    $('#hotelCount').text('0');
                } else {
                    $('#resultNoShowLi').remove();
                    $('#namePriceButton').prop('disabled', false);
                    $('#hotelCount').text($('.resultLi:visible').not('#resultNoShowLi').length);
                }

                $('#minPrice').text('$' + formatNumber(ui.values[0]));
                $('#maxPrice').text('$' + formatNumber(ui.values[1]));
                if(sumOboPrice == 0) {
                    $('#avgOboPrice').text('0');
                } else {
                    $('#avgOboPrice').text(formatNumber(Math.round(sumOboPrice / $('.resultLi:visible').length)));
                }
                //設定旅館列表下拉提示
                setScrollDownTipDiv();
            },
            stop: function(event, ui) {
                //將地圖大小調整至可看到所有marker
                bounds = new google.maps.LatLngBounds();

                for (var i = 0; i < markers.length; i++) {
                    if(markers[i].marker.getMap() != null) {
                        bounds.extend(markers[i].marker.getPosition());
                    }
                }

                if(!bounds.isEmpty()) {
                    map.fitBounds(bounds);
                }
            } 
        });

        //篩選條件radio動作
        $('.hotelTypeRadio').click(function() {
            //search的網址字串 //startDate和endDate
            $searchUrlStr = 'NULL/' + $('#startDate').val().replace(/\//g,'-') + '/' + $('#endDate').val().replace(/\//g,'-');
            //當觸發click時，將所有搜尋相關選項的radio button設成disabled
            $('.searchOption').prop('disabled', true);
            $('.hotelTypeRadio').siblings('.label-primary').removeClass('label-primary').addClass('label-info');
            $(this).siblings('.label-info').removeClass('label-info').addClass('label-primary');

            nowHotelTypeRadio = $(this);
            //若目前點選的是星級旅館，則顯示星級選項
            if(nowHotelTypeRadio.val() == 1 && !$('#hotelGradeDiv').is(':visible')) {
                $('#hotelGradeDiv').fadeIn();
                $('.searchOption').not('.disabledOption input:radio').prop('disabled', false);
            } else {
            //若是其他類型(包含星級旅館底下的星級)
                //將下一步按鈕disabled
                $('#namePriceButton').prop('disabled', true);

                //若目前選項不是星級旅館，則隱藏星級選單
                if($('.hotelTypeRadio:checked').val() != 1) {
                    $('#hotelGradeDiv').fadeOut(300, function() {
                        $('.hotelGradeRadio').prop('checked', false);
                    });
                }

                //將slider bar 調整成default狀態
                $('#slider-range').slider('option', 'step', 1);
                $('#slider-range').slider('option', 'min', 0);
                $('#slider-range').slider('option', 'max', 1);
                $('#slider-range').slider('values', [0, 0]);
                $('#minPrice').text('$0');
                $('#maxPrice').text('$0');
                $('#avgOboPrice').text('$0');
                $('#hotelCount').text('0');

                //移除現有的搜尋結果
                var fadeOutTime = 5;

                //清空marker物件
                for (var i = 0; i < markers.length; i++) {
                    markers[i].marker.setMap(null);
                }
                markers = [];

                $($('.resultLi').get().reverse()).each(function() {
                    var nowElement = $(this);

                    setTimeout(function() {
                        nowElement.fadeOut(300, function() {
                            $(this).remove();
                            if($('.resultLi').length == 0) {
                                $('#scrollDownTipDiv').fadeOut(200);
                                $('#loadingImgDiv').fadeIn(300, function() {
                                    //ajax取得搜尋結果
                                    var hotelGrade = 0;
                                    if($('.hotelGradeRadio:checked').length > 0) {
                                        hotelGrade = $('.hotelGradeRadio:checked').val();
                                    }
                                    $.ajax({
                                        url: '<?php echo(base_url() . 'OBO/search/');?>' + $searchUrlStr,
                                        method: 'POST',
                                        data: {
                                            'hotelSubType': nowHotelTypeRadio.val(),
                                            'hotelGrade': hotelGrade,
                                            'searchRadius': $('#searchRadius').val(),
                                            'landmark': $('#landmark').val()
                                        },
                                        dataType: 'json',
                                        success: function(result) {
                                            //若搜尋結果為0
                                            if(result.noResult == 'Y') {
                                                $('#loadingImgDiv').fadeOut(200, function() {
                                                    //調整slider bar 狀態，並顯示沒有搜尋結果
                                                    $('#slider-range').slider('option', 'min', 0);
                                                    $('#slider-range').slider('option', 'max', 0);
                                                    $('#slider-range').slider('values', [0, 0]);
                                                    $('#minPrice').text('$0');
                                                    $('#maxPrice').text('$0');
                                                    $('#avgOboPrice').text('$0');

                                                    $('#searchResultUl').append('<li class="resultLi" style="display:none;"></li>');
                                                    $('#searchResultUl li:last').append('<span class="label label-danger"><?php echo($this->lang->line('filterView_20') . MIN_OBO_SIZE . $this->lang->line('filterView_21'));?></span>');
                                                    $('.resultLi').fadeIn(500);

                                                    $('#namePriceButton').prop('disabled', true);
                                                    $('.searchOption').not('.disabledOption input:radio').prop('disabled', false);
                                                    $('#hotelCount').text('0');

                                                    //停用減少搜尋範圍按鈕
                                                    $('#reduceRadius').prop('disabled', true);
                                                });
                                            } else {
                                            //若搜尋結果不為0
                                                $('#loadingImgDiv').fadeOut(200, function() {
                                                    //將搜尋結果顯示，並調整slider bar 狀態，以及計算平均值
                                                    hotelListJson = result;
                                                    minValue = Math.floor(parseInt(result.minOboPrice) / 100) * 100;
                                                    maxValue = Math.ceil(parseInt(result.maxOboPrice) / 100) * 100
                                                    $('#slider-range').slider('option', 'min', minValue);
                                                    $('#slider-range').slider('option', 'max', maxValue);
                                                    $('#slider-range').slider('values', [minValue, maxValue]);
                                                    $('#minPrice').text('$' + formatNumber(parseInt(minValue)));
                                                    $('#maxPrice').text('$' + formatNumber(parseInt(maxValue)));
                                                    $('#avgOboPrice').text('$' + formatNumber(result.avgOboPrice));
                                                    $('#hotelCount').text(result.hotelList.length);

                                                    for(var i = 0;i < result.hotelList.length;i++) {
                                                        $('#searchResultUl').append('<li id="hotel_' + result.hotelList[i].hotelId + '" class="resultLi" style="display:none;cursor:pointer;"></li>');
                                                        $('#searchResultUl li:last').append('<span class="label label-info">' + result.hotelList[i].hotelName + '</span>');
                                                        $('#searchResultUl li:last').append('<input type="hidden" class="hotelReferanceOBO" value="' + result.hotelList[i].hotelReferanceOBO + '">');
                                                        $('#searchResultUl li:last').append('<input type="hidden" class="hotelLat" value="' + result.hotelList[i].hotelLat + '">');
                                                        $('#searchResultUl li:last').append('<input type="hidden" class="hotelLng" value="' + result.hotelList[i].hotelLng + '">');
                                                        $('#searchResultUl li:last').append('<input type="hidden" class="hotelId" value="' + result.hotelList[i].hotelId + '">');
                                                        $('#searchResultUl li:last').append('<input type="hidden" class="hotelUrl" value="' + result.hotelList[i].hotelUrl + '">');
                                                        
                                                    }

                                                    var fadeInTime = 5;
                                                    $('.resultLi').each(function() {
                                                        var nowElement = $(this);
                                                        setTimeout(function() {
                                                            nowElement.fadeIn(500);
                                                        }, fadeInTime);
                                                        fadeInTime += 2;
                                                    });

                                                    setTimeout(function() {
                                                        $('.searchOption').not('.disabledOption input:radio').prop('disabled', false);
                                                        if(parseInt($('#searchRadius').val()) <= searchRadius) {
                                                            $('#reduceRadius').prop('disabled', true);
                                                        }
                                                        if(parseInt($('#searchRadius').val()) >= maxSearchRadius || result.hotelList.length >= maxOboSearchSize) {
                                                            $('#addRadius').prop('disabled', true);
                                                        }
                                                    }, fadeInTime);

                                                    //重新設定marker
                                                    setGoogleMapMarker();

                                                    $('#namePriceButton').prop('disabled', false);
                                                });
                                            }
                                        }
                                    });
                                });
                            }
                        });
                    }, fadeOutTime);

                    fadeOutTime += 5;
                });
            }
        });

        $('.hotelGradeRadio').click(function() {
            $('.hotelTypeRadio:checked').click();
        });

        //搜尋範圍增減按鈕動作
        $('#reduceRadius').click(function() {
            $('#searchRadius').val(parseInt($('#searchRadius').val()) - parseInt(searchRadiusExpand));
            $('#searchRadiusText').text($('#searchRadius').val() / 1000);
            nowHotelTypeRadio.click();
        });
        $('#addRadius').click(function() {
            $('#searchRadius').val(parseInt($('#searchRadius').val()) + parseInt(searchRadiusExpand));
            $('#searchRadiusText').text($('#searchRadius').val() / 1000);
            nowHotelTypeRadio.click();
        });
        $('#resetRadius').click(function() {
            $('#searchRadius').val(parseInt($(this).val()));
            $('#searchRadiusText').text($(this).val() / 1000);
            nowHotelTypeRadio.click();
        });

        //城市下拉選單動作
        $('#citySelect').change(function() {
            $('#landmarkSelect option:gt(0)').remove();
            $('#landmarkSelect').prop('disabled', true);
            $('#landmarkSelect').siblings('label').css('color', '#aaa');
            $.ajax({
                method: 'POST',
                url: '<?php echo(base_url() . 'OBO/getLandmark');?>',
                data: {
                    'countryId': 1,
                    'stateId': 0,
                    'cityId': $('#citySelect').val()
                },
                dataType: 'json',
                success: function(response) {
                    if(response.length > 0) {
                        for(var i = 0;i < response.length;i++) {
                            if(language == 'zh_tw') {
                                $('#landmarkSelect').append('<option value="' + response[i].landmarkId + '">' + response[i].landmarkName + '</option>');
                            } else {
                                $('#landmarkSelect').append('<option value="' + response[i].landmarkId + '">' + response[i].landmarkNameEN + '</option>');
                            }
                        }
                        $('#landmarkSelect').prop('disabled', false);
                        $('#landmarkSelect, #citySelect').siblings('label').css('color', '#31708f');
                    } else {
                        $('#landmarkSelect').prop('disabled', true);
                        $('#landmarkSelect').siblings('label').css('color', '#aaa');
                    }
                }
            });
        });

        $('#startDate, #endDate').keydown(function() {
            return false;
        });

        $('#startDate').datepicker({
            dateFormat: 'yy/mm/dd',
            minDate: new Date(),
            onSelect: function() {
                if($(this).val() > $('#endDate').val()) {
                    $('#startDate').change();
                }
                $('#searchForm').submit();
            }
        });

        $('#endDate').datepicker({
            dateFormat: 'yy/mm/dd',
            onSelect: function() {
                $('#searchForm').submit();
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
        $('#startDate').change();
    });

    //Google Map API
    function initMap() {
        var myLatlng = new google.maps.LatLng(-34.397, 150.644);

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 18,
            center: myLatlng
        });

        setGoogleMapMarker();
    }

    function setGoogleMapMarker() {
        //將所有旅館顯示在地圖上
        bounds = new google.maps.LatLngBounds();
        infowindow = new google.maps.InfoWindow({
            content: 'loading...'
        });

        $('.resultLi').each(function() {
            var nowElement = $(this);
            var myLatlng = new google.maps.LatLng(nowElement.find('.hotelLat').val(), nowElement.find('.hotelLng').val());

            //將座標加入bounds內
            bounds.extend(myLatlng);
            //設定marker
            var marker = new google.maps.Marker({
                map: map,
                animation: google.maps.Animation.DROP,
                position: myLatlng,
                title: nowElement.find('span').text()
            });
            //新增marker的點擊事件，動畫及顯示資訊視窗
            marker.addListener('click', function() {
                infowindow.open(map, marker);
                if(nowElement.find('.hotelUrl').val() != '') {
                    infowindow.setContent('<a href="' + nowElement.find('.hotelUrl').val() + '" target="blank">' + nowElement.find('span').text() + '<i class="fa fa-external-link fa-fw"></i></a>');
                } else {
                    infowindow.setContent(nowElement.find('span').text());
                }
                for(var i = 0;i < markers.length;i++) {
                    markers[i].marker.setAnimation();
                }
                marker.setAnimation(google.maps.Animation.BOUNCE);
            });
            //將地圖大小調整至可看到所有marker
            map.fitBounds(bounds);
            //將目前設定的marker加入陣列中
            markers.push({
                id: nowElement.find('.hotelId').val(),
                marker: marker
            });
            //在搜尋結果飯店名稱label上綁上click marker事件
            nowElement.click(function() {
                $('.resultLi').has('.label-primary').find('.label-primary').removeClass('label-primary').addClass('label-info');
                $(this).find('.label-info').removeClass('label-info').addClass('label-primary');
                google.maps.event.trigger(marker, 'click');
                var body = $("html, body");
                body.stop().animate({
                    scrollTop: $('#mapAnchor').offset().top - 40
                }, '500', 'swing');
            });
            nowElement.hover(
                function() {
                    var isValidateMember = '<?php echo($isValidateMember);?>';
                    //若搜尋結果小於4家或已刪除兩家，則無法使用刪除功能
                    if($('.resultLi:visible').length > 4 && $('.removeHotel').length < 2 && isValidateMember == 'Y') {
                        $(this).find('span').append('<a href="javascript:void(0);" style="position:absolute;font-size:20px;"><i class="fa fa-times-circle fa-fw" style="color:red;"></i></a>');
                        $(this).find('span a').css('top', parseInt($(this).find('span a').css('top')) - $('#filterResultDiv').scrollTop());
                        $(this).find('span a').bind('click', function(e) {
                            e.stopPropagation();
                            $(this).closest('.resultLi').hide();
                            marker.setMap(null);
                            $('#hotelCount').text($('.resultLi:visible').length);
                            $('#namePriceForm').append('<input type="hidden" class="removeHotel" name="removeHotel[]" value="' + nowElement.find('.hotelId').val() + '">');
                        });
                    }
                    $(this).stop().animate({
                        'opacity': 0.7
                    }, 200);
                },
                function() {
                    $(this).find('a').remove();
                    $(this).stop().animate({
                        'opacity': 1
                    }, 200);
                }
            );
        });
    }

    //加千分位
    function formatNumber(num) {
        var pattern = /(-?\d+)(\d{3})/;
        num = num.toString().replace(/,/g,'');

        while(pattern.test(num)) {
            num = num.replace(pattern, "$1,$2");
        }

        return num;
    }

    //檢查旅館列表div框是否出現scrollbar調整顯示下拉提示
    function setScrollDownTipDiv() {
        if($('#filterResultDiv').length < 1) {
            return;
        }
        if($('#filterResultDiv').get(0).scrollHeight > 400) {
            $('#scrollDownTipDiv').show();
        } else {
            $('#scrollDownTipDiv').hide();
        }
    }
</script>
<script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCcoPvq_yz7O-J8lF7vmQ2Mp_WiRItmeCU&callback=initMap">
</script>
<!-- script end