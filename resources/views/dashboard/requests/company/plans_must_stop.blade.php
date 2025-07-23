@extends("dashboard.layouts.main")
@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section("content")
    <div class="card " id="arti">
        <div class="card-header">
            <h3 class="card-title col-12 mt-2">باقات ينبغي تعطيلها لأنقضاء المدة</h3>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        @php
            $edit = auth("admin")->user()->hasPermission("company_plans_requests_update");
        @endphp
        <div class="card-body">
            <table class="table" id="active_plans">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الباقة</th>
                    <th>اسم الشركة</th>
                    <th>رقم الهاتف</th>
                    <th>تاريخ التفعيل</th>
                    <th>تاريخ الانتهاء</th>
                    @if($edit)
                        <th>تعطيل</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <?php $count = 1 ?>
                @foreach($plans as $request)
                    <tr>
                        <td>{{$count}}</td>
                        <td>
                            @lang("site.".$request->company_plan->name)
                        </td>
                        <td>
                            {{$request->user->company_name}}
                        </td>
                        <td>
                            {{$request->user->phone}}
                        </td>
                        <td>
                                <?php
                                $start_date = \Carbon\Carbon::parse($request->start_date);
                                ?>
                            <div class="d-flex flex-row-reverse justify-content-end">
                                <span>
                                    {{$start_date->format('d')}}
                                </span>
                                <span class="mx-1">
                                    {{$start_date->format('M')}}
                                </span>
                                <span>
                                    {{$start_date->format('Y')}}
                                </span>
                            </div>
                        </td>
                        <td>
                                <?php
                                $end_date = \Carbon\Carbon::parse($request->end_date);
                                ?>
                            <div class="d-flex flex-row-reverse justify-content-end">
                                <span>
                                    {{$end_date->format('d')}}
                                </span>
                                <span class="mx-1">
                                    {{$end_date->format('M')}}
                                </span>
                                <span>
                                    {{$end_date->format('Y')}}
                                </span>
                            </div>
                        </td>
                        @if($edit)
                            <td class="d-flex justify-content-center">
                                <form action="{{route("stop.company.plan",$request->id)}}" method="post">
                                    @csrf
                                    @method("post")
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        ايقاف الباقة
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                        <?php $count++ ?>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $plans->links('dashboard.paginate.paginate') }}
    </div>
@endsection
@section("script")
    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function () {
            $('#active_plans').DataTable({
                ordering: true,
                scrollX: true,
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
