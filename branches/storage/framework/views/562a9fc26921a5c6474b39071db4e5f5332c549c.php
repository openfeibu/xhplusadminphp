<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-accusation-index'); ?>

    </div>

    <div class="contentpanel panel-email">
        <div class="row">
            <?php echo $__env->make('admin._partials.accusation-left-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="col-sm-10 col-lg-10">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="<?php echo e(route('admin.accusation.destroy_all')); ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">举报列表</h5>
                        <?php echo $__env->make('admin._partials.show-page-status',['result'=>$accusations], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
                                    <th>订单id</th>
                                    <th>订单描述</th> 
                                    <th>投诉内容</th>  
                                    <th>投诉类型</th>  
                                    <th>投诉审核状态</th>                                
                                    <th>投诉时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	<?php foreach($accusations as $accusation): ?>
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-<?php echo e($accusation->id); ?>"
                                                       value="<?php echo e($accusation->id); ?>" class="selectall-item"/>
                                                <label for="id-<?php echo e($accusation->id); ?>"></label>
                                            </div>
                                        </td>
										<td><?php echo e($accusation->id); ?></td>
                                        <td><?php echo e($accusation->oid); ?></td>
                                        <td><?php echo e($accusation->description); ?></td>
                                        <td><?php echo e($accusation->content); ?></td>
                                        <td><?php echo e($accusation->type); ?></td>
                                        <td><?php echo e($accusation->state); ?></td>
                                        <td><?php echo e($accusation->created_at); ?></td>
										<td>
                                        <td style="width:150px">
                                            <a href="<?php echo e(route('admin.accusation.edit',['id'=>$accusation->id])); ?>"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <a class="btn btn-danger btn-xs realname-delete"
                                               data-href="<?php echo e(route('admin.accusation.destroy',['id'=>$accusation->id])); ?>">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
									
								
                                <?php endforeach; ?>
			

                                </tbody>
                            </table>
                        </div>

                        <?php echo $accusations->render(); ?>


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