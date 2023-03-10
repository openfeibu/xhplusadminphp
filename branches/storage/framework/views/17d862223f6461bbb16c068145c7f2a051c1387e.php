<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.png')); ?>" type="image/png">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>

    <title>Rbac</title>

    <?php $__env->startSection('css'); ?>
        <link href="<?php echo e(asset('css/style.default.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/jquery.datatables.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/sweetalert.css')); ?>" rel="stylesheet">
        <?php echo $__env->yieldSection(); ?>

                <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="<?php echo e(asset('js/html5shiv.js')); ?>"></script>
        <script src="<?php echo e(asset('js/respond.min.js')); ?>"></script>
        <![endif]-->
</head>

<body>

<!-- Preloader -->
<!-- <div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div> -->

<section>

    <div class="leftpanel">

        <div class="logopanel">
            <h1><span>[</span> Rbac <span>]</span></h1>
        </div><!-- logopanel -->

        <div class="leftpanelinner">

            <!-- This is only visible to small devices -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media userlogged">
                    <img alt="" src="<?php echo e(asset('images/photos/loggeduser.png')); ?>" class="media-object">
                    <div class="media-body">
                        <h4><?php echo Auth::guard('admin')->user()->id ?></h4>
                        <span>"Life is so..."</span>
                    </div>
                </div>

                <h5 class="sidebartitle actitle">Account</h5>
                <ul class="nav nav-pills nav-stacked nav-bracket mb30">
                    <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                    <li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
                    <li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
                    <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>

            <h5 class="sidebartitle">Navigation</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket">

                <?php $permissionPresenter = app('App\Presenters\PermissionPresenter'); ?>

                <?php echo $permissionPresenter->menus(); ?>


            </ul>


        </div><!-- leftpanelinner -->
    </div><!-- leftpanel -->

    <div class="mainpanel">

        <div class="headerbar">

            <a class="menutoggle"><i class="fa fa-bars"></i></a>

            <form class="searchform" action="index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="Search here..."/>
            </form>

            <div class="header-right">
                <ul class="headermenu">
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo e(asset('images/photos/loggeduser.png')); ?>" alt=""/>
                                <?php echo e(Auth::guard('admin')->user()->name); ?>

                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href="<?php echo e(url('admin/logout ')); ?>"><i class="glyphicon glyphicon-log-out"></i> ??????</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div><!-- header-right -->

        </div><!-- headerbar -->


        <?php echo $__env->yieldContent('content'); ?>


    </div><!-- mainpanel -->

    <div class="rightpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#rp-alluser" data-toggle="tab"><i class="fa fa-users"></i></a></li>
            <li><a href="#rp-favorites" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
            <li><a href="#rp-history" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
            <li><a href="#rp-settings" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

        </div><!-- tab-content -->
    </div><!-- rightpanel -->


</section>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/jquery-1.10.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-migrate-1.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-ui-1.10.3.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/modernizr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/toggles.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/retina.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.cookies.js')); ?>"></script>
    <script src="<?php echo e(asset('js/flot/flot.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/flot/flot.resize.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/morris.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/raphael-2.1.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/chosen.jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
	<script src="<?php echo e(asset('js/jquery.pjax.min.js')); ?>"></script>
	<script>
		/* $(document).pjax('a', '#pjax-container');
		$(document).on("pjax:timeout", function(event) {
			// ??????????????????????????????????????????
			event.preventDefault()
		}); */
	</script>
    <?php echo Toastr::render(); ?>

<?php echo $__env->yieldSection(); ?>

	
</body>
</html>
