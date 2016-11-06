<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-integral-index'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="<?php echo e(route('admin.integral.create')); ?>" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="<?php echo e(route('admin.integral.destroy_all')); ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">积分类型列表</h5>
                        <?php echo $__env->make('admin._partials.show-page-status',['result'=>$integrals], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
                                    <th>积分方式</th>
                                    <th>积分奖罚</th>                               
                                    <th>提交时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	<?php foreach($integrals as $integral): ?>
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-<?php echo e($integral->id); ?>"
                                                       value="<?php echo e($integral->id); ?>" class="selectall-item"/>
                                                <label for="id-<?php echo e($integral->id); ?>"></label>
                                            </div>
                                        </td>
										<td><?php echo e($integral->id); ?></td>
                                        <td><?php echo e($integral->obtain_type); ?></td>
                                        <td><?php echo e($integral->score); ?></td>
                                        <td><?php echo e($integral->created_at); ?></td>
										<td>
                                        <td style="width:150px">
                                            <a href="<?php echo e(route('admin.integral.edit',['id'=>$integral->id])); ?>"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <a class="btn btn-danger btn-xs realname-delete"
                                               data-href="<?php echo e(route('admin.integral.destroy',['id'=>$integral->id])); ?>">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
									
								
                                <?php endforeach; ?>
			

                                </tbody>
                            </table>
                        </div>

                        <?php echo $integrals->render(); ?>


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