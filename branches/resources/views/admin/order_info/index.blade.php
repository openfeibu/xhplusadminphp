@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-orderInfo-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">
	                    
                        <h5 class="subtitle mb5">订单列表</h5>
                        
						<form action="{{route('admin.user.searchUser')}}">
                            <div class="col-md-5">
                                <input type="text" name="searchUser" placeholder="" style="" class="form-control" >
                                
                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="btn btn-primary" name="submit" value="搜索" style="height:40px">
                            </div>
                        </form>
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
                                    <th>店铺</th>
                                    <th>购买用户</th>
                                    <th>收货人</th>
                                    <th>收货地址</th>
                                    <th>电话</th>
                                    <th>总额</th>  
                                    <th>支付方式</th>   
                                    <th>订单状态</th>                   
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($order_infos as $order_info)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $order_info->order_id }}"
                                                       value="{{ $order_info->order_id }}" class="selectall-item"/>
                                                <label for="id-{{ $order_info->order_id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $order_info->order_id }}</td>
                                        <td>{{ $order_info->order_sn }}</td>
                                        <td>{{ $order_info->shop_name }}</td>
                                        <td>{{ $order_info->nickname }}</td>
                                        <td>{{ $order_info->consignee }}</td>
                                        <td>{{ $order_info->address }}</td>
                                        <td>{{ $order_info->mobile }}</td>
                                        <td>{{ $order_info->total_fee}}</td>
                                        <td>{{ $order_info->pay_name}}</td>
                                        <td>{{ $order_info->status_desc}}</td>
                                        <td>{{ $order_info->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.shop.edit',['id'=>$order_info->order_id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 查看</a>   
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
						@include('admin._partials.show-page-status',['result'=>$order_infos])
                        {!! $order_infos->render() !!}

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

    </script>

@endsection
