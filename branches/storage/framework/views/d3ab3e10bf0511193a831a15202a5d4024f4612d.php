<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-user-real'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">
			<?php echo $__env->make('admin._partials.real-left-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="col-sm-9 col-lg-10">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="<?php echo e(route('admin.user.real_create')); ?>" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="<?php echo e(route('admin.user.real_destroy_all')); ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">实名列表</h5>
                        <?php echo $__env->make('admin._partials.show-page-status',['result'=>$realnames], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>
                                        <span class="ckbox ckbox-primary">
                                            <input type="checkbox" id="selectall"/>
                                            <label for="selectall"></label>
                                        </span>
                                    </th>
                                    <th>标识</th>
									<th>用户id</th>
                                    <th>用户名字</th>
                                    <th>正面图片</th>
									<th>反面图片</th>
                                    <th>实名状态</th>                               
                                    <th>提交时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	<?php foreach($realnames as $realname): ?>
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-<?php echo e($realname->id); ?>"
                                                       value="<?php echo e($realname->id); ?>" class="selectall-item"/>
                                                <label for="id-<?php echo e($realname->id); ?>"></label>
                                            </div>
                                        </td>
                                        <td><?php echo e($realname->id); ?></td>
										<td><?php echo e($realname->uid); ?></td>
                                        <td><?php echo e($realname->realname); ?></td>
                                        <td>
											
											<img id="img_pic" style="width:100px;height:50px;" src="<?php echo e($realname->pic1); ?>" data-toggle="modal" data-target="#myModal<?php echo e($realname->id); ?>"/>
										</td>
										<td>
											<a  ><img style="width:100px;height:50px;" src="<?php echo e($realname->pic2); ?>"  data-toggle="modal" data-target="#myModal2<?php echo e($realname->id); ?>"/></a>
										</td>
                                        <td>
											<?php
												if(empty($realname->realname)){
													echo "未审核";
												}else{
													echo "已审核";
												}
											?>
										</td>
                                        <td><?php echo e($realname->created_at); ?></td>
                                        <td style="width:150px">
                                            <a href="<?php echo e(route('admin.user.real_edit',['id'=>$realname->id])); ?>"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <a class="btn btn-danger btn-xs realname-delete"
                                               data-href="<?php echo e(route('admin.user.real_destroy',['id'=>$realname->id])); ?>">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
									
									<!-- 模态框（Modal） -->
									<div class="modal fade" id="myModal<?php echo e($realname->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog" style="height:400px;width:700px;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<?php echo e($realname->realname); ?>身份证正面
												</div>
												
												<a href="<?php echo e($realname->pic1); ?>"><img id="img_pic" style="width:700px;height:350px;" src="<?php echo e($realname->pic1); ?>" /></a> 
										
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">关闭
													</button>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal -->
									</div>
									<!-- 模态框（Modal） -->
									<div class="modal fade" id="myModal2<?php echo e($realname->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog" style="height:400px;width:700px;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<?php echo e($realname->realname); ?>身份证反面
												</div>
												
												<a href="<?php echo e($realname->pic2); ?>"><img id="img_pic" style="width:700px;height:350px;" src="<?php echo e($realname->pic2); ?>" /></a> 
										
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">关闭
													</button>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal -->
									</div>
                                <?php endforeach; ?>
			

                                </tbody>
                            </table>
                        </div>

                        <?php echo $realnames->render(); ?>


                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    @parent
    <script src="<?php echo e(asset('js/ajax.js')); ?>"></script>
    <script type="text/javascript"> 
        $(".realname-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定移除该用户在实名列表中?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定将选中的用户移除出实名列表?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>