<?php if($breadcrumbs): ?>
    <div class="breadcrumb-wrapper">
        <span class="label"></span>
        <ol class="breadcrumb">
            <?php foreach($breadcrumbs as $breadcrumb): ?>
                <?php if(!$breadcrumb->last): ?>
                    <li><a href="<?php echo e($breadcrumb->url); ?>"><?php echo e($breadcrumb->title); ?></a></li>
                <?php else: ?>
                    <li class="active"><?php echo e($breadcrumb->title); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </div>
<?php endif; ?>