<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

});



Route::group(['middleware' => ['web'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::auth();

    Route::get('/home', ['as' => 'admin.home', 'uses' => 'HomeController@index']);
    Route::resource('admin_user', 'AdminUserController');
    Route::post('admin_user/destroyall',['as'=>'admin.admin_user.destroy.all','uses'=>'AdminUserController@destroyAll']);
    Route::resource('role', 'RoleController');
    Route::post('role/destroyall',['as'=>'admin.role.destroy.all','uses'=>'RoleController@destroyAll']);
    Route::get('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@permissions']);
    Route::post('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@storePermissions']);
    Route::resource('permission', 'PermissionController');
    Route::post('permission/destroyall',['as'=>'admin.permission.destroy.all','uses'=>'PermissionController@destroyAll']);
    Route::resource('blog', 'BlogController');

	Route::get('game',['as' => 'admin.game.index' ,'uses' => 'GameController@index' ]);
    Route::get('game/prizes',['as' => 'admin.game.prizes' ,'uses' => 'GameController@prizes' ]);
    Route::post('game/prizesRunEdit',['as' => 'admin.game.prizes_runedit' ,'uses' => 'GameController@prizesRunEdit' ]);
    Route::get('game/userPrizes',['as' => 'admin.game.user_prizes' ,'uses' => 'GameController@userPrizes' ]);

	Route::get('shop',['as' => 'admin.shop.index' ,'uses' => 'ShopController@index' ]);
	Route::get('shop/create',['as' => 'admin.shop.create' ,'uses' => 'ShopController@create' ]);
	Route::get('shop/edit/{id}',['as' => 'admin.shop.edit' ,'uses' => 'ShopController@edit' ]);
	Route::PUT('shop/update',['as' => 'admin.shop.update' ,'uses' => 'ShopController@update' ]);
    Route::post('shop/store',['as' => 'admin.shop.store' ,'uses' => 'ShopController@store' ]);
	Route::post('shop/destroy',['as' => 'admin.shop.destroy' ,'uses' => 'ShopController@destroy' ]);
	Route::post('shop/destroyall',['as'=>'admin.shop.destroy.all','uses'=>'ShopController@destroyAll']);

    Route::get('drivingSchool',['as' => 'admin.drivingSchool.index' ,'uses' => 'DrivingSchoolController@index' ]);
	Route::get('drivingSchool/create',['as' => 'admin.drivingSchool.create' ,'uses' => 'DrivingSchoolController@create' ]);
	Route::get('drivingSchool/edit/{id}',['as' => 'admin.drivingSchool.edit' ,'uses' => 'DrivingSchoolController@edit' ]);
	Route::PUT('drivingSchool/update',['as' => 'admin.drivingSchool.update' ,'uses' => 'DrivingSchoolController@update' ]);
    Route::post('drivingSchool/store',['as' => 'admin.drivingSchool.store' ,'uses' => 'DrivingSchoolController@store' ]);
	Route::DELETE('drivingSchool/destroy',['as' => 'admin.drivingSchool.destroy' ,'uses' => 'DrivingSchoolController@destroy' ]);
	Route::post('drivingSchool/destroyall',['as'=>'admin.drivingSchool.destroy.all','uses'=>'DrivingSchoolController@destroyAll']);
    Route::get('drivingSchool/createPro',['as' => 'admin.drivingSchool.createPro' ,'uses' => 'DrivingSchoolController@createPro' ]);
    Route::post('drivingSchool/storePro',['as' => 'admin.drivingSchool.storePro' ,'uses' => 'DrivingSchoolController@storePro' ]);
    Route::get('drivingSchool/editPro/{id}',['as' => 'admin.drivingSchool.editPro' ,'uses' => 'DrivingSchoolController@editPro' ]);
    Route::DELETE('drivingSchool/destroyPro',['as' => 'admin.drivingSchool.destroyPro' ,'uses' => 'DrivingSchoolController@destroyPro' ]);
    Route::PUT('drivingSchool/updatePro',['as' => 'admin.drivingSchool.updatePro' ,'uses' => 'DrivingSchoolController@updatePro' ]);

    Route::get('education',['as' => 'admin.education.index' ,'uses' => 'EducationController@index' ]);
	Route::get('education/create',['as' => 'admin.education.create' ,'uses' => 'EducationController@create' ]);
	Route::get('education/edit/{id}',['as' => 'admin.education.edit' ,'uses' => 'EducationController@edit' ]);
	Route::PUT('education/update',['as' => 'admin.education.update' ,'uses' => 'EducationController@update' ]);
    Route::post('education/store',['as' => 'admin.education.store' ,'uses' => 'EducationController@store' ]);
	Route::DELETE('education/destroy',['as' => 'admin.education.destroy' ,'uses' => 'EducationController@destroy' ]);
	Route::post('education/destroyall',['as'=>'admin.education.destroy.all','uses'=>'EducationController@destroyAll']);
    Route::get('education/createPro',['as' => 'admin.education.createPro' ,'uses' => 'EducationController@createPro' ]);
    Route::post('education/storePro',['as' => 'admin.education.storePro' ,'uses' => 'EducationController@storePro' ]);
    Route::get('education/editPro/{id}',['as' => 'admin.education.editPro' ,'uses' => 'EducationController@editPro' ]);
    Route::DELETE('education/destroyPro',['as' => 'admin.education.destroyPro' ,'uses' => 'EducationController@destroyPro' ]);
    Route::PUT('education/updatePro',['as' => 'admin.education.updatePro' ,'uses' => 'EducationController@updatePro' ]);

    Route::get('recommend',['as' => 'admin.recommend.index' ,'uses' => 'RecommendController@index' ]);
	Route::get('recommend/create',['as' => 'admin.recommend.create' ,'uses' => 'RecommendController@create' ]);
	Route::get('recommend/edit/{id}',['as' => 'admin.recommend.edit' ,'uses' => 'RecommendController@edit' ]);
	Route::PUT('recommend/update',['as' => 'admin.recommend.update' ,'uses' => 'RecommendController@update' ]);
    Route::post('recommend/store',['as' => 'admin.recommend.store' ,'uses' => 'RecommendController@store' ]);
	Route::post('recommend/destroy',['as' => 'admin.recommend.destroy' ,'uses' => 'RecommendController@destroy' ]);
	Route::post('recommend/destroyall',['as'=>'admin.recommend.destroy.all','uses'=>'RecommendController@destroyAll']);


	Route::get('telecom',['as' => 'admin.telecomPackage.index','uses' => 'TelecomController@index' ]);
	Route::get('telecom/createPackage',['as' => 'admin.telecomPackage.create' ,'uses' => 'TelecomController@createPackage' ]);
	Route::post('telecom/storePackage',['as' => 'admin.telecomPackage.store' ,'uses' => 'TelecomController@storePackage' ]);
	Route::get('telecom/editPackage/{id}',['as' => 'admin.telecomPackage.edit' ,'uses' => 'TelecomController@editPackage' ]);
	Route::put('telecom/updatePackage/{id}',['as' => 'admin.telecomPackage.update' ,'uses' => 'TelecomController@updatePackage' ]);
	Route::DELETE('telecom/destroyPackage/{id}',['as' => 'admin.telecomPackage.destroy' ,'uses' => 'TelecomController@destroyPackage' ]);
	Route::post('telecom/destroyallPackage',['as'=>'admin.telecomPackage.destroy.all','uses'=>'TelecomController@destroyallPackage']);

	Route::get('telecom/telecomOrder',['as' => 'admin.telecomOrder.index','uses' => 'TelecomController@order' ]);
	Route::get('telecom/createOrder',['as' => 'admin.telecomOrder.create' ,'uses' => 'TelecomController@createOrder' ]);
	Route::get('telecom/editOrder/{id}',['as' => 'admin.telecomOrder.edit' ,'uses' => 'TelecomController@editOrder' ]);
	Route::get('telecom/saveOrder',['as' => 'admin.telecomOrder.save','uses' => 'TelecomController@saveOrder' ]);
	Route::put('telecom/updateOrder/{id}',['as' => 'admin.telecomOrder.update' ,'uses' => 'TelecomController@updateOrder' ]);
	Route::DELETE('telecom/destroyOrder/{id}',['as' => 'admin.telecomOrder.destroy' ,'uses' => 'TelecomController@destroyOrder' ]);
	Route::post('telecom/destroyallOrder',['as'=>'admin.telecomOrder.destroy.all','uses'=>'TelecomController@destroyallOrder']);

    Route::get('telecom/enrollmentTime',['as' => 'admin.telecomEnroll.time','uses' => 'TelecomController@enrollmentTime' ]);
    Route::get('telecom/enrollmentEditTime',['as' => 'admin.telecomEnroll.editTime','uses' => 'TelecomController@enrollmentTime' ]);
    Route::get('telecom/enrollments',['as' => 'admin.telecomEnroll.enrollments','uses' => 'TelecomController@enrollments' ]);


	Route::get('user/real',['as' => 'admin.user.real' ,'uses' => 'RealnameController@index' ]);
	Route::DELETE('user/real_destroy/{id}',['as' => 'admin.user.real_destroy' ,'uses' => 'RealnameController@real_destroy' ]);
	Route::post('user/real_destroy_all',['as' => 'admin.user.real_destroy_all' ,'uses' => 'RealnameController@real_destroy_all' ]);
	Route::post('user/real_pass',['as' => 'admin.user.real_pass' ,'uses' => 'RealnameController@real_pass' ]);
	Route::post('user/real_fail',['as' => 'admin.user.real_fail' ,'uses' => 'RealnameController@real_fail' ]);

	Route::get('user',['as' => 'admin.user.index' ,'uses' => 'UserController@index' ]);
	Route::get('user/create',['as' => 'admin.user.create' ,'uses' => 'UserController@create' ]);
	Route::get('user/edit/{id}',['as' => 'admin.user.edit' ,'uses' => 'UserController@edit' ]);
	Route::DELETE('user/destroy/{id}',['as' => 'admin.user.destroy' ,'uses' => 'UserController@destroy' ]);
	Route::post('user/destroy_all',['as' => 'admin.user.destroy_all' ,'uses' => 'UserController@destroy_all' ]);
	Route::post('user/store',['as' => 'admin.user.store' ,'uses' => 'UserController@store' ]);
	Route::get('user/searchUser',['as' => 'admin.user.searchUser' ,'uses' => 'UserController@searchUser' ]);

	Route::get('user/walletAccount/{uid}',['as' => 'admin.user.wallet_account' ,'uses' => 'UserController@walletAccount' ]);

	Route::get('trade',['as' => 'admin.trade.index','uses' => 'TradeController@index' ]);
	Route::get('trade/create',['as' => 'admin.trade.create' ,'uses' => 'TradeController@create' ]);
	Route::post('trade/store',['as' => 'admin.trade.store' ,'uses' => 'TradeController@store' ]);
	Route::get('trade/edit/{id}',['as' => 'admin.trade.edit' ,'uses' => 'TradeController@edit' ]);
	Route::put('trade/update/{id}',['as' => 'admin.trade.update' ,'uses' => 'TradeController@update' ]);
	Route::DELETE('trade/destroy/{id}',['as' => 'admin.trade.destroy' ,'uses' => 'TradeController@destroy' ]);
	Route::post('trade/destroyall',['as'=>'admin.trade.destroy.all','uses'=>'TradeController@destroyall']);

	Route::get('applyWallet',['as' => 'admin.applyWallet.index','uses' => 'ApplyWalletController@index' ]);
	Route::get('applyWallet/create',['as' => 'admin.applyWallet.create' ,'uses' => 'ApplyWalletController@create' ]);
	Route::post('applyWallet/store',['as' => 'admin.applyWallet.store' ,'uses' => 'ApplyWalletController@store' ]);
	Route::get('applyWallet/edit/{id}',['as' => 'admin.applyWallet.edit' ,'uses' => 'ApplyWalletController@edit' ]);
	Route::put('applyWallet/update/{id}',['as' => 'admin.applyWallet.update' ,'uses' => 'ApplyWalletController@update' ]);
	Route::DELETE('applyWallet/destroy/{id}',['as' => 'admin.applyWallet.destroy' ,'uses' => 'ApplyWalletController@destroy' ]);
	Route::post('applyWallet/destroyall',['as'=>'admin.applyWallet.destroy.all','uses'=>'ApplyWalletController@destroyall']);

	Route::get('applyWallet',['as' => 'admin.applyWallet.index','uses' => 'ApplyWalletController@index' ]);
	Route::get('applyWallet/create',['as' => 'admin.applyWallet.create' ,'uses' => 'ApplyWalletController@create' ]);
	Route::post('applyWallet/store',['as' => 'admin.applyWallet.store' ,'uses' => 'ApplyWalletController@store' ]);
	Route::get('applyWallet/edit/{id}',['as' => 'admin.applyWallet.edit' ,'uses' => 'ApplyWalletController@edit' ]);
	Route::put('applyWallet/update/{id}',['as' => 'admin.applyWallet.update' ,'uses' => 'ApplyWalletController@update' ]);
	Route::DELETE('applyWallet/destroy/{id}',['as' => 'admin.applyWallet.destroy' ,'uses' => 'ApplyWalletController@destroy' ]);
	Route::post('applyWallet/destroyall',['as'=>'admin.applyWallet.destroy.all','uses'=>'ApplyWalletController@destroyall']);

	Route::get('order',['as' => 'admin.order.index','uses' => 'OrderController@index' ]);
	Route::get('order/create',['as' => 'admin.order.create' ,'uses' => 'OrderController@create' ]);
	Route::post('order/store',['as' => 'admin.order.store' ,'uses' => 'OrderController@store' ]);
	Route::get('order/edit/{id}',['as' => 'admin.order.edit' ,'uses' => 'OrderController@edit' ]);
	Route::put('order/update/{id}',['as' => 'admin.order.update' ,'uses' => 'OrderController@update' ]);
	Route::DELETE('order/destroy/{id}',['as' => 'admin.order.destroy' ,'uses' => 'OrderController@destroy' ]);
	Route::post('order/destroyall',['as'=>'admin.order.destroy.all','uses'=>'OrderController@destroyall']);

	Route::get('order/refundIndex',['as' => 'admin.order.refundIndex','uses' => 'OrderController@refundIndex' ]);
	Route::get('order/refund/{id}',['as' => 'admin.order.refund','uses' => 'OrderController@refund' ]);
	Route::get('order/refundAll/{ids}',['as' => 'admin.order.refundAll','uses' => 'OrderController@refundAll' ]);
	Route::put('order/refundHandle',['as' => 'admin.order.refundHandle','uses' => 'OrderController@refundHandle' ]);
	Route::DELETE('order/destroyRefund/{id}',['as' => 'admin.order.destroyRefund' ,'uses' => 'OrderController@destroyRefund' ]);
	Route::post('orderRefund/destroyRefundAll',['as'=>'admin.order.destroyRefund.all','uses'=>'OrderController@destroyRefundAll']);


	Route::get('topic',['as' => 'admin.topic.index' ,'uses' => 'TopicController@index' ]);
	Route::get('topic/create',['as' => 'admin.topic.create' ,'uses' => 'TopicController@create' ]);
	Route::get('topic/edit/{id}',['as' => 'admin.topic.edit' ,'uses' => 'TopicController@edit' ]);
	Route::DELETE('topic/destroy/{id}',['as' => 'admin.topic.destroy' ,'uses' => 'TopicController@destroy' ]);
	Route::post('topic/destroy_all',['as' => 'admin.topic.destroy_all' ,'uses' => 'TopicController@destroy_all' ]);
	Route::post('topic/store',['as' => 'admin.topic.store' ,'uses' => 'TopicController@store' ]);

	Route::get('topic/comment',['as' => 'admin.topic.comment' ,'uses' => 'TopicController@comment' ]);
	Route::get('topic/comment_create',['as' => 'admin.topic.comment_create' ,'uses' => 'TopicController@comment_create' ]);
	Route::get('topic/comment_edit/{id}',['as' => 'admin.topic.comment_edit' ,'uses' => 'TopicController@comment_edit' ]);
	Route::DELETE('topic/comment_destroy/{id}',['as' => 'admin.topic.comment_destroy' ,'uses' => 'TopicController@comment_destroy' ]);
	Route::post('topic/comment_destroy_all',['as' => 'admin.topic.comment_destroy_all' ,'uses' => 'TopicController@comment_destroy_all' ]);
	Route::post('topic/comment_store',['as' => 'admin.topic.comment_store' ,'uses' => 'TopicController@comment_store' ]);

	Route::get('integral',['as' => 'admin.integral.index' ,'uses' => 'IntegralController@index' ]);
	Route::get('integral/create',['as' => 'admin.integral.create' ,'uses' => 'IntegralController@create' ]);
	Route::get('integral/edit/{id}',['as' => 'admin.integral.edit' ,'uses' => 'IntegralController@edit' ]);
	Route::DELETE('integral/destroy/{id}',['as' => 'admin.integral.destroy' ,'uses' => 'IntegralController@destroy' ]);
	Route::post('integral/destroy_all',['as' => 'admin.integral.destroy_all' ,'uses' => 'IntegralController@destroy_all' ]);
	Route::post('integral/store',['as' => 'admin.integral.store' ,'uses' => 'IntegralController@store' ]);

	Route::get('integral_history',['as' => 'admin.integral_history.index' ,'uses' => 'IntegralHistoryController@index' ]);
	Route::get('integral_history/create',['as' => 'admin.integral_history.create' ,'uses' => 'IntegralHistoryController@create' ]);
	Route::get('integral_history/edit/{id}',['as' => 'admin.integral_history.edit' ,'uses' => 'IntegralHistoryController@edit' ]);
	Route::DELETE('integral_history/destroy/{id}',['as' => 'admin.integral_history.destroy' ,'uses' => 'IntegralHistoryController@destroy' ]);
	Route::post('integral_history/destroy_all',['as' => 'admin.integral_history.destroy_all' ,'uses' => 'IntegralHistoryController@destroy_all' ]);
	Route::post('integral_history/store',['as' => 'admin.integral_history.store' ,'uses' => 'IntegralHistoryController@store' ]);

	Route::get('accusation',['as' => 'admin.accusation.index' ,'uses' => 'AccusationController@index' ]);
	Route::get('accusation/create',['as' => 'admin.accusation.create' ,'uses' => 'AccusationController@create' ]);
	Route::get('accusation/edit/{id}',['as' => 'admin.accusation.edit' ,'uses' => 'AccusationController@edit' ]);
	Route::DELETE('accusation/destroy/{id}',['as' => 'admin.accusation.destroy' ,'uses' => 'AccusationController@destroy' ]);
	Route::post('accusation/destroy_all',['as' => 'admin.accusation.destroy_all' ,'uses' => 'AccusationController@destroy_all' ]);
	Route::post('accusation/store',['as' => 'admin.accusation.store' ,'uses' => 'AccusationController@store' ]);

	Route::get('paper',['as' => 'admin.paper.faq' ,'uses' => 'PaperController@faq' ]);
	Route::post('paper/faq_store',['as' => 'admin.paper.faq_store' ,'uses' => 'PaperController@faq_store' ]);
	Route::get('paper/school_mission',['as' => 'admin.paper.school_mission' ,'uses' => 'PaperController@school_mission' ]);
	Route::get('paper/xh',['as' => 'admin.paper.xh' ,'uses' => 'PaperController@xh' ]);
	Route::get('paper/shop',['as' => 'admin.paper.shop' ,'uses' => 'PaperController@shop' ]);
	Route::get('paper/integral',['as' => 'admin.paper.integral' ,'uses' => 'PaperController@integral' ]);
	Route::get('paper/wallet',['as' => 'admin.paper.wallet' ,'uses' => 'PaperController@wallet' ]);

	Route::get('paper/chickenSoup',['as' => 'admin.paper.chickenSoup' ,'uses' => 'ChickenSoupController@chickenSoup' ]);
	Route::DELETE('chickenSoup/destroy/{id}',['as' => 'admin.chickenSoup.destroy' ,'uses' => 'ChickenSoupController@destroy' ]);
	Route::post('chickenSoup/destroy_all',['as' => 'admin.chickenSoup.destroy_all' ,'uses' => 'ChickenSoupController@destroy_all' ]);
	Route::post('chickenSoup/store',['as' => 'admin.chickenSoup.store' ,'uses' => 'ChickenSoupController@store' ]);
	Route::get('chickenSoup/create',['as' => 'admin.chickenSoup.create' ,'uses' => 'ChickenSoupController@create' ]);
	Route::get('chickenSoup/edit/{id}',['as' => 'admin.chickenSoup.edit' ,'uses' => 'ChickenSoupController@edit' ]);
	Route::get('chickenSoup/pass/{id}',['as' => 'admin.chickenSoup.pass' ,'uses' => 'ChickenSoupController@pass' ]);
	Route::get('chickenSoup/fail/{id}',['as' => 'admin.chickenSoup.fail' ,'uses' => 'ChickenSoupController@fail' ]);



	Route::get('association',['as' => 'admin.association.index' ,'uses' => 'AssociationController@index' ]);
	Route::get('association/create',['as' => 'admin.association.create' ,'uses' => 'AssociationController@create' ]);
	Route::get('association/edit/{id}',['as' => 'admin.association.edit' ,'uses' => 'AssociationController@edit' ]);
	Route::DELETE('association/destroy/{id}',['as' => 'admin.association.destroy' ,'uses' => 'AssociationController@destroy' ]);
	Route::post('association/destroy_all',['as' => 'admin.association.destroy_all' ,'uses' => 'AssociationController@destroy_all' ]);
	Route::post('association/store',['as' => 'admin.association.store' ,'uses' => 'AssociationController@store' ]);
	Route::get('association/sort',['as' => 'admin.association.sort' ,'uses' => 'AssociationController@sort' ]);

	Route::get('association_info',['as' => 'admin.association_info.index' ,'uses' => 'AssociationInfoController@index' ]);
	Route::get('association_info/create',['as' => 'admin.association_info.create' ,'uses' => 'AssociationInfoController@create' ]);
	Route::DELETE('association_info/destroy/{id}',['as' => 'admin.association_info.destroy' ,'uses' => 'AssociationInfoController@destroy' ]);
	Route::post('association_info/destroy_all',['as' => 'admin.association_info.destroy_all' ,'uses' => 'AssociationInfoController@destroy_all' ]);
	Route::post('association_info/store',['as' => 'admin.association_info.store' ,'uses' => 'AssociationInfoController@store' ]);
	Route::post('association_info/update',['as' => 'admin.association_info.update' ,'uses' => 'AssociationInfoController@update' ]);

	Route::get('association_activity',['as' => 'admin.association_activity.index' ,'uses' => 'AssociationActivityController@index' ]);
	Route::get('association_activity/create',['as' => 'admin.association_activity.create' ,'uses' => 'AssociationActivityController@create' ]);
	Route::DELETE('association_activity/destroy/{id}',['as' => 'admin.association_activity.destroy' ,'uses' => 'AssociationActivityController@destroy' ]);
	Route::post('association_activity/destroy_all',['as' => 'admin.association_activity.destroy_all' ,'uses' => 'AssociationActivityController@destroy_all' ]);
	Route::post('association_activity/store',['as' => 'admin.association_activity.store' ,'uses' => 'AssociationActivityController@store' ]);
	Route::post('association_activity/update',['as' => 'admin.association_activity.update' ,'uses' => 'AssociationActivityController@update' ]);

	Route::get('operateHistory',['as' => 'admin.operateHistory.index' ,'uses' => 'OperateHistoryController@index' ]);
	Route::DELETE('operateHistory/destroy/{id}',['as' => 'admin.operateHistory.destroy' ,'uses' => 'OperateHistoryController@destroy' ]);
	Route::post('operateHistory/destroy_all',['as' => 'admin.operateHistory.destroy_all' ,'uses' => 'OperateHistoryController@destroy_all' ]);

    Route::get('loss_cate/index',['as' => 'admin.loss_cate.index' ,'uses' => 'LossCategoryController@index' ]);
    Route::get('loss_cate/create',['as' => 'admin.loss_cate.create' ,'uses' => 'LossCategoryController@create' ]);
    Route::get('loss_cate/edit/{id}',['as' => 'admin.loss_cate.edit' ,'uses' => 'LossCategoryController@edit' ]);
	Route::DELETE('loss_cate/destroy/{id}',['as' => 'admin.loss_cate.destroy' ,'uses' => 'LossCategoryController@destroy' ]);
	Route::post('loss_cate/destroy_all',['as' => 'admin.loss_cate.destroy_all' ,'uses' => 'LossCategoryController@destroy_all' ]);
	Route::post('loss_cate/store',['as' => 'admin.loss_cate.store' ,'uses' => 'LossCategoryController@store' ]);
	Route::post('loss_cate/update',['as' => 'admin.loss_cate.update' ,'uses' => 'LossCategoryController@update' ]);

    Route::get('loss/index',['as' => 'admin.loss.index' ,'uses' => 'LossController@index' ]);
    Route::DELETE('loss/destroy/{id}',['as' => 'admin.loss.destroy' ,'uses' => 'LossController@destroy' ]);
    Route::post('loss/destroy_all',['as' => 'admin.loss.destroy_all' ,'uses' => 'LossController@destroy_all' ]);

	Route::get('test',['as' => 'admin.test.index' ,'uses' => 'TestController@index' ]);

	Route::get('shop/index',['as' => 'admin.shop.index' ,'uses' => 'ShopController@index' ]);
	Route::get('goods/batch',['as' => 'admin.shop.goods_batch' ,'uses' => 'ShopController@goodsBatch' ]);
	Route::post('goods/batchUpload',['as' => 'admin.shop.goods_batch_upload' ,'uses' => 'ShopController@goodsBatchUpload' ]);

	Route::get('orderInfo/index',['as' => 'admin.order_info.index','uses' => 'OrderInfoController@index']);
    Route::get('orderInfo/shopCouponCount',['as' => 'admin.order_info.shopCouponCount','uses' => 'OrderInfoController@shopCouponCount']);

	Route::post('/home/getOrderInfosCharts', 'HomeController@getOrderInfosCharts');


});


