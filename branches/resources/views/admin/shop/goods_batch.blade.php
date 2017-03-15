@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-shop-goodsBatch') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">?</a>
                        </div>
                        <h4 class="panel-title">批量添加</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.shop.goods_batch_upload') }}"  enctype="multipart/form-data" method="POST">

                        <div class="panel-body panel-body-nopadding">
                            
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">选择商店</label>
                                <div class="col-sm-6">
	                                <select name="shop_id" class="select form-control" onchange="javascrupt:select_shop();" id="shop_id">
		                                @foreach($shops as $key => $shop)
		                                <option value="{{$shop->shop_id}}" @if($shop_id == $shop->shop_id) selected @endif>{{$shop->shop_name}}</option>
		                                @endforeach
	                                </select>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">选择分类</label>
                                <div class="col-sm-6">
									<select name="cat_id" class="select form-control">
		                                @foreach($cats as $key => $cat)
		                                <option value="{{$cat->cat_id}}">{{$cat->cat_name}}</option>
		                                @endforeach
	                                </select>
                                </div>
                            </div>   
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">选择excel文件</label>
                                <div class="col-sm-6">
                                   <input type="file"  data-toggle="tooltip" name="excel" data-trigger="hover" class="form-control tooltips" >
                                </div>
                            </div>
                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <input type="submit" value="保存" class="btn btn-primary" id="submit_btn">
                                    &nbsp;
                                    <button class="btn btn-default">取消</button>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
    <script type="text/javascript">
    	function select_shop() {
    		var shop_id = $("#shop_id").val();
    		window.location.href = "{{route('admin.shop.goods_batch',['shop_id' => $shop->shop_id])}}"+ '?shop_id='+shop_id;
    		return true;
    	}
    </script>
@endsection
