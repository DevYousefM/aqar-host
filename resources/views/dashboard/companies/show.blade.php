@extends("dashboard.layouts.main")
@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section("content")
    <div class="card">
        <div
            class="d-flex justify-content-between align-items-center"
            style="padding: 0.75rem 1.25rem; color: inherit; background-color: rgba(0,0,0,.03); border-bottom: 1px solid rgba(0,0,0,.125);">
            <h5>حسابات الشركات</h5>
            <a href="{{route("export.companies")}}" class="btn  btn-primary mb-2">تحميل ك ملف اكسل <i
                    class="fa fa-download"></i></a>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        @php
            $edit = auth("admin")->user()->hasPermission("companies_update");
        @endphp
        <div class="card-body">
            <table class="table table-bordered" id="companies">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الصورة</th>
                    <th>اسم الحساب</th>
                    <th>اسم الشركة</th>
                    <th>نوع الشركة</th>
                    <th>البريد الالكتروني للشركة</th>
                    <th>رقم هاتف الشركة</th>
                    @if($edit)
                        <th>اهم الشركات</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <?php $count = 1 ?>
                @foreach($companies as $com)
                    <tr>
                        <td>{{$count}}</td>
                        <td><img class="rounded" width="30px"
                                 src="{{asset($com->image && $com->image !== "#" ? $com->image : "img/default.svg") }}"
                                 alt=""></td>
                        <td>{{$com->name}}</td>
                        <td>{{$com->company_name}}</td>
                        <td>{{$com->company_type}}</td>
                        <td>{{$com->email}}</td>
                        <td>{{$com->phone}}</td>

                        @if($edit)

                            <td>
                                @if($com->is_important)
                                    <form action="{{route("make.un_important",$com->id)}}" method="get">
                                        @csrf
                                        @method("get")
                                        <button type="submit" class="btn btn-block btn-outline-primary btn-sm">ازالة
                                        </button>
                                    </form>
                                @else
                                    <form action="{{route("make.important",$com->id)}}" method="post">
                                        @csrf
                                        @method("get")
                                        <button type="submit" class="btn btn-block btn-primary">أضافة</button>
                                    </form>
                                @endif
                            </td>
                        @endif

                    </tr>
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
            $('#companies').DataTable({
                scrollX: true,
                info: false,
                language: {
                    "search": "@lang('site.search') : ",
                    "infoEmpty": "@lang('site.emptyTable')",
                    "zeroRecords": "@lang('site.emptyTable')",
                }
            });
        });
    </script>
@endsection
