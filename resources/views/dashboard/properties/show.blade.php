@extends('dashboard.layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title col-12 mt-2">العقارات</h3>
        </div>
        <!-- /.card-header -->
        @include('dashboard.components.includes.error')
        @include('dashboard.components.includes.success')
        @include('dashboard.components.includes.message')
        @php
            $edit = auth('admin')
                ->user()
                ->hasPermission('properties_update');
            $delete = auth('admin')
                ->user()
                ->hasPermission('properties_delete');
        @endphp
        <div class="card-body">
            <form action="{{ route('admin.properties') }}" class="form-group col-sm-12 col-md-6 d-flex"
                style="float: left;gap:5px">
                <select name="timeRange" class="form-control" style="padding-top: 0;height:1.9rem;font-size:.9rem">
                    <option value="7days" selected={{ request('timeRange') === '7days' }}>7 ايام</option>
                    <option value="15days" selected={{ request('timeRange') === '15days' }}>15 يوم</option>
                    <option value="1month" selected={{ request('timeRange') === '1month' }}>شهر</option>
                    <option value="3months" selected={{ request('timeRange') === '3months' }}>3 اشهر</option>
                    <option value="1year" selected={{ request('timeRange') === '1year' }}>سنة</option>
                </select>
                <button class="btn btn-success btn-sm">فلترة</button>
                <a class="btn btn-success btn-sm" href="{{ route('admin.properties') }}">الكل</a>
            </form>

            <table class="table table-bordered" id="props">
                <thead>
                    <tr>
                        <th style="font-size: 12px" style="width: 10px">#</th>
                        <th style="font-size: 12px">العنوان</th>
                        <th style="font-size: 12px">المنطقة</th>
                        <th style="font-size: 12px">نوع الدفع</th>
                        <th style="font-size: 12px">السعر/المقدم</th>
                        <th style="font-size: 12px">بيانات اخري</th>
                        <th style="font-size: 12px">بيانات المستخدم</th>
                        <th style="font-size: 12px">صور العقار</th>
                        @if ($edit)
                            <th style="font-size: 12px">تمييز/ازالة</th>
                        @endif
                        @if ($edit || $delete)
                            <th style="font-size: 12px">تعديل/حذف</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach ($properties as $property)
                        <tr>
                            <td>
                                <span data-toggle="modal" data-target="#seen-{{ $count }}" style="font-size: 15px"
                                    class="d-flex align-items-center">
                                    {{ $property->seen }}
                                    <i class="fas fa-eye mr-1"></i>
                                </span>
                            </td>
                            <td>{{ $property->title }}</td>
                            <td>{{ $property->area }}</td>
                            <td>{{ $property->payment }}</td>
                            <td>{{ empty($property->price) ? number_format($property->presenter) . ' جنية' : number_format($property->price) . ' جنية' }}
                            </td>
                            <td>
                                <a
                                    href="{{ route('property.show', ['id' => $property->id, 'name' => '{{$property->title}}']) }}">
                                    <button type="button" class="btn btn-sm btn-info">
                                        عرض العقار
                                    </button>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark" data-toggle="modal"
                                    data-target="#user-{{ $count }}">
                                    عرض
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark" data-toggle="modal"
                                    data-target="#imgs-{{ $count }}">
                                    عرض
                                </button>
                            </td>
                            @if ($edit)
                                <td>
                                    @if ($property->is_special)
                                        <a href="{{ route('toggle.property.special', $property->id) }}"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-star-half"></i>
                                        </a>
                                    @endif
                                    @if (!$property->is_special)
                                        <a href="{{ route('toggle.property.special', $property->id) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-star"></i>
                                        </a>
                                    @endif
                                </td>
                            @endif
                            @if ($edit || $delete)
                                <td>
                                    @if ($edit)
                                        <a href="{{ route('edit.property', $property->id) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                    @if ($delete)
                                        <a href="{{ route('delete.property', $property->id) }}"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            @endif
                        </tr>

                        <div class="modal fade" id="user-{{ $count }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">اسم الحساب: {{ $property->user->name }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>اسم الحساب: {{ $property->user->name }}</p>
                                        @if ($property->user->account_type === 'company')
                                            <p>اسم الشركة:{{ $property->user->company_name }}</p>
                                            <p>نوع الشركة:{{ $property->user->company_type }}</p>
                                        @endif
                                        <p>رقم الهاتف:{{ $property->user->phone }}</p>
                                        @if ($property->user->phone_sec)
                                            <p>رقم الهاتف الثانوي:{{ $property->user->phone_sec }}</p>
                                        @endif
                                        <p>البريد الالكتروني:{{ $property->user->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($edit)
                            <div class="modal fade" id="seen-{{ $count }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">العقار: {{ $property->title }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card card-primary">
                                                <form role="form" action="{{ route('update.seen', $property->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('post')
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="seen">مشاهدات العقار</label>
                                                            <input type="number" name="seen"
                                                                value="{{ $property->seen }}" class="form-control"
                                                                id="seen" placeholder="عدد المشاهدات">
                                                        </div>
                                                    </div>

                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="modal fade" id="imgs-{{ $count }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex flex-wrap justify-content-center">
                                            @foreach ($property->images as $img)
                                                <img style="width:150px;margin: 10px" class="img-thumbnail"
                                                    src="{{ asset('property_images/' . $img->path) }}">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $count++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function() {
            $('#props').DataTable({
                paging: true,
                "bLengthChange": false,
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
