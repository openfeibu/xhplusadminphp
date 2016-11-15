@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-applyWallet-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <!--<a href="{{ route('admin.applyWallet.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.applyWallet.destroy.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>-->
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">提现列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$applyWallets])

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
                                    <th>用户昵称</th>
                                    <th>用户姓名</th>
                                    <th>交易订单号</th>
                                    <th>支付宝账号</th> 
									<th>支付宝姓名</th>								
									<th>提现金额</th>  
									<!--<th>已收手续费</th>  -->
									<th>提现状态</th>  
									<th>备注</th>  
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($applyWallets as $applyWallet)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $applyWallet->apply_id }}"
                                                       value="{{ $applyWallet->apply_id }}" class="selectall-item"/>
                                                <label for="id-{{ $applyWallet->apply_id }}"></label>
                                            </div>
                                        </td>
                                         <td>{{ $applyWallet->apply_id }}</td>
                                         <td><a href="{{ route('admin.user.edit',$applyWallet->uid) }}" target="_blank" >{{ $applyWallet->nickname }}</a> <a href="{{ route('admin.user.wallet_account',$applyWallet->uid) }}" target="_blank" title="点击查看钱包明细">（钱包明细）</a></td>
                                         <td>{{ $applyWallet->realname }}</td>
										 <td>{{ $applyWallet->out_trade_no }}</td>
										 <td>{{ $applyWallet->alipay }}</td>
										 <td>{{ $applyWallet->alipay_name }}</td>	
										 <td>{{ $applyWallet->fee }}</td>
										 <!--<td>{{ $applyWallet->service_fee }}</td>-->
										 <td>{{ trans("common.apply_wallet_status.$applyWallet->status") }}</td>
										 <td>{{ $applyWallet->description }}</td>
										 <td>{{ $applyWallet->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.applyWallet.edit',['id'=>$applyWallet->apply_id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <!--<a class="btn btn-danger btn-xs applyWallet-delete"
                                               data-href="{{ route('admin.applyWallet.destroy',['id'=>$applyWallet->apply_id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>-->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $applyWallets->render() !!}

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
        $(".applyWallet-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除交易记录?',
                href: $(this).data('href'),
                successTitle: '交易记录删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的交易记录?',
                href: $(this).data('href'),
                successTitle: '交易记录删除成功'
            });
        });
    </script>

@endsection
