@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-game-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">


                        <h5 class="subtitle mb5">游戏列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$games])

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
                                    <th>ID</th>
                                    <th>活动标识</th>
                                    <th>活动名称</th>
                                    <th>活动状态</th>
                                    <th>活动开始时间</th>
                                    <th>活动结束时间</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($games as $game)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $game->id }}"
                                                       value="{{ $game->id }}" class="selectall-item"/>
                                                <label for="id-{{ $game->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $game->id }}</td>
                                        <td>{{ $game->name }}</td>
                                        <td>{{ $game->title }}</td>
                                        <td>{{ trans('common.open_status.'.$game->status)}}</td>
                                        <td>{{ $game->starttime }}</td>
                                        <td>{{ $game->endtime }}</td>
                                        <td>{{ $game->created_at }}</td>
                                        <td>
                                            @if($game->name == 'coupon')
                                            <a href="{{ route('admin.game.prizes',['id'=>$game->id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 设置奖项</a>
                                            <a href="{{ route('admin.game.user_prizes',['id'=>$game->id]) }}"
                                              class="btn btn-white btn-xs"><i class="fa fa-pencil"></i>获奖用户</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $games->render() !!}

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
