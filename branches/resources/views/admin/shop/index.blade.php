@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-shop-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="{{ route('admin.shop.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.shop.destroy.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">店铺列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$shops])

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
                                    <th>店名</th>
                                    <th>店长</th>
                                    <th>店铺状态</th>
                                    <th>店铺图片</th>
                                    <th>描述</th>
                                    <th>收藏量</th>
                                    <th>浏览量</th>     
                                    <th>商店总收入</th>   
                                    <th>商店销量</th>                           
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($shops as $shop)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $shop->shop_id }}"
                                                       value="{{ $shop->shop_id }}" class="selectall-item"/>
                                                <label for="id-{{ $shop->shop_id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $shop->shop_id }}</td>
                                        <td>{{ $shop->shop_name }}（{{ trans("common.shop_type.$shop->shop_type") }}）</td>
                                        <td>{{ $shop->nickname }}</td>
                                        <td>{{ trans("common.shop_status.$shop->shop_status") }}</td>
                                        <td>{{ $shop->shop_img }}</td>
                                        <td>{{ $shop->description }}</td>
                                        <td>{{ $shop->shop_favorite_count}}</td>
                                        <td>{{ $shop->shop_click_count}}</td>
                                        <td>{{ $shop->income}}</td>
                                        <td>{{ $shop->sale_count}}</td>
                                        <td>{{ $shop->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.shop.edit',['id'=>$shop->shop_id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>   
                                             <a href="{{ route('admin.shop.goods_batch',['shop_id'=>$shop->shop_id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 批量添加商品</a>                                       
                                            <a class="btn btn-danger btn-xs shop-delete"
                                               data-href="{{ route('admin.shop.destroy',['id'=>$shop->shop_id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $shops->render() !!}

                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script type="text/javascript">
        $(".shop-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除店铺?',
                href: $(this).data('href'),
                successTitle: '店铺删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的店铺?',
                href: $(this).data('href'),
                successTitle: '店铺删除成功'
            });
        });
    </script>

@endsection
