@extends("dashboard.layouts.main")

@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section("content")
    <div class="card">
        <div class="card-header d-flex">
            <h3 class="card-title mt-2">طلبات الخدمات المنفصلة</h3>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        @php
            $edit = auth("admin")->user()->hasPermission("single_services_requests_update");
            $delete = auth("admin")->user()->hasPermission("single_services_requests_delete");
        @endphp

        <div class="card-body">
            @if(count($single_services) > 0)

                <table class="table table-bordered" id="serv">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>الخدمة</th>
                        <th>سعر الخدمة</th>
                        <th>هاتف المستخدم</th>
                        <th>تاريخ الطلب</th>
                        @if($edit || $delete)
                            <th>قبول/حذف</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1 ?>
                    @foreach($single_services as $single_service)
                        <tr>
                            <td>{{$count}}</td>
                            <td>@lang("site.".$single_service->single_service->name)</td>
                            <td>{{$single_service->single_service->price}} جنية</td>
                            <td>{{$single_service->user->phone}}</td>
                            <td>
                                <div class="d-flex flex-row-reverse justify-content-end">
                                    <span>{{$single_service->created_at->format('d')}}</span><span
                                        class="mx-1">{{$single_service->created_at->format('M')}}</span><span>{{$single_service->created_at->format('Y')}}</span>
                                </div>
                            </td>
                            <td class="d-flex">
                                @if($edit)
                                    <form action="{{route("accept.single.service.requests",$single_service->id)}}"
                                          method="post">
                                        @csrf
                                        @method("post")
                                        <button type="submit" class="btn btn-success ">
                                            قبول
                                        </button>
                                    </form>
                                @endif
                                @if($delete)
                                    <form action="{{route("reject.single.service.requests",$single_service->id)}}"
                                          method="post">
                                        @csrf
                                        @method("post")
                                        <button type="submit" class="btn btn-danger ">
                                            حذف
                                        </button>
                                    </form>
                                @endif
                            </td>

                        </tr>
                            <?php $count++ ?>

                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-dark text-center">لا توجد طلبات</div>
            @endif

        </div>
        {{ $single_services->links('dashboard.paginate.paginate') }}
    </div>
@endsection
@section("script")
    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function () {
            $('#serv').DataTable({
                ordering: true,
                scrollX: true,
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
