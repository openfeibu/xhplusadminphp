<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-topic-comment'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="<?php echo e(route('admin.topic.comment_destroy_all')); ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">话题管理</h5>


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
                                    <th>话题id</th>
                                    <th>话题内容</th>
                                    <th>话题类型</th>
                                    <th>评论内容</th>
                                    <th>点赞数量</th>                            
                                    <th>评论时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	<?php foreach($comments as $comment): ?>
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-<?php echo e($comment->tcid); ?>"
                                                       value="<?php echo e($comment->tcid); ?>" class="selectall-item"/>
                                                <label for="id-<?php echo e($comment->tcid); ?>"></label>
                                            </div>
                                        </td>
                                        <td><?php echo e($comment->tcid); ?></td>
										<td><?php echo e($comment->uid); ?></td>
                                        <td><?php echo e($comment->nickname); ?></td>
                                        <td><?php echo e($comment->tid); ?></td>
                                        <td><?php echo e($comment->topic_content); ?></td>
                                        <td><?php echo e($comment->type); ?></td>
                                        <td><?php echo e($comment->content); ?></td>
                                        <td><?php echo e($comment->favourites_count); ?></td>
                                        <td><?php echo e($comment->created_at); ?></td>
                                        <td style="width:150px">
                                            <a href="<?php echo e(route('admin.topic.comment_edit',['id'=>$comment->tcid])); ?>"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <a class="btn btn-danger btn-xs topic-delete"
                                               data-href="<?php echo e(route('admin.topic.comment_destroy',['id'=>$comment->tcid])); ?>">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
									
							
                                <?php endforeach; ?>
			

                                </tbody>
                            </table>
                        </div>

                        <?php echo $comments->render(); ?>


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
        $(".topic-delete").click(function () {
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