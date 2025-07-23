@extends("dashboard.layouts.main")
@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

@endsection
@section("content")
    <div class="card">
        <div class="card-header">
            <h3 class="card-title col-12 mt-2 ">باقات المستخدمين</h3>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        <?php
        $edit = auth("admin")->user()->hasPermission("user_plans_update");
        ?>
        <div class="card-body">
            <table class="table" id="plansTable">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>ايام الظهور ك اعلان مميز</th>
                    <th>ظهور علي السوشيال ميديا</th>
                    <th>السعر</th>
                    @if($edit)
                        <th>تعديل</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <?php $count = 1 ?>
                @foreach($plans as $plan)
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$plan->days_num == 2 ? "يومين" : $plan->days_num . " أيام " }}</td>
                        <td>{{number_format($plan->social_media_appear)}}</td>
                        <td>{{number_format($plan->price)}}</td>
                        @if($edit)
                            <td><a href="{{route("edit.user.plans",$plan->id)}}" class="btn  btn-success">
                                    تعديل
                                    <i class="fas fa-edit"></i>
                                </a></td>
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
            $('#plansTable').DataTable({
                ordering: true, scrollX: true,
                paging: false,
                info: false,
                autoWidth: false,
                language: {
                    "search": "@lang('site.search') : ",
                    "infoEmpty": "@lang('site.emptyTable')",
                    "zeroRecords": "@lang('site.emptyTable')",
                }
            });
        });
    </script>
@endsection
