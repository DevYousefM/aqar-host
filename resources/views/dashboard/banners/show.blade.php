@extends("dashboard.layouts.main")
@section("content")
    <div class="card">
        <div class="card-header d-flex">
            <h3 class="card-title mt-2">اعلانات البانر</h3>
        </div>
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        @php
            $edit = auth("admin")->user()->hasPermission("banners_update");
            $delete = auth("admin")->user()->hasPermission("banners_delete");
            $create = auth("admin")->user()->hasPermission("banners_create");
        @endphp

        <div class="card-body" style="overflow: auto;">
            @if($create)
                <a href="{{route("create.banner")}}" class="btn  btn-primary mb-2">أضافة اعلان بانر <i
                        class="fa fa-plus"></i></a>
            @endif
            @if(count($banners) > 0)

                <table class="table table-bordered" style="overflow: hidden;overflow-x: scroll">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>الأسم التعريفي</th>
                        <th>الصورة</th>
                        <th>تاريخ الاضافة</th>
                        @if($edit || $delete)
                            <th>تعديل/حذف</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1 ?>
                    @foreach($banners as $banner)
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$banner->name}}</td>
                            <td><img class="rounded " width="60px"
                                     src="{{asset($banner->path) }}"
                                     alt=""></td>
                            <td>
                                @if($banner->created_at)
                                    <div class="d-flex flex-row-reverse justify-content-end">
                                        <span>{{$banner->created_at->format('d')}}</span><span
                                            class="mx-1">{{$banner->created_at->format('M')}}</span><span>{{$banner->created_at->format('Y')}}</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($edit)
                                    <a href="{{route("edit.banner",$banner->id)}}" class="btn  btn-success">
                                        تعديل
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if($delete)
                                    <a href="{{route("delete.banner",$banner->id)}}" class="btn  btn-danger">
                                        حذف
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                            </td>

                        </tr>
                            <?php $count++ ?>

                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-dark text-center">لا توجد اعلانات</div>
            @endif

        </div>
        {{ $banners->links('dashboard.paginate.paginate') }}
    </div>
@endsection
