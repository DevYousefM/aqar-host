@extends("dashboard.layouts.main")
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>تعديل المسئول ({{$admin->name}})</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{route("admins.show")}}">المسئولين</a></li>
                        <li class="breadcrumb-item active">تعديل مسئول</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">

            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title float-none mb-0">تعديل مسئول</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @include("dashboard.components.includes.error")
                @include("dashboard.components.includes.success")
                @include("dashboard.components.includes.message")
                <form role="form" action="{{route("admin.update",$admin->id)}}"
                      method="post">
                    @method("post")
                    @csrf
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label for="exampleInputFName">ألاسم كاملاً</label>
                            <input type="text" class="form-control" id="exampleInputFName"
                                   placeholder="الأسم" name="name"
                                   value="{{$admin->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">البريد الألكتروني</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                   placeholder="البريد الألكتروني" name="email" value="{{$admin->email}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">كلمة المرور</label>
                            <input type="password" class="form-control" id="exampleInputPassword"
                                   placeholder="كلمة المرور" name="password"
                            >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPasswordC">تاكيد كلمة المرور</label>
                            <input type="password" class="form-control" id="exampleInputPasswordC"
                                   placeholder="تاكيد كلمة المرور" name="password_confirmation"
                            >
                        </div>
                    </div>
                    @php
                        $custom = [
                             "admins"=>["create","read","update","delete"],
                             "companies"=>["read","update"],
                             "slides"=>["create","read","update","delete"],
                             "sliders"=>["create","read","update","delete"],
                             "properties"=>["read","update","delete"],
                             "users"=>["read"],
                             "articles"=>["create","read","update","delete"],
                             "messages"=>["read"],
                             "user_plans"=>["read","update"],
                             "user_plans_requests"=>["read","update","delete"],
                             "company_plans"=>["read","update"],
                             "company_plans_requests"=>["read","update"],
                             "single_services_requests"=>["read","update","delete"],
                             "banners"=>["create","read","update","delete"],
                        ];
                    @endphp

                    <div class="row card-body pt-0 pb-1">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <ul class="nav nav-pills  p-2" style="flex-wrap: nowrap;overflow: auto;">
                                        <?php $index = 0 ?>
                                        @foreach($custom as $modal => $map)

                                            <li class="nav-item"><a
                                                    style="width: max-content !important;"
                                                    class="nav-link {{$index == 0 ? 'active' : ''}}"
                                                    href="#{{$modal}}"
                                                    data-toggle="tab">@lang("site.".$modal)</a></li>
                                                <?php $index++ ?>
                                        @endforeach
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <?php $boxs = 0 ?>
                                        @foreach($custom as $i => $maps)
                                            <div class="tab-pane  {{$boxs == 0 ? 'active' : ''}}"
                                                 id="{{$i}}">
                                                <div class="d-flex flex-wrap">

                                                    @foreach($maps as $map)
                                                        <div class="form-check">
                                                            <label class="form-check-label" for="Check-{{$map}}">
                                                                <input type="checkbox" name="permissions[]"
                                                                       value="{{$i.'_'.$map}}"
                                                                       {{$admin->hasPermission($i.'_'.$map) ? "checked" : ""}}
                                                                       class="form-check-input"
                                                                       id="Check{{$map}}{{$modal}}">
                                                                @lang("site.".$map)</label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                                <?php $boxs++ ?>
                                        @endforeach
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- ./card -->
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">تعديل <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </section>

@endsection