Route::get('/admin', function () {
    return view('admin.welcome');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
	Route::get('/game', 'GameController@index');
	Route::get('/game/{id}', 'GameController@game');


});
Route::post('alipay/alipayRefundNotify','AlipayController@alipayRefundNotify');


Route::group(['middleware' => ['web'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
	Route::get('authorLogin',['as' => 'admin.chickenSoup.authorLogin' ,'uses' => 'ChickenSoupController@authorLogin' ]);
	Route::post('authorPostLogin',['as' => 'admin.chickenSoup.authorPostLogin' ,'uses' => 'ChickenSoupController@authorPostLogin' ]);
	Route::get('sendChickenSoup',['as' => 'admin.chickenSoup.sendChickenSoup' ,'uses' => 'ChickenSoupController@sendChickenSoup' ]);
	Route::get('chickenSoupVerifyList/{page}',['as' => 'admin.chickenSoup.chickenSoupVerifyList' ,'uses' => 'ChickenSoupController@chickenSoupVerifyList' ]);
	Route::get('chickenSoupPreview',['as' => 'admin.chickenSoup.chickenSoupPreview' ,'uses' => 'ChickenSoupController@chickenSoupPreview' ]);
	Route::get('chickenSoup/passVerifyList',['as' => 'admin.chickenSoup.passVerifyList' ,'uses' => 'ChickenSoupController@passVerifyList' ]);
	Route::get('chickenSoup/failVerifyList',['as' => 'admin.chickenSoup.failVerifyList' ,'uses' => 'ChickenSoupController@failVerifyList' ]);
	Route::get('chickenSoup/deleteVerifyList',['as' => 'admin.chickenSoup.deleteVerifyList' ,'uses' => 'ChickenSoupController@deleteVerifyList' ]);
	Route::get('chickenSoup/myChickenSoupList/{page}',['as' => 'admin.chickenSoup.myChickenSoupList' ,'uses' => 'ChickenSoupController@myChickenSoupList' ]);
});
