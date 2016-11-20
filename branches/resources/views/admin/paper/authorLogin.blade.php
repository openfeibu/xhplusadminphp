<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <script type="text/javascript" src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
    <style>
    	.author_title{margin:0 auto;text-align: center;margin-top: 4%;font-size: 35px;color: #eee;letter-spacing:10px;}
		.background_opacity,.author_login{width: 50%;height: 60%;border: 2px #e2e1e1 solid;border-radius: 10px;margin-left: 25%;margin-top: 3%;z-index: 2;position: absolute;}
		.background_opacity{opacity:0.5;background: #6A5041;z-index: 2;position: absolute;}
		.authorDiv{margin-top: 10%;margin-left:5%;width: 80%;height: 100%}
		.authorDiv span{color: #fff;width: 30%;text-align: right;display: inline-block;font-size: 20px;}
		.authorDiv_input {width: 50%;height: 35px;border-radius: 5px;border:1px #BFA48E solid;box-shadow: 1px 1px 1px #BFA48E; -webkit-box-shadow: 1px 1px 1px #BFA48E;-moz-box-shadow: 1px 1px 1px #BFA48E;margin-left: 5%;}
		.authorDiv_password{margin-left: 6.5%;}
		.authorDiv_username,.authorDiv_password{padding-left: 5px;font-size:16px;}
		.author_submit{height: 40px;background:#291F15;color: #fff;font-size: 20px;width: 52%;}
		.footer{width: 100%;margin:0 auto;text-align: center;color: #fff;position:absolute;bottom:0;margin-bottom:20px;}
    </style>
</head>
<body>
	<div class="author_title">
		<b>校汇鸡汤发布系统</b>
	</div>
	<div class="background_opacity"></div>
	<div class="author_login">
		<form action="{{route('admin.chickenSoup.authorPostLogin')}}" method="post">
			<div class="author_username authorDiv">
				<span>手机号码:</span> <input type="text" id="mobile_no" name="mobile_no" class="authorDiv_input authorDiv_username" placeholder="请输入手机号码">
			</div>
			<div class="author_password authorDiv">
				<span>密码:</span><input type="password" id="password" name="password" class="authorDiv_input authorDiv_password"  placeholder="请输入密码">
			</div>
	       <div class="authorDiv">
	       		<span></span>
				<input type="button" value="登录" class="author_submit authorDiv_input" id="author_submit">  
	       </div>
	  	</form>
	</div>

	<div style="clear:both;height:10px;"></div>
    <div class="footer">
        版权所有©广州飞步信息科技有限公司
    </div>
</body>
<script>
    var ran = "../../../../images/book"+parseInt(Math.random()*7)+".jpg";
    $('body').css({"background-image":"url("+ran+")","background-size":"cover","overflow-x":"hidden","background-repeat":"no-repeat"});
</script>
<script>
	$('#author_submit').on('click',function(){
		if($('#mobile_no').val() == ""){
			alert("手机号码不能为空");
		}else if($('#password').val() == ""){
			alert("密码不能为空");
		}else{
			$('#author_submit').attr('type','submit');
		}
	});
</script>
</html>