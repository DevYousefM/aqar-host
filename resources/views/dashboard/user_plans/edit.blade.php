@extends("dashboard.layouts.main")
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>تعديل باقة</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{route("show.user.plans")}}">الباقات</a>
                        </li>
                        <li class="breadcrumb-item active">تعديل باقة</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title float-none mb-0">تعديل باقة</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @include("dashboard.components.includes.error")
                @include("dashboard.components.includes.success")
                @include("dashboard.components.includes.message")
                <form role="form" action="{{route("update.user.plans",$plan->id)}}"
                      method="post"
                >
                    @method("post")
                    @csrf
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label for="exampleInputFName">عدد ايام ظهور الاعلان كإعلان مميز</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="عدد ايام ظهور الاعلان كإعلان مميز"
                                   name="days_num"
                                   value="{{ $plan->days_num }}">
                            @error('days_num')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName">الظهور علي السوشيال ميديا في المنطقة المستهدفة</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="الظهور علي السوشيال ميديا في المنطقة المستهدفة"
                                   name="social_media_appear"
                                   value="{{ $plan->social_media_appear }}">
                            @error('social_media_appear')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName">سعر الباقة</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="سعر الباقة"
                                   name="price"
                                   value="{{ $plan->price }}">
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">تعديل <i class="fa fa-edit"></i></button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </section>

@endsection
