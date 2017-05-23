@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-game-user_prizes') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5 class="subtitle mb5">获奖列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$user_prizes])

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                    <th>用户名称</th>
                                    <th>奖品名称</th>
                                    <th>获得时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user_prizes as $user_prize)
                                    <tr>
                                        <td>{{ $user_prize->nickname }}</td>
                                        <td>{{ $user_prize->prize_name }}</td>
                                        <td>{{ $user_prize->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $user_prizes->appends(['id' => $game_id])->render() !!}

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
