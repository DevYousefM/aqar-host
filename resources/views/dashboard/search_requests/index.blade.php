@extends("dashboard.layouts.main")
@section("content")
    <div class="card">
        <div class="card-header">
            <h3 class="card-title col-12 mt-2">طلبات (مش لاقي شقتك؟)</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="props">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>نوع العقار</th>
                    <th>المنطقة</th>
                    <th>المحافظة</th>
                    <th>المساحة</th>
                    <th>عدد الغرف</th>
                    <th>السعر/قيمة الايجار</th>
                    <th>نوع التعاقد</th>
                </tr>
                </thead>
                <tbody>
                <?php $count = 1 ?>
                @foreach($search_reqs as $req)
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$req->type}}</td>
                        <td>{{$req->area}}</td>
                        <td>{{$req->gov}}</td>
                        <td>{{$req->meters}}</td>
                        <td>{{$req->rooms || "-"}}</td>
                        <td>{{number_format($req->price) . " جنية"}}</td>
                        <td>{{$req->contract_type }}</td>
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
            $('#props').DataTable({
                ordering: false,
                paging: true,
                info: false,
                "bLengthChange": false,
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
