@extends("dashboard.layouts.main")
@section("content")
    <div class="card">
        <div class="card-header d-flex">
            <h3 class="card-title mt-2">الأعلانات</h3>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        @php
            $edit = auth("admin")->user()->hasPermission("slides_update");
            $delete = auth("admin")->user()->hasPermission("slides_delete");
            $create = auth("admin")->user()->hasPermission("slides_create");
        @endphp

        <div class="card-body" style="overflow: auto;">
            @if($create)
                <a href="{{route("create.slide")}}" class="btn  btn-primary mb-2">أضافة اعلان <i class="fa fa-plus"></i></a>
            @endif
            @if(count($slides) > 0)

                <table class="table table-bordered" style="overflow: hidden;overflow-x: scroll">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>الأسم التعريفي</th>
                        <th>الصورة</th>
                        <th>تاريخ الاضافة</th>
                        <th>تاريخ الحذف</th>
                        @if($edit || $delete)
                            <th>تعديل/حذف</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1 ?>
                    @foreach($slides as $slide)
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$slide->name}}</td>
                            <td><img class="rounded " width="60px"
                                     src="{{asset($slide->path) }}"
                                     alt=""></td>
                            <td>
                                @if($slide->created_at)
                                    <div class="d-flex flex-row-reverse justify-content-end">
                                        <span>{{$slide->created_at->format('d')}}</span><span
                                            class="mx-1">{{$slide->created_at->format('M')}}</span><span>{{$slide->created_at->format('Y')}}</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($slide->delete_date)
                                        <?php
                                        $delete_date = \Carbon\Carbon::parse($slide->delete_date);
                                        ?>
                                    <div class="d-flex flex-row-reverse justify-content-end">
                                        <span>{{$delete_date->format('d')}}</span><span
                                            class="mx-1">{{$delete_date->format('M')}}</span><span>{{$delete_date->format('Y')}}</span>
                                    </div>
                                @else
                                    غير محدد
                                @endif
                            </td>
                            <td>
                                @if($edit)
                                    <a href="{{route("edit.slide",$slide->id)}}" class="btn  btn-success">
                                        تعديل
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if($delete)
                                    <a href="{{route("delete.slide",$slide->id)}}" class="btn  btn-danger">
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
        {{ $slides->links('dashboard.paginate.paginate') }}
    </div>
@endsection
