<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的鸡汤发布</title>
    <style>
        .nickname_top{color:#eee;}
        .nickname_top span{float: right}
        .nickname_menu{height: 40px;width: 150px;background: #3F95FE;color: #818181;margin-right: 20px;line-height: 40px;text-align: center;border-radius: 5px;color: #fff;font-size: 20px;}
        .author_title{margin:0 auto;text-align: center;margin-top: 4%;font-size: 35px;color: #eee;letter-spacing:10px;}
        .verifyLists{width: 550px;height: 700px;border:2px #fff solid;float: left;margin-left: 50px;}
        .verifyList{height: 100px;width: 450px;border:1px #e2e1e1 solid;list-style: none;display: inline-block;color: #000;display: block;margin-top: 10px;border-radius: 5px;}
        .background_url{width: 80px;height: 80px;margin-left: 10px;margin-top:10px;float: left}
        .verifyList_content p{margin-left: 10px;color: #fff;margin-top: 5px;}
        .page_style a{text-decoration:none;display: inline;}
        .page_style li {color:#fff;list-style: none;height: 30px;width: 40px;background: #3F95FE;line-height: 30px;text-align: center;border-radius: 3px;margin-left:10px;float: left;margin-bottom: 10px;font-size: 20px;}
        .verifyLists_top{margin:0 auto;text-align: center;margin-top: 4%;font-size: 35px;color: #eee;letter-spacing:10px;}
        .verifyLists_Top{margin:0 auto;text-align: center;margin-top: 0;font-size: 35px;color: #eee;letter-spacing:10px;margin-bottom: 30px;}
        .verifyList_right{float: right;width: 500px;height: 700px;overflow-y:scroll ;border:2px #fff solid;margin-right: 50px;}
        
        .status_btn_pass,.status_btn_fail,.status_btn_delete{height: 25px;width: 50px;background: #3F95FE;color: #818181;margin-left: 5px;line-height: 25px;text-align: center;border-radius: 4px;color: #fff;font-size: 14px;display: inline-block;margin-top: -5px;}
        .status_btn_fail{background: orange;}
        .status_btn_pass{margin-left: 10px;}
        .status_btn_delete{background: #E91717;}

        .footer{width: 100%;margin:0 auto;text-align: center;color: #fff;margin-top: 30px;}
    </style>
</head>
<body>

    <div class="nickname_top">
        @if($is_author == 1)
            作者:{{ $nickname }}
        @elseif($is_author == 2)
            管理员:{{ $nickname }}
        @endif
        <a id="history" href="{{route('admin.chickenSoup.sendChickenSoup')}}">
            <span class="nickname_menu" >
                返回发布系统
            </span>
        </a>
    </div>
    <div style="clear:both"></div>

    <div class="verifyLists_top verifyLists_Top">
        <b>我的发布历史</b>
    </div>

    <div class="verifyLists">
        
        <div class="verifyLists_top">
            <b>历史记录</b>
        </div>
        <ul>
            @foreach($myList as $k => $list)
                <li class="verifyList" onclick="preview({{$list->csid}})">
                    <div>
                        <div style="clear:both"></div>
                        <img src="{{$list->background_url}}" alt="" class="background_url">
                        <div style="float: left;" class="verifyList_content">
                            <p>{{$list->title}}</p>
                            <p>{{$list->created_at}}</p>
                            <p>状态：@if($list->status == 0)
                                    <b style="color:orange">审核中</b>
                                    <span class="status_btn_delete"  onclick="status_btn_delete({{$list->csid}})">删除</span>
                                @elseif($list->status == 3)
                                    <b style="color:#7aa43D">已审核</b>
                                    <span class="status_btn_delete"  onclick="status_btn_delete({{$list->csid}})">删除</span>
                                @elseif($list->status == 1)
                                    状态：<b>已发布</b>    
                                @else
                                    <b style="color:red">审核失败</b>
                                    <span class="status_btn_delete"  onclick="status_btn_delete({{$list->csid}})">删除</span>
                                @endif
                            </p>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                </li>
            @endforeach
            <div style="clear:both;height:10px;"></div>
            <div style="width:350px;">
                @for($i = 1; $i <= ceil($countList/5) ; $i++)
                    <ul class="page_style">
                        <a href="{{route('admin.chickenSoup.myChickenSoupList',['page'=>$i])}}">
                            <li>{{$i}}</li>
                        </a>
                    </ul>
                @endfor
            </div>            
        </ul>
        <div style="clear:both;height:10px;"></div>
    </div>

    <div class="verifyList_right">
        <div class="verifyLists_top" style="margin-top:100px;">
            <b>点击左边的图文<br>这里可以看预览﹥○﹤</b>
        </div>
    </div>
    
    <div style="clear:both;height:10px;"></div>
    <div class="footer">
        版权所有©广州飞步信息科技有限公司
    </div>
</body>
</html>
<script type="text/javascript" src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){  
        
        var ran = "../../../../images/book"+parseInt(Math.random()*7)+".jpg";
        $('body').css({"background-image":"url("+ran+")","background-size":"100% auto","overflow-x":"hidden"});
    }); 
    

    $('#history').on('click',function(){
        history.go(-1);
    });

    function preview(csid){
        $.get("{{route('admin.chickenSoup.chickenSoupPreview')}}",'csid=' + csid,function(data){
            $('.verifyList_right').html(data.content);
        });
    }
    function status_btn_delete(id){
        if(confirm("确定删除该鸡汤图文？")){
            window.location="../chickenSoup/deleteVerifyList?id="+id;
        }
    }
</script>