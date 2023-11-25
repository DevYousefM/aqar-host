@extends("dashboard.layouts.main")
@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section("content")
    <div class="card " id="arti">
        <div class="card-header">
            <h3 class="card-title col-12 mt-2">أخبار العقارات</h3>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        @php
            $edit = auth("admin")->user()->hasPermission("articles_update");
            $create = auth("admin")->user()->hasPermission("articles_create");
            $delete = auth("admin")->user()->hasPermission("articles_delete");
        @endphp
        <div class="card-body">
            @if($create)
                <a href="{{route("create.article")}}" style="float: left" class="btn  btn-primary mb-2">أضافة مقال <i
                        class="fa fa-plus"></i></a>
            @endif
            <table class="table table-bordered" id="articles">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الصورة</th>
                    <th>العنوان</th>
                    <th>النبذة</th>
                    <th>المقال</th>
                    <th>تاريخ الأضافة</th>
                    @if($edit || $update)
                        <th>تعديل/حذف</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <?php $count = 1 ?>
                @foreach($articles as $article)
                    <tr>
                        <td>{{$count}}</td>
                        <td><img class="rounded" width="30px"
                                 src="{{asset($article->image) }}"
                                 alt=""></td>
                        <td>
                            <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target="#title-{{$count}}">
                                عرض
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target="#brief-{{$count}}">
                                عرض
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target="#body-{{$count}}">
                                عرض
                            </button>
                        </td>
                        <td>
                            <div class="d-flex flex-row-reverse justify-content-end">
                                <span>
                                    {{$article->created_at->format('d')}}
                                </span>
                                <span class="mx-1">
                                    {{$article->created_at->format('M')}}
                                </span>
                                <span>
                                    {{$article->created_at->format('Y')}}
                                </span>
                            </div>
                        </td>


                        <td>
                            <div class="d-flex">
                                @if($edit)
                                    <form action="{{route("edit.article",$article->id)}}" method="get">

                                        @csrf
                                        @method("get")
                                        <button type="submit" class="btn btn-success btn-sm">

                                            تعديل
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </form>
                                @endif
                                @if($delete)
                                    <form action="{{route("delete.article",$article->id)}}" method="get" class="ml-1">
                                        @csrf
                                        @method("get")
                                        <button type="submit" class="btn btn-danger btn-sm">

                                            حذف
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>

                    </tr>
                    <div class="modal fade" id="title-{{$count}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>{{$article->title}}</p>
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
                                    <p>{{$article->brief}}</p>
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
                                    <p>{!! $article->body !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php $count++ ?>

                @endforeach
                </tbody>
            </table>
        </div>
        {{ $articles->links('dashboard.paginate.paginate') }}
    </div>
@endsection
@section("script")
    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function () {
            $('#articles').DataTable({
                ordering: true,
                scrollX: true,
                autoWidth: false,
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
