@extends("dashboard.layouts.main")
@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

@endsection
@section("content")
    <div class="card">
        <div class="card-header">
            <h3 class="card-title col-12 mt-2 ">باقات الشركات</h3>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        <?php
        $edit = auth("admin")->user()->hasPermission("company_plans_update");
        ?>
        
        <div class="card-body">
            <a href="{{route("create.company.plans")}}" class="btn  btn-primary mb-2">أضافة باقة <i
                    class="fa fa-plus"></i>
            </a>
            <table class="table" id="plansTable">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الاسم</th>
                    <th>عدد المشاريع</th>
                    <th>الاعلانات المميزة</th>
                    <th>اعلانات الفيسبوك</th>
                    <th>عدد ايام الظهور(السلايدر)</th>
                    <th>عدد ايام الظهور(الهيدر)</th>
                    <th>اعلانات اليوتيوب</th>
                    <th>اعلانات جوجل</th>
                    <th>السعر للشهر</th>
                    <th>3 شهور</th>
                    <th>6 شهور</th>
                    <th>سنة</th>
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
                        <td>@lang("site.".$plan->name)</td>
                        <td>{{$plan->property_num}}</td>
                        <td>{{$plan->special_property_num}}</td>
                        <td>
                            {{$plan->facebook_ads_num <= 10 ?$plan->facebook_ads_num . " اعلانات" : $plan->facebook_ads_num . " اعلان"}}
                        </td>
                        <td>
                            {{ $plan->header_appear_days != null ?  $plan->header_appear_days . " ايام" : "غير متوفر" }}
                        </td>
                        <td>
                            {{ $plan->slider_appear_days != null ?  $plan->slider_appear_days . " ايام" : "غير متوفر" }}
                        </td>
                        <td>
                            {{ $plan->youtube_ads_num != null ?  $plan->youtube_ads_num . " اعلانات "  : "غير متوفر" }}
                        </td>
                        <td>
                            {{ $plan->google_ads_num != null ?  $plan->google_ads_num . " اعلانات " : "غير متوفر" }}
                        </td>
                        <td>
                            {{number_format($plan->price). " جنية "}}
                        </td>
                        <td>
                            {{number_format($plan->three_month). " جنية "}}
                        </td>
                        <td>
                            {{number_format($plan->six_month). " جنية "}}
                        </td>
                        <td>
                            {{number_format($plan->one_year). " جنية "}}
                        </td>
                        @if($edit)
                            <td><a href="{{route("edit.company.plans",$plan->id)}}" class="btn  btn-success">
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
