@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-orderInfo-couponCount') !!}
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
                                    <th>店铺ID</th>
                                    <th>店铺名称</th>
                                    <th>商品总额</th>
                                    <th>优惠券总额</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($shop_coupon_count as $coupon)
                                    <tr>
                                        <td>{{ $coupon->shop_id }}</td>
                                        <td>{{ $coupon->shop_name }}</td>
                                        <td>{{ $coupon->goods_amount_count }}</td>
                                        <td>{{ $coupon->price_count }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
						@include('admin._partials.show-page-status',['result'=>$shop_coupon_count])
                        {!! $shop_coupon_count->render() !!}

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
