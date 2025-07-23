@extends("dashboard.layouts.main")
@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

@endsection
@section("content")
    <div class="card">
        <div class="card-header d-flex">
            <h3 class="card-title mt-2">أعلانات الاسلايدر</h3>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        @php
            $edit = auth("admin")->user()->hasPermission("sliders_update");
            $delete = auth("admin")->user()->hasPermission("sliders_delete");
            $create = auth("admin")->user()->hasPermission("sliders_create");
        @endphp

        <div class="card-body" style="overflow: auto;">
            @if($create)
                <a href="{{route("create.slider")}}" class="btn  btn-primary mb-2">أضافة اعلان الي الاسلايدر<i
                        class="fa fa-plus"></i></a>
            @endif
            @if(count($sliders) > 0)

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>الأسم التعريفي</th>
                        <th>الصورة</th>
                        <th>تاريخ الاضافة</th>
                        <th>مكان الاعلان</th>
                        @if($edit || $delete)
                            <th>تعديل/حذف</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1 ?>
                    @foreach($sliders as $slider)
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$slider->name}}</td>
                            <td>

                                <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                        data-target="#img-{{$count}}">
                                    عرض
                                </button>
                            </td>

                            <td>

                                <div class="d-flex flex-row-reverse justify-content-end">
                                    <span>{{$slider->created_at->format('d')}}</span><span
                                        class="mx-1">{{$slider->created_at->format('M')}}</span><span>{{$slider->created_at->format('Y')}}</span>
                                </div>
                            </td>
                            <td>{{$slider->place === 'right' ? 'يمين الصفحة' : 'يسار الصفحة'}}</td>
                            <td>
                                @if($edit)
                                    <a href="{{route("edit.slider",$slider->id)}}" class="btn  btn-success">
                                        تعديل
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if($delete)
                                    <a href="{{route("delete.slider",$slider->id)}}" class="btn  btn-danger">
                                        حذف
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                            </td>

                        </tr>
                        <div class="modal fade" id="img-{{$count}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex flex-wrap justify-content-center">
                                            <img style="width:150px;margin: 10px" class="img-thumbnail"
                                                 src="{{asset($slider->path) }}"
                                                 alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php $count++ ?>

                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-dark text-center">لا توجد اعلانات</div>
            @endif

        </div>
        {{ $sliders->links('dashboard.paginate.paginate') }}
    </div>
@endsection
