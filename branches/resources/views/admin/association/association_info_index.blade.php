@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-association-association_info_index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="{{ route('admin.association_info.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.association_info.destroy_all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">社团列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$informations])

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
                                    <th>资讯标题</th>
									<th>资讯内容</th>  
                                    <th>阅读数量</th>   
                                    <th>资讯图片</th>                       
                                    <th>提交时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($informations as $information)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $information->iid }}"
                                                       value="{{ $information->iid }}" class="selectall-item"/>
                                                <label for="id-{{ $information->iid }}"></label>
                                            </div>
                                        </td>
                                    <form action="{{ route('admin.association_info.update') }} " method="post">
                                            <td>
                                                <input type="text" value="{{ $information->iid }}"   readonly="readonly" name="iid"  style="border:0px;width:30px">
                                            </td>

    										<td>{{ $information->aname }}</td>
                                            <td>{{ $information->nickname }}</td>
                                            <td>
                                        <textarea name="title" cols=40 rows=4  ondblclick="change_title()" readonly="readonly" id="title" style="border:0px;height:80px;">
                                        {{ $information->title }}
                                        </textarea>

                                            </td>
                                            <td>
                                        <textarea name="content" cols=40 rows=4  ondblclick="change_content()" readonly="readonly" id="content"  style="border:0px;height:80px;width:250px;">
                                        {{ $information->content }}
                                        </textarea>
                                            </td>
                                            <td>{{ $information->view_num }}</td>
                                            <td>
                                                <a href="{{ $information->img_url }}" target="_blank"><img src="{{ $information->img_url }}" alt="" style="width:80px;height:80px;"></a>
                                            </td>
                                            <td>{{ $information->created_at }}</td>
                                            <td style="width:150px">     
                                                <input type="submit" value="确认修改" class="btn btn-default btn-xs">                              
                                                <a class="btn btn-danger btn-xs realname-delete"
                                                   data-href="{{ route('admin.association_info.destroy',['id'=>$information->iid]) }}">
                                                    <i class="fa fa-trash-o"></i> 删除</a>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
		
                                </tbody>
                            </table>
                        </div>

                        {!! $informations->render() !!}

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
        $(".realname-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定移除?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定将选中的社团资讯移除?',
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
    </script>

@endsection
