<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>发布中心</title>
	<script type="text/javascript" charset="utf-8" src="{{ asset('js/edit/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ asset('js/edit/ueditor.all.min.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ asset('js/edit/lang/zh-cn/zh-cn.js') }}"></script>
    <script type="text/javascript" src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
</head>
    <style>
        .nickname_top{color:#eee;}
        .nickname_top span{float: right}
        .nickname_menu{height: 40px;width: 120px;background: #3F95FE;color: #818181;margin-right: 20px;line-height: 40px;text-align: center;border-radius: 5px;color: #fff;font-size: 20px;}
        .author_title{margin:0 auto;text-align: center;margin-top: 4%;font-size: 35px;color: #eee;letter-spacing:10px;}
        .chickenSoup_title span,.chickenSoup_background span{display: inline-block;width:25%;text-align: right;color: #fff;font-size: 20px;}
        #title{width: 60%;height: 35px;border-radius: 5px;border:1px #BFA48E solid;box-shadow: 1px 1px 1px #BFA48E; -webkit-box-shadow: 1px 1px 1px #BFA48E;-moz-box-shadow: 1px 1px 1px #BFA48E;margin-left: 5%;font-size: 16px;color: #818181}
        .chickenSoup_title,.chickenSoup_background,.chickenSoup_content{margin-top: 10%} 
        .chickenSoup_content{width: 60%;}
        .chickenSoup_background img{width: 100px;height: 100px;}
        .chickenSoup_left{width: 30%;margin-left:5%;}
        #editor{width: 100%;height: 400px;margin-top: -12%}
        .chickenSoup_submit_btn{margin:0 auto;width: 100%;display: inline-block;text-align: center}
        #submit_btn{height: 50px;background:#944A34;color: #fff;font-size: 23px;width: 20%;border-radius: 5px;border:1px #BFA48E solid;box-shadow: 1px 1px 1px #BFA48E; -webkit-box-shadow: 1px 1px 1px #BFA48E;-moz-box-shadow: 1px 1px 1px #BFA48E;}
        .footer{width: 100%;margin:0 auto;text-align: center;color: #fff;margin-top: 30px;}
    </style>
<body>
    @if($is_author == 1)
        <div class="nickname_top">
            作者:{{ $nickname }}
            <a href="{{route('admin.chickenSoup.myChickenSoupList',['page'=>1])}}">
                <span class="nickname_menu">
                    我的发布
                </span>
            </a>
        </div>
    @elseif($is_author == 2)
        <div class="nickname_top">
            管理员:{{ $nickname }}
            <a href="{{route('admin.chickenSoup.myChickenSoupList',['page'=>1])}}">
                <span class="nickname_menu">
                    我的发布
                </span>
            </a>
            <a href="{{route('admin.chickenSoup.chickenSoupVerifyList',['page'=>1])}}">
                <span class="nickname_menu" >
                    审核列表
                </span>
            </a>
        </div>
    @endif
    
    <div style="clear:both"></div>
    <div class="author_title">
        <b>校汇鸡汤发布系统</b>
    </div>
	<form class="" action="{{route('admin.chickenSoup.store')}}" enctype="multipart/form-data" method="POST" style="height:auto;">
        <input type="text" name="uid" id="title" value="{{ $uid }}" style="display:none">
        <div style="float:left" class="chickenSoup_left">
            <div class="chickenSoup_title">
                <span>标题:</span>
                <input type="text" name="title" id="title">
            </div>
            <div class="chickenSoup_background">
                <span>背景图片:</span>
                <img id="background_img"  src="{{ asset('images/add_img.png')}}" alt="" onclick="background_url.click()">
                <input type="file" name="background_url" id="background_url" style="display:none">
            </div>
        </div>
		<div class="chickenSoup_content" style="float:left">
			<script id="editor" name="editor" type="text/plain"></script>
		</div>
        <div style="clear:both;height:200px;" ></div>
		<div class="chickenSoup_submit_btn">
			<input type="button" id="submit_btn" value="发表" >
		</div>
	</form>

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
    $('#submit_btn').on('click',function(){
        if($('#title').val() == ""){
            alert("还没填写标题");
        }else if($('input[name="background_url"]').prop('files').length == 0){
            alert("还没选择背景图片");
        }else if($('#editor').html() == ""){
            alert("还没填写内容");
        }else{
            $('#submit_btn').attr('type','submit');
        }
    });

    $('#background_url').on('change',function(){
        if (getObjectURL(this.files[0])) {
            $('#background_img').attr('src',getObjectURL(this.files[0]));
        }
    });

    function getObjectURL(file) {
        var url = null ; 
        if (window.createObjectURL!=undefined) { // basic
            url = window.createObjectURL(file) ;
        } else if (window.URL!=undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        } else if (window.webkitURL!=undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }
</script>
<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');

    ue.execCommand( 'inserthtml', yourhtml);
    
    function isFocus(e){
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('editor').execCommand('insertHtml', value)
    }
    function createEditor() {
        enableBtn();
        UE.getEditor('editor');
    }
    function getAllHtml() {
        alert(UE.getEditor('editor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getContent());
        alert(arr.join("\n"));
    }
    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getPlainTxt());
        alert(arr.join('\n'))
    }
    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
        UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UE.getEditor('editor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UE.getEditor('editor').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UE.getEditor('editor').selection.getRange();
        range.select();
        var txt = UE.getEditor('editor').selection.getText();
        alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UE.getEditor('editor').getContentTxt());
        alert(arr.join("\n"));
    }
    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UE.getEditor('editor').hasContents());
        alert(arr.join("\n"));
    }
    function setFocus() {
        UE.getEditor('editor').focus();
    }
    function deleteEditor() {
        disableBtn();
        UE.getEditor('editor').destroy();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
        }
    }

    function getLocalData () {
        alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
    }

    function clearLocalData () {
        UE.getEditor('editor').execCommand( "clearlocaldata" );
        alert("已清空草稿箱")
    }


</script>
</html>