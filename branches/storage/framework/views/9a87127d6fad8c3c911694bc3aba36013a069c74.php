<?php $__env->startSection('content'); ?>
    <div class="pageheader" >
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-association-association_activity_index'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="<?php echo e(route('admin.association_activity.create')); ?>" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="<?php echo e(route('admin.association_activity.destroy_all')); ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">社团列表</h5>
                        <?php echo $__env->make('admin._partials.show-page-status',['result'=>$activities], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
									<th>社团名称</th>
                                    <th>用户昵称</th>>
                                    <th>活动标题</th>
									<th>活动内容</th> 
                                    <th>活动开始时间</th>
                                    <th>活动结束时间</th> 
                                    <th>活动地点</th>
                                    <th>阅读数量</th>   
                                    <th>活动图片</th>                       
                                    <th>提交时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	<?php foreach($activities as $activity): ?>
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-<?php echo e($activity->actid); ?>"
                                                       value="<?php echo e($activity->actid); ?>" class="selectall-item"/>
                                                <label for="id-<?php echo e($activity->actid); ?>"></label>
                                            </div>
                                        </td>
                                        <form action="<?php echo e(route('admin.association_activity.update')); ?> " method="post">
                                        <td>
                                        <input type="text" value="<?php echo e($activity->actid); ?>"   readonly="readonly" name="actid"  style="border:0px;width:30px"></td>
										<td><?php echo e($activity->aname); ?></td>
                                        <td><?php echo e($activity->nickname); ?></td>
                                        <td>
                                        <textarea name="title" cols=40 rows=4  ondblclick="change_title()" readonly="readonly" id="title" style="border:0px;height:80px;">
                                        <?php echo e($activity->title); ?>

                                        </textarea>
                                        </td>
                                        <td>
                                        <textarea name="content" cols=40 rows=4  ondblclick="change_content()" readonly="readonly" id="content"  style="border:0px;height:80px;width:250px;">
                                        <?php echo e($activity->content); ?>

                                        </textarea>
                                        </td>
                                        <td>
                                        <input type="text" name="start_time" value="<?php echo e($activity->start_time); ?>"  ondblclick="change_start_time()" readonly="readonly" id="start_time"  style="border:0px;">
                                        </td>
                                        <td>
                                        <input type="text"  name="end_time"  ondblclick="change_end_time()" readonly="readonly" id="end_time"  style="border:0px;" value="<?php echo e($activity->end_time); ?>">
                                        </td>
                                        <td>
                                        <input type="text" name="place"  ondblclick="change_place()" readonly="readonly" id="place"  style="border:0px;" value="<?php echo e($activity->place); ?>">
                                        </td>
                                        <td><?php echo e($activity->view_num); ?></td>
                                        <td>
                                            <a href="<?php echo e($activity->img_url); ?>" target="_blank"><img src="<?php echo e($activity->img_url); ?>" alt="" style="width:80px;height:80px;"></a>
                                        </td>
                                        <td><?php echo e($activity->created_at); ?></td>
                                        <td style="width:150px">  
                                            <input type="submit" value="确认修改" class="btn btn-default btn-xs">                                     
                                            <a class="btn btn-danger btn-xs realname-delete"
                                               data-href="<?php echo e(route('admin.association_activity.destroy',['id'=>$activity->actid])); ?>">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
		
                                </tbody>
                            </table>
                        </div>

                        <?php echo $activities->render(); ?>


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
                confirmTitle: '确定移除?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定将选中的活动移除?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });
        function change_title(type){
          document.getElementById("title").readOnly = type;
         }
         function change_content(type){
          document.getElementById("content").readOnly = type;
         }
         function change_start_time(type){
          document.getElementById("start_time").readOnly = type;
         }
         function change_end_time(type){
          document.getElementById("end_time").readOnly = type;
         }
         function change_place(type){
          document.getElementById("place").readOnly = type;
         }
        
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>