@extends("dashboard.layouts.main")
@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section("content")
    <div class="card " id="arti">
        <div class="card-header">
            <h3 class="card-title col-12 mt-2">طلبات ترويج المستخدمين (الجديدة/قيد المراجعة)</h3>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        @php
            $edit = auth("admin")->user()->hasPermission("user_plans_requests_update");
            $delete = auth("admin")->user()->hasPermission("user_plans_requests_delete");
        @endphp
        <div class="card-body">
            <table class="table table-bordered" id="user_plans_requests">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الباقة</th>
                    <th>بيانات العقار</th>
                    <th>تاريخ الطلب</th>
                    <th> انتهاء الاشتراك</th>
                    @if($edit || $delete)
                        <th>قبول/رفض</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <?php $count = 1 ?>
                @foreach($user_plans_requests as $request)
                    <tr>
                        <td>{{$count}}</td>
                        <td>
                            <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target="#plan-{{$count}}">
                                عرض
                            </button>
                        </td>
                        <td>
                            <a href="{{route("property.show",$request->property->id)}}">
                                <button type="button" class="btn btn-info">
                                    عرض العقار
                                </button>
                            </a>
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
                        <td>
                                <?php
                                $expire_date = \Carbon\Carbon::now()->addDays($request->user_plan->days_num);
                                ?>
                            <div class="d-flex flex-row-reverse justify-content-end">
                                <span>
                                    {{$expire_date->format('d')}}
                                </span>
                                <span class="mx-1">
                                    {{$expire_date->format('M')}}
                                </span>
                                <span>
                                    {{$expire_date->format('Y')}}
                                </span>
                            </div>
                        </td>


                        <td>
                            <div class="d-flex">
                                @if($edit)
                                    <form action="{{route("accept.user.plans.requests",$request->id)}}" method="post">
                                        @csrf
                                        @method("post")
                                        <button type="submit" class="btn btn-success btn-sm">
                                            قبول
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </form>
                                @endif
                                @if($delete)
                                    <form action="{{route("delete.user.plans.sub",$request->id)}}" method="post"
                                          class="ml-1">
                                        @csrf
                                        @method("post")
                                        <button type="submit" class="btn btn-danger btn-sm">

                                            رفض
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>

                    </tr>
                    <div class="modal fade" id="plan-{{$count}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="bg-white rounded-lg shadow-md px-3 py-4"
                                         style="margin: 8px">
                                        <div class="text-left mb-4">
                                            <h5 class="font-bold">تفاصيل الباقة</h5>
                                            <ul class="ml-4 mt-2" style="list-style: none">
                                                <li>- ظهور الاعلان
                                                    لمدة {{$request->user_plan->days_num  == 2 ? "يومين": $request->user_plan->days_num . " أيام "}}
                                                    كإعلان مميز
                                                </li>
                                                <br>
                                                <li>-
                                                    {{number_format($request->user_plan->social_media_appear)}}
                                                    ظهور على
                                                    السوشيال ميديا في المنطقة المستهدفة
                                                </li>
                                            </ul>
                                        </div>
                                        <h5 class="text-gray-600 font-semibold">السعر : {{$request->user_plan->price}}
                                            جنية </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="brief-{{$count}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>{{$request->brief}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="body-{{$count}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>{!! $request->body !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php $count++ ?>

                @endforeach
                </tbody>
            </table>
        </div>
        {{ $user_plans_requests->links('dashboard.paginate.paginate') }}
    </div>
@endsection
@section("script")
    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function () {
            $('#user_plans_requests').DataTable({
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
