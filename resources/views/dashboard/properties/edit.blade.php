@extends("dashboard.layouts.main")
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>تعديل عقار</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a
                                href="#">العقارات</a></li>
                        <li class="breadcrumb-item active">تعديل عقار</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title float-none mb-0">تعديل عقار</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @include("dashboard.components.includes.error")
                @include("dashboard.components.includes.success")
                @include("dashboard.components.includes.message")
                <form role="form" action="{{route("update.property",$property->id)}}"
                      method="post"
                >
                    @method("post")
                    @csrf
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label for="exampleInputFName">العنوان</label>
                            <input type="text" class="form-control"
                                   id="exampleInputFName" placeholder="العنوان" name="title"
                                   value="{{ $property->title }}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label for="exampleInputFName">النبذة</label>
                            <textarea class="form-control"
                                      placeholder="النبذة" name="brief"
                            >{{$property->brief}}</textarea>
                            @error('brief')
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
