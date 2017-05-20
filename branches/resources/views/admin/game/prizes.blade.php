@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-game-prizes') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">编辑用户</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.game.prizes_runedit') }}" method="POST">

                        <div class="panel-body panel-body-nopadding">
                            @foreach($prizes as $prize)
                            <div class="form-group">
                                <label class="col-sm-3 control-label">{{ $prize->price_desc }}<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type='hidden' name="prize_id[]" value="{{ $prize->prize_id }}"/>
                                    <input type="text"  data-toggle="tooltip" name="prize_value[]"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{ $prize->prize_value }}">
                                </div>
                            </div>
                            @endforeach

                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection
