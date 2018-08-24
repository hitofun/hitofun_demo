<!-- style start -->
<style>
    .finish_Message_Div-Font{
        font-size: 20px;
        line-height: 30px;
        letter-spacing: 10px;
        font-weight:bold;

    }
    .finish_Message_Div-Font2{
        font-size: 20px;
        line-height: 30px;
        letter-spacing: 5px;

    }
    .finish_Message_Div-Font3{
        font-size: 16px;
        line-height: 30px;
        letter-spacing: 5px;
    }
</style>
<!-- style end -->

<header class="intro">
    <div class="intro-body">
        <div class="container StamentFontLeftTop80">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert" style="padding:50px;">
                        <table class="table table-hover">
                            <thead>
                                <tr style="font-size:26px;">
                                    <th><i class="fa fa-hotel fa-fw"></i>旅館</th>
                                    <th style="text-align:right;"><i class="fa fa-envelope fa-fw"></i>寄送狀態</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orderConfirmInfo->hotelList as $hotel) {?>
                                    <tr style="font-size:30px;">
                                        <td><?php echo($hotel->hotelName);?></td>
                                        <td style="text-align:right;color:#5cb85c;"><i class="fa fa-check fa-fw"></i></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- script start -->
<script>
</script>
<!-- script  -->