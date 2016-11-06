<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-telecomOrder-index'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <!--<a href="<?php echo e(route('admin.telecomOrder.create')); ?>" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>-->
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="<?php echo e(route('admin.telecomOrder.destroy.all')); ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
								<a data-href="<?php echo e(route('admin.telecomOrder.save')); ?>"  class="btn btn-white tooltips" data-original-title="导出"><i class="glyphicon glyphicon-save"></i></a>
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
                                    <th>ID</th>
									<th>姓名</th>
									<th>套餐</th>
									<th>身份证</th>									
									<th>（院系）专业</th>
									<th>宿舍号</th>
									<th>学号</th>                                  
                                    <th>金额</th>
									<th>电信手机号码</th>
									<th>常用电话</th>									
									<th>支付状态</th>
									<th>交易订单号</th>
                                    <th>支付交易号</th>
                                    <th>创建时间</th>								
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	<?php foreach($orders as $order): ?>
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-<?php echo e($order->id); ?>"
                                                       value="<?php echo e($order->id); ?>" class="selectall-item"/>
                                                <label for="id-<?php echo e($order->id); ?>"></label>
                                            </div>
                                        </td>
										 <td><?php echo e($order->id); ?></td>
										 <td><?php echo e($order->name); ?></td>
										 <td><?php echo e($order->package_name); ?></td>
										 <td><?php echo e($order->idcard); ?></td>										 
										 <td><?php echo e($order->major); ?></td>
										 <td><?php echo e($order->dormitory_no); ?></td>
										 <td><?php echo e($order->student_id); ?></td>
										 <td><?php echo e($order->fee); ?></td>
										 <td><?php echo e($order->telecom_phone); ?></td>
										 <td><?php echo e($order->telecom_outOrderNumber); ?></td>										
										 <td><?php echo e(trans("common.pay_status.$order->pay_status")); ?></td>
										 <td><?php echo e($order->telecom_trade_no); ?></td>
										 <td><?php echo e($order->trade_no); ?></td>
										 <td><?php echo e($order->created_at); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.telecomOrder.edit',['id'=>$order->id])); ?>"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <a class="btn btn-danger btn-xs order-delete"
                                               data-href="<?php echo e(route('admin.telecomOrder.destroy',['id'=>$order->id])); ?>">
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
                confirmTitle: '确定删除订单?',
                href: $(this).data('href'),
                successTitle: '订单删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的订单?',
                href: $(this).data('href'),
                successTitle: '订单删除成功',
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>