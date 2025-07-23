@extends("dashboard.layouts.main")
@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <style>
        .grid-container {
            margin-bottom: 5px;
            display: grid;
            grid-template-columns: 2fr 2fr;
            gap: 10px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }

        .grid-item {
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #fff;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

    </style>
@endsection
@section("content")
    <div class="card">
        <div class="card-header">
            <h3 class="card-title col-12 mt-2">المسئولين</h3>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        @php
            $edit = auth("admin")->user()->hasPermission("admins_update");
            $delete = auth("admin")->user()->hasPermission("admins_delete");
            $create = auth("admin")->user()->hasPermission("admins_create");
        @endphp

        <div class="card-body" style="overflow: auto;">
            @if($create )
                <a href="{{route("admin.register")}}" style="float: left" class="btn  btn-primary mb-2">أضافة مسئول <i
                        class="fa fa-plus"></i></a>
            @endif
            <table class="table table-bordered" id="admins">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الأسم</th>
                    <th>البريد الالكتروني</th>
                    <th>الصلاحيات</th>
                    @if($edit || $delete)
                        <th>تعديل/حذف</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <?php $count = 1 ?>
                @foreach($admins as $admin)
                    @if($admin->id !== auth("admin")->user()->id)

                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->email}}</td>
                            <td>
                                <button type="submit" class="btn btn-success " data-toggle="modal"
                                        data-target="#permissions-{{$count}}">
                                    الصلاحيات
                                </button>
                            </td>
                            @if($edit || $delete)
                                <td>
                                    @if($edit)
                                        <a href="{{route("admin.edit",$admin->id)}}" class="btn  btn-success">
                                            تعديل
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                    @if($delete)
                                        <a href="{{route("admin.delete",$admin->id)}}" class="btn  btn-danger">
                                            حذف
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endif
                    <div class="modal fade " id="permissions-{{$count}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">صلاحيات المسسئول: {{$admin->name}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body ">
                                    <div class="grid-container">
                                            <?php
                                            $data = $admin->allPermissions();
                                            $per = null;
                                            $name = null;
                                            ?>
                                        @foreach($data as $i)
                                            @php
                                                $pieces =  explode(" " , str_replace("_" , " " , $i->name));
                                                $per = array_pop($pieces);
                                                $all = str_replace("_" , " " , $i->name);
                                                $name = str_replace(" " , "_" , preg_replace('/\W\w+\s*(\W*)$/', '$1', $all));
                                            @endphp
                                            <div class='grid-item'>@lang( "site." .$per) @lang( "site." .$name) </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php $count++ ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section("script")
    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function () {
            $('#admins').DataTable({
                ordering: true,
                paging: false,
                info: false,
                scrollX: true,
                language: {
                    "search": "@lang('site.search') : ",
                    "infoEmpty": "@lang('site.emptyTable')",
                    "zeroRecords": "@lang('site.emptyTable')",
                }
            });
        });
    </script>
@endsection
