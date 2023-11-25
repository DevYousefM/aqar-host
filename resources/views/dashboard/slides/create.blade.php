@extends("dashboard.layouts.main")
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>اضافة اعلان</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a
                                href="#">الاعلانات</a></li>
                        <li class="breadcrumb-item active">أضافة اعلان</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title float-none mb-0">اضافة اعلان جديد</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @include("dashboard.components.includes.error")
                @include("dashboard.components.includes.success")
                @include("dashboard.components.includes.message")
                <form role="form" action="{{route("store.slide")}}"
                      method="post"
                      enctype="multipart/form-data"
                >
                    @method("post")
                    @csrf
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label for="exampleInputFName">اسم تعريفي (لا يظهر للمستخدم)</label>
                            <input type="text" class="form-control"
                                   id="exampleInputFName" placeholder="الاسم التعريفي للاعلان" name="name"
                                   value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">صورة الاعلان (للعرض في اعلي الصفحة الرئيسية)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                           id="exampleInputFile" name="image">
                                    <label class="custom-file-label" for="exampleInputFile">اختر الملف</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">رفع</span>
                                </div>
                            </div>
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>تاريخ الحذف التلقائى</label>
                            <input type="date" class="form-control text-left"
                                   id="exampleInputFName" placeholder="تاريخ الحذف التلقائى"
                                   name="delete_date"
                                   value="{{ old('delete_date') }}">
                            @error('delete_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">أضافة <i class="fa fa-plus"></i></button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </section>

@endsection
