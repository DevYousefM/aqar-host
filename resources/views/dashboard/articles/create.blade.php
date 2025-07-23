@extends("dashboard.layouts.main")
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>اضافة مقال في صفحة اخبار العقارات</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{route("all.articles")}}">اخبار العقارات</a></li>
                        <li class="breadcrumb-item active">أضافة مقال</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title float-none mb-0">اضافة مقال جديد</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @include("dashboard.components.includes.error")
                @include("dashboard.components.includes.success")
                @include("dashboard.components.includes.message")
                <form role="form" action="{{route("store.article")}}"
                      method="post"
                      enctype="multipart/form-data"
                >
                    @method("post")
                    @csrf
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label for="exampleInputFName">عنوان المقال</label>
                            <input type="text" class="form-control"
                                   id="exampleInputFName" placeholder="العنوان" name="title"
                                   value="{{ old('title') }}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName"> عنوان المقال (SEO)</label>
                            <input type="text" class="form-control"
                                   id="exampleInputFName" placeholder="" name="title_seo"
                                   value="{{ old('title_seo') }}">
                            @error('title_seo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName"> اسم الURL</label>
                            <input type="text" class="form-control"
                                   id="exampleInputFName" placeholder="" name="url_name"
                                   value="{{ old('url_name') }}">
                            @error('url_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>نص المقال</label>
                            <textarea class="form-control ckeditor" name="body" rows="3"
                                      placeholder="نص المقال هنا">{{ old("body") }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">صورة المقال (للعرض في صفحة اخبار العقارات)</label>
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
                            <label>نص الصورة (Alt Text)</label>
                            <input type="text" class="form-control"
                                   id="exampleInputFName" placeholder="" name="image_alt"
                                   value="{{ old('image_alt') }}">
                            @error('image_alt')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>نبذة للمقال (للعرض في صفحة اخبار العقارات لجذب المستخدم للدخول)</label>
                            <textarea class="form-control" name="brief" rows="3"
                                      placeholder="نبذة المقال هنا">{{ old("brief") }}</textarea>
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
@section("script")
    <script src="{{ asset('dashboard/plugins/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/ckeditor5/translations/ar.js') }}"></script>
    <script>
        document.querySelectorAll(".ckeditor").forEach((x) => {
            ClassicEditor
                .create(x, {
                    language: "{{App::getLocale()}}"
                })
                .then(editor => {
                    // console.log(editor);
                })
                .catch(error => {
                    // console.error(error);
                });
        })
    </script>
@endsection
