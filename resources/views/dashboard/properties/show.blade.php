@extends('dashboard.layouts.main')
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
                    @foreach ($properties as $property)
                        <tr>
                            <td>
                                <span style="font-size: 15px" class="d-flex align-items-center">
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
                                <a href="{{ route('property.show', $property->id) }}">
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
                                            جعله غير مميز
                                            <i class="fas fa-star-half"></i>
                                        </a>
                                    @endif
                                    @if (!$property->is_special)
                                        <a href="{{ route('toggle.property.special', $property->id) }}"
                                            class="btn btn-sm btn-success">
                                            جعله مميز
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
                ordering: true,
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
