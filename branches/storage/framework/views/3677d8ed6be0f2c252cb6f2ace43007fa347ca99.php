<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-order-index'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="<?php echo e(route('admin.order.create')); ?>" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="<?php echo e(route('admin.order.destroy.all')); ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">套餐列表</h5>
                        <?php echo $__env->make('admin._partials.show-page-status',['result'=>$orders], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
									<th>订单号</th>
                                    <th>发单人</th>
                                    <th>接单人</th> 
									<th>任务费用</th>								
									<th>服务费</th>  
									<th>目的地</th>
									<th>详情</th>
									<th>任务状态</th>  
                                    <th>创建时间</th>
									<th>状态改变时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	<?php foreach($orders as $order): ?>
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-<?php echo e($order->oid); ?>"
                                                       value="<?php echo e($order->oid); ?>" class="selectall-item"/>
                                                <label for="id-<?php echo e($order->oid); ?>"></label>
                                            </div>
                                        </td>
                                         <td><?php echo e($order->oid); ?></td>
										 <td><?php echo e($order->order_sn); ?></td> 
										 <td><?php echo e($order->owner_nickname); ?></td>
										 <td><?php echo e($order->courier_nickname); ?></td>
										 <td><?php echo e($order->fee); ?></td>	
										 <td><?php echo e($order->service_fee); ?></td>
										 <td><?php echo e($order->description); ?></td>
										 <td><?php echo e($order->destination); ?></td>
										 <td><?php echo e(trans("common.task_status.$order->status")); ?></td>
										 <td><?php echo e($order->created_at); ?></td>
										 <td><?php echo e($order->updated_at); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.order.edit',['id'=>$order->oid])); ?>"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <a class="btn btn-danger btn-xs order-delete"
                                               data-href="<?php echo e(route('admin.order.destroy',['id'=>$order->oid])); ?>">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <?php echo $orders->render(); ?>


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
        $(".order-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除任务?',
                href: $(this).data('href'),
                successTitle: '任务删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的任务?',
                href: $(this).data('href'),
                successTitle: '任务删除成功'
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>