@extends("dashboard.layouts.main")
@section("css")
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section("content")
    <div class="card " id="arti">
        <div class="card-header">
            <h3 class="card-title col-12 mt-2">المراسلات</h3>
        </div>
        <!-- /.card-header -->
        @include("dashboard.components.includes.error")
        @include("dashboard.components.includes.success")
        @include("dashboard.components.includes.message")
        <div class="card-body" style="overflow: auto">
            <table class="table table-bordered text-center" id="messages">
                <tbody>
                <?php $count = 1 ?>
                @foreach($messages as $message)
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$message->first_name . " " . $message->last_name}}</td>
                        <td>{{$message->email}}</td>
                        <td>{{$message->category}}</td>
                        <td>
                            <div class="d-flex flex-row-reverse justify-content-end">

                                <span>
                                    {{$message->created_at->format('d')}}
                                </span>
                                <span class="mx-1">
                                    {{$message->created_at->format('M')}}
                                </span>
                                <span>
                                    {{$message->created_at->format('Y')}}
                                </span>
                                <span style="margin-left: 5px">
                                    تاريخ الارسال:
                                </span>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target="#sub-{{$count}}">
                                الموضوع
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target="#msg-{{$count}}">
                                الرسالة
                            </button>
                        </td>


                    </tr>
                    <div class="modal fade" id="sub-{{$count}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>{{$message->subject}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="msg-{{$count}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>{{$message->message}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php $count++ ?>

                @endforeach
                </tbody>
            </table>
        </div>
        {{ $messages->links('dashboard.paginate.paginate') }}
    </div>
@endsection
