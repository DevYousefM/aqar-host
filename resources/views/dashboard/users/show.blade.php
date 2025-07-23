@extends("dashboard.layouts.main")
@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

@endsection
@section("content")
    <div class="card">
        <div
            class="d-flex justify-content-between align-items-center"
            style="padding: 0.75rem 1.25rem; color: inherit; background-color: rgba(0,0,0,.03); border-bottom: 1px solid rgba(0,0,0,.125);">
            <h5>المستخدمين</h5>
            <a href="{{route("export.users")}}" class="btn  btn-primary mb-2">تحميل ك ملف اكسل <i
                    class="fa fa-download"></i></a>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")


        <div class="card-body">
            <table class="table" id="usersTable">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الصورة</th>
                    <th>الأسم</th>
                    <th>البريد الالكتروني</th>
                    <th>رقم الهاتف</th>
                    <th>رقم ثانوي</th>
                </tr>
                </thead>
                <tbody>

                <?php $count = 1 ?>
                @foreach($users as $user)

                    <tr>
                        <td>{{$count}}</td>
                        <td><img class="rounded" width="30px"
                                 src="{{asset($user->image && $user->image !== "#" ? $user->image : "img/default.svg") }}"
                                 alt=""></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            {{str_replace(' ', '',  $user->phone)}}
                        </td>
                        <td>{{!empty($user->phone_sec) ? str_replace(' ', '',  $user->phone_sec): "غير متوفر"}}</td>
                    </tr>
                        <?php $count++ ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section("script")
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function () {
            $('#usersTable').DataTable({
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
