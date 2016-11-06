@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>ϵͳ����</span></h2>
        {!! Breadcrumbs::render('admin-role-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="{{ route('admin.role.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="����"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="ɾ��" data-href="{{ route('admin.role.destroy.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">��Ϸ�б�</h5>
                        @include('admin._partials.show-page-status',['result'=>$roles])

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
                                    <th>��ʶ</th>
                                    <th>��ɫ��</th>
                                    <th>˵��</th>
                                    <th>����ʱ��</th>
                                    <th>����</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $role->id }}"
                                                       value="{{ $role->id }}" class="selectall-item"/>
                                                <label for="id-{{ $role->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->display_name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>{{ $role->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.role.edit',['id'=>$role->id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> �༭</a>
                                            <a href="{{ route('admin.role.permissions',['id'=>$role->id]) }}"
                                            class="btn btn-info btn-xs role-permissions"><i class="fa fa-wrench"></i> Ȩ��</a>
                                            <a class="btn btn-danger btn-xs role-delete"
                                               data-href="{{ route('admin.role.destroy',['id'=>$role->id]) }}">
                                                <i class="fa fa-trash-o"></i> ɾ��</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $roles->render() !!}

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
        $(".role-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: 'ȷ��ɾ����ɫ?',
                href: $(this).data('href'),
                successTitle: '��ɫɾ���ɹ�'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: 'ȷ��ɾ��ѡ�еĽ�ɫ?',
                href: $(this).data('href'),
                successTitle: '��ɫɾ���ɹ�'
            });
        });
    </script>

@endsection
