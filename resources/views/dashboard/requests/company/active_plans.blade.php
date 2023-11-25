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
    <div class="card " id="arti">
        <div class="card-header">
            <h3 class="card-title col-12 mt-2">الباقات المفعلة</h3>
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
                        <th>التعامل مع الاشتراك</th>
                        <th>تعطيل</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <?php $count = 1 ?>
                @foreach($active_plans as $request)
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
                                <button type="submit" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#dealing-{{$count}}">
                                    <i class="fas fa-fingerprint " style="font-size: 20px;padding-top: 5px"></i>
                                </button>
                            </td>
                            <td>
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
                    @if($edit)

                        <div class="modal fade " id="dealing-{{$count}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">اسم الشركة: {{$request->user->company_name}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div class="grid-container">
                                            <div class="grid-item">
                                            <span>
                                            اعلانات الفيسبوك المتبقية
                                            </span>
                                            </div>
                                            <div class="grid-item">
                                                @if($request->remaining_facebook_ads == 0)
                                                    <button type="submit" class="btn btn-outline-success btn-sm">
                                                <span style="font-size:20px">
                                                    {{$request->remaining_facebook_ads}}
                                                </span>
                                                        <i class="fas fa-arrow-down "
                                                           style="font-size: 20px;padding-top: 5px"></i>
                                                    </button>
                                                @else
                                                    <form
                                                        action="{{route("update.resources",["id"=>$request->id,"key"=>"remaining_facebook_ads"])}}"
                                                        method="post">
                                                        @csrf
                                                        @method("post")
                                                        <button type="submit" class="btn btn-outline-success btn-sm">
                                                <span style="font-size:20px">
                                                    {{$request->remaining_facebook_ads}}
                                                </span>
                                                            <i class="fas fa-arrow-down "
                                                               style="font-size: 20px;padding-top: 5px"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="grid-container">
                                            <div class="grid-item">
                                            <span>
                                            اعلانات اليوتيوب المتبقية
                                            </span>
                                            </div>
                                            <div class="grid-item">

                                                @if($request->remaining_youtube_ads == 0)
                                                    <button type="submit" class="btn btn-outline-success btn-sm">
                                                <span style="font-size:20px">
                                                    {{$request->remaining_youtube_ads}}
                                                </span>
                                                        <i class="fas fa-arrow-down "
                                                           style="font-size: 20px;padding-top: 5px"></i>
                                                    </button>
                                                @else
                                                    <form
                                                        action="{{route("update.resources",["id"=>$request->id,"key"=>"remaining_youtube_ads"])}}"
                                                        method="post">
                                                        @csrf
                                                        @method("post")
                                                        <button type="submit" class="btn btn-outline-success btn-sm">
                                                <span style="font-size:20px">
                                                    {{$request->remaining_youtube_ads}}
                                                </span>
                                                            <i class="fas fa-arrow-down "
                                                               style="font-size: 20px;padding-top: 5px"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="grid-container">
                                            <div class="grid-item">
                                            <span>
                                            اعلانات جوجل المتبقية
                                            </span>
                                            </div>
                                            <div class="grid-item">
                                                @if($request->remaining_google_ads == 0)
                                                    <button type="submit" class="btn btn-outline-success btn-sm">
                                                <span style="font-size:20px">
                                                    {{$request->remaining_google_ads}}
                                                </span>
                                                        <i class="fas fa-arrow-down "
                                                           style="font-size: 20px;padding-top: 5px"></i>
                                                    </button>
                                                @else
                                                    <form
                                                        action="{{route("update.resources",["id"=>$request->id,"key"=>"remaining_google_ads"])}}"
                                                        method="post">
                                                        @csrf
                                                        @method("post")
                                                        <button type="submit" class="btn btn-outline-success btn-sm">
                                                <span style="font-size:20px">
                                                    {{$request->remaining_google_ads}}
                                                </span>
                                                            <i class="fas fa-arrow-down "
                                                               style="font-size: 20px;padding-top: 5px"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                        <?php $count++ ?>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $active_plans->links('dashboard.paginate.paginate') }}
    </div>
@endsection
@section("script")
    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function () {
            $('#active_plans').DataTable({
                ordering: true, scrollX: true,
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
