@extends('layouts.admin-app')

@section('content')
<style type="text/css">
${demo.css}
</style>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
        </div>
    </div>
    <div class="contentpanel">
		<div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{ $data['order_this_week_count'] }}<sup style="font-size: 20px">单</sup></h3>
                  <p>本周任务已完成量</p>
                </div>
                <div class="icon">
                  <i class="ion ion-chatboxes"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{ $data['order_info_this_week_count'] }}<sup style="font-size: 20px">单</sup></h3>
                  <p>本周商店交易成功单</p>
                </div>
                <div class="icon">
                  <i class="ion ion-document"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{ $data['new_user_this_week_count'] }}<sup style="font-size: 20px">人</sup></h3>
                  <p>本周新增注册用户</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{ $data['active_user_this_week_count'] }}<sup style="font-size: 20px">人</sup></h3>
                  <p>本周活跃用户量</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
        </div>

		<div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{ $data['order_this_month_count'] }}<sup style="font-size: 20px">单</sup></h3>
                  <p>本月任务已完成量</p>
                </div>
                <div class="icon">
                  <i class="ion ion-chatboxes"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{ $data['order_info_this_month_count'] }}<sup style="font-size: 20px">单</sup></h3>
                  <p>本月商店交易成功单</p>
                </div>
                <div class="icon">
                  <i class="ion ion-document"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{ $data['new_user_this_month_count'] }}<sup style="font-size: 20px">人</sup></h3>
                  <p>本月新增注册用户</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{ $data['active_user_this_month_count'] }}<sup style="font-size: 20px">人</sup></h3>
                  <p>本月活跃用户量</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
        </div>


		<div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{ $data['wallet'] }}<sup style="font-size: 20px">元</sup></h3>
                  <p>钱包总额</p>
                </div>
                <div class="icon">
                  <i class="ion ion-chatboxes"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{ $data['service_fee'] }}<sup style="font-size: 20px">元</sup></h3>
                  <p>已收服务费</p>
                </div>
                <div class="icon">
                  <i class="ion ion-document"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{ $data['shop_trade'] }}<sup style="font-size: 20px">元</sup></h3>
                  <p>商店成功交易总额</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
        </div>
		<div class="row">
			<div id="container" style="min-width:400px;height:400px">

			</div>
			<div class="message"></div>
		</div>
    </div>


@endsection


    <!-- contentpanel -->
@section('javascript')
@parent
<script type="text/javascript">
//定义一个Highcharts的变量，初始值为null
var oChart = null;

//定义oChart的布局环境
//布局环境组成：X轴、Y轴、数据显示、图标标题
var oOptions = {

    //设置图表关联显示块和图形样式
    chart: {
        renderTo: 'container',  //设置显示的页面块
        // type:'line'                //设置显示的方式
        type: 'column'
    },

    //图标标题
    title: {
        text: '图表展示范例'
        //text: null, //设置null则不显示标题
    },

    //x轴
    xAxis: {
        title: {
            text: 'X 轴 标 题'
        },
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },

    //y轴
    yAxis: {
        title: { text: 'Y 轴 标 题' }
    },
     //数据列
    //数据列
    series: []

};

$(document).ready(function(){
    oChart = new Highcharts.Chart(oOptions);
    //异步动态加载数据列
    LoadSerie_Ajax();
});

//异步读取数据并加载到图表
function LoadSerie_Ajax() {
        oChart.showLoading();
        $.ajax({
            url : '/admin/home/getOrderInfosCharts',
            type : 'POST',
            dataType : 'json',
            contentType: "application/x-www-form-urlencoded; charset=utf-8",
            success : function(rntData){
                var oSeries = { };
				for(var p in rntData){//遍历json对象的每个key/value对,p为key
					oSeries.name = rntData[p].name;
					oSeries.data = rntData[p].data;
					oChart.addSeries(oSeries);
				}
            }
        });
		oChart.hideLoading();

}
</script>
@endsection
