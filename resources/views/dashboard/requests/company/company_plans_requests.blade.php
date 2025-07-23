@extends("dashboard.layouts.main")
@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section("content")
    <div class="card " id="arti">
        <div class="card-header">
            <h3 class="card-title col-12 mt-2">طلبات اشتراك الشركات (الجديدة/قيد المراجعة)</h3>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        @php
            $edit = auth("admin")->user()->hasPermission("company_plans_requests_update");
        @endphp
        <div class="card-body">
            <table class="table table-bordered" id="company_plans_requests">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الباقة</th>
                    <th>سعر الباقة</th>
                    <th>اسم الشركة</th>
                    <th>رقم الهاتف</th>
                    <th>البريد الاكتروني</th>
                    <th>تاريخ الطلب</th>
                    @if($edit )
                        <th>تفعيل/حذف</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <?php $count = 1 ?>
                @foreach($company_plans_requests as $request)
                    <tr>
                        <td>{{$count}}</td>
                        <td>
                            @lang("site.".$request->company_plan->name)
                        </td>
                        <td>
                            {{$request->company_plan->price}}
                        </td>
                        <td>
                            {{$request->user->company_name}}
                        </td>
                        <td>
                            {{$request->user->phone}}
                        </td>
                        <td>
                            {{$request->user->email}}
                        </td>
                        <td>
                            <div class="d-flex flex-row-reverse justify-content-end">
                                <span>
                                    {{$request->created_at->format('d')}}
                                </span>
                                <span class="mx-1">
                                    {{$request->created_at->format('M')}}
                                </span>
                                <span>
                                    {{$request->created_at->format('Y')}}
                                </span>
                            </div>
                        </td>
                        @if($edit)
                            <td>
                                <div class="d-flex">
                                    <form action="{{route("activate.company.plan",$request->id)}}" method="post">
                                        @csrf
                                        @method("post")
                                        <button type="submit" class="btn btn-success btn-sm">
                                            تفعيل الباقة
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{route("reject.company.request",$request->id)}}" method="post"
                                          class="ml-1">
                                        @csrf
                                        @method("post")
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            حذف الطلب
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        @endif

                    </tr>
                        <?php $count++ ?>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $company_plans_requests->links('dashboard.paginate.paginate') }}
    </div>
@endsection
@section("script")
    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function () {
            $('#company_plans_requests').DataTable({
                ordering: true, scrollX: true,
                paging: false,
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
