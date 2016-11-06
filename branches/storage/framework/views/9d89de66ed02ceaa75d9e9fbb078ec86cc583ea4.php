<?php $__env->startSection('content'); ?>
    <script type="text/javascript" charset="utf-8" src="<?php echo e(asset('js/edit/ueditor.config.js')); ?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo e(asset('js/edit/ueditor.all.min.js')); ?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo e(asset('js/edit/lang/zh-cn/zh-cn.js')); ?>"></script>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <?php echo $__env->make('admin._partials.paper-left-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="col-sm-10 col-lg-10">
			
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title"><?php echo e($paper['type']); ?>文案编辑</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.paper.faq_store')); ?>" method="POST">
                        <div class="panel-body panel-body-nopadding">
							<div class="form-group">
								<label class="col-sm-3 control-label">文案名称</label>

								<div class="col-sm-6">
									<input type="text"  data-toggle="tooltip" name="type"
										   data-trigger="hover" class="form-control tooltips"
										   data-original-title="" value="<?php echo e($paper['type']); ?>">
								</div>
							</div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">文案网址</label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="url"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e($paper['url']); ?>">
                                </div>
                            </div>

                            <input type="text" name="id" value="<?php echo e($paper['id']); ?>" style="display:none">
                            <input type="text" name="route" value="<?php echo e($route); ?>" style="display:none">

                            <div class="form-group">
                                <div class="col-sm-12 col-md-12">
                                  
                                </div>
                            </div>

                            <?php echo e(csrf_field()); ?>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                    <a class="btn btn-primary" href="<?php echo e(route($route)); ?>" >取消</a>
                                </div>
                            </div>
                        </div>
                        <!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>