<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>首页</title>
    <meta name="viewport" content="target-densitydpi=320,width=640,user-scalable=no">
    <meta name="apple-touch-fullscreen" content="no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no" />
    <link type="text/css" rel="stylesheet" href="{{asset('main/css/common.css')}}">
    <script src="{{asset('main/js/jquery.js')}}"></script>
    <script src="{{asset('main/js/js.js')}}"></script>
    <script>
        $(function(){
            $('section.cj').height( $('body').height() );
        });
    </script>
</head>
<body>
<section class="cj_btn-wrap">  <!--开头-->
    <div class="cj_btn_font">每次投资消耗10积分</div>
    <div class="cj_btn_a"><a href="javascript:;" class="active cj_btn_start">赌一把</a><a href="javascript:;" class="cj_btn_grudge">舍不得</a> </div>
</section>
<section class="cj_btn-wrap cj_grade">  <!--获得积分-->
    <div class="cj_btn_font">亲,恭喜您获得<span></span>积分</div>
    <div class="cj_btn_a"><a href="javascript:;" class="active cj_btn_start">再赌一次</a><a href="javascript:;" class="cj_btn_grudge">舍不得</a> </div>
</section>
<section class="cj_btn-wrap cj_thanks">  <!--没中奖-->
    <div class="cj_btn_font">就差一点</div>
    <div class="cj_btn_a"><a href="javascript:;" class="active cj_btn_start">再赌一次</a><a href="javascript:;" class="cj_btn_grudge">舍不得</a> </div>
</section>
<section class="cj_btn-wrap cj_Count">  <!--次数用光-->
    <div class="cj_btn_font">亲,您次数花光了,请明天再来吧</div>
    <div class="cj_btn_a"><a href="javascript:;" class="cj_btn_grudge active">好  的</a></div>
</section>
<section class="cj">
    <div class="cj_content">
        <ul class="cj_block">
            <li id="1" class="active prize"><span>饭盒</span></li>
            <li id="2" class="thanks"><span><img src="{{asset('main/images/icon1.png')}}"> </span></li>
            <li id="3" class="grade"><span>20<br>积分</span></li>
            <li id="4" class="thanks mR0"><span><img src="{{asset('main/images/icon2.png')}}"></span></li>
            <li id="12" class="grade"><span>50<br>积分</span></li>
            <li></li>
            <li></li>
            <li id="5" class="mR0 prize"><span>饭盒</span></li>
            <li id="11" class="prize"><span>购房券</span></li>
            <li></li>
            <li></li>
            <li id="6" class="mR0 grade"><span>40<br>积分</span></li>
            <li id="10" class="thanks"><span><img src="{{asset('main/images/icon2.png')}}"></span></li>
            <li id="9" class="prize"><span>雨伞</span></li>
            <li id="8" class="thanks"><span><img src="{{asset('main/images/icon1.png')}}"></span></li>
            <li id="7" class="mR0 prize"><span>购房券</span></li>
        </ul>
    </div>
    <div class="cj_font_center">每日可抽奖3次，10个积分抽奖一次</div>
    <div class="spoil" style="display: none" >
        <div class="spoil_font">请留下您的相关信息吧</div>
        <form action="" method="">
            <p><label>姓名：</label><input type="text" class="spoil_text" placeholder=""> </p>
            <p><label>电话：</label><input type="text" class="spoil_text" placeholder=""></p>
            <p><label>地址：</label><input type="text" class="spoil_text" placeholder=""></p>
            <p><input type="submit" value="提  交" class="spoil_submit"> </p>
        </form>
        <div class="spoil_footer">
            备注：您的礼品将以快递到付的形式送到您手中
            <p>请注意查收</p>
        </div>
    </div>
</section>
</body>
</html>