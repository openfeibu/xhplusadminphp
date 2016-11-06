<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-paper-chickenSoup'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">
			<?php echo $__env->make('admin._partials.chickenSoup-left-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="col-sm-9 col-lg-10">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                 <a href="<?php echo e(route('admin.chickenSoup.create')); ?>" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="<?php echo e(route('admin.chickenSoup.destroy_all')); ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">实名列表</h5>
                        <?php echo $__env->make('admin._partials.show-page-status',['result'=>$chickenSoups], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
                                    <th>用户昵称</th>
                                    <th>鸡汤标题</th>
                                    <th>背景图片</th>
									<th>鸡汤内容</th>
                                    <th>审核状态</th>                               
                                    <th>提交时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	<?php foreach($chickenSoups as $chickenSoup): ?>
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-<?php echo e($chickenSoup->csid); ?>"
                                                       value="<?php echo e($chickenSoup->csid); ?>" class="selectall-item"/>
                                                <label for="id-<?php echo e($chickenSoup->csid); ?>"></label>
                                            </div>
                                        </td>
                                        <td><?php echo e($chickenSoup->csid); ?></td>
                                        <td><?php echo e($chickenSoup->uid); ?></td>
                                        <td>
                                            <?php if($chickenSoup->uid == 0): ?>
                                                系统
                                            <?php else: ?>
                                                <?php echo e($chickenSoup->nickname); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($chickenSoup->title); ?></td>
                                        <td>
                                            <img src="<?php echo e($chickenSoup->background_url); ?>" alt="" style="width:80px;height:80px">
                                        </td>
                                        <td style="width:100px;display: -webkit-box; -webkit-box-orient ;text-overflow: ellipsis;overflow : hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;"><?php echo e($chickenSoup->content); ?></td>
                                        <td>
											<?php if($chickenSoup->status == 0): ?>
                                                审核中
                                            <?php elseif($chickenSoup->status == 1): ?>
                                                审核通过
                                            <?php elseif($chickenSoup->status == 2): ?>
                                                审核失败
                                            <?php else: ?>
                                                未知状态
                                            <?php endif; ?>
										</td>
                                        <td><?php echo e($chickenSoup->created_at); ?></td>
                                        <td style="width:300px;text-align:right">
                                            <?php if($chickenSoup->status == 0): ?> 
                                            <a href="<?php echo e(route('admin.chickenSoup.pass',['id'=>$chickenSoup->csid])); ?>" data-target="" data-toggle="modal" class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 通过</a>
                                            <a href="<?php echo e(route('admin.chickenSoup.fail',['id'=>$chickenSoup->csid])); ?>" class="btn btn-white btn-xs" data-target="" data-toggle="modal" ><i class="fa fa-pencil"></i> 不通过   </a>
                                            <?php endif; ?>
                                            <a href="<?php echo e(route('admin.chickenSoup.edit',['id'=>$chickenSoup->csid])); ?>"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                       
                                            <a class="btn btn-danger btn-xs chickenSoup-delete"
                                               data-href="<?php echo e(route('admin.chickenSoup.destroy',['id'=>$chickenSoup->csid])); ?>">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
									</div>
                                <?php endforeach; ?>
			

                                </tbody>
                            </table>
                        </div>

                        <?php echo $chickenSoups->render(); ?>


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
        $(".chickenSoup-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定移除该鸡汤?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定将选中的鸡汤移出鸡汤列表?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>