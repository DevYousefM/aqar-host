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
                                href="{{route("show.company.plans")}}">الباقات</a>
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
                <form role="form" action="{{route("update.company.plans",$plan->id)}}"
                      method="post"
                >
                    @method("post")
                    @csrf
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label for="exampleInputFName">عدد المشاريع</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="عدد المشاريع"
                                   name="property_num"
                                   value="{{ $plan->property_num }}">
                            @error('property_num')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName">عدد الأعلانات المميزة</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="عدد الأعلانات المميزة"
                                   name="special_property_num"
                                   value="{{ $plan->special_property_num }}">
                            @error('special_property_num')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName">عدد الاعلانات المدفوعة علي فيسبوك</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="عدد الاعلانات المدفوعة علي فيسبوك"
                                   name="facebook_ads_num"
                                   value="{{ $plan->facebook_ads_num }}">
                            @error('facebook_ads_num')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName">عدد ايام الظهور في السلايدر</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="عدد ايام الظهور في السلايدر"
                                   name="slider_appear_days"
                                   value="{{ $plan->slider_appear_days }}">
                            @error('slider_appear_days')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName">عدد ايام الظهور في الهيدر</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="عدد ايام الظهور في الهيدر"
                                   name="header_appear_days"
                                   value="{{ $plan->header_appear_days }}">
                            @error('header_appear_days')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName">عدد الاعلانات علي اليوتيوب</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="عدد الاعلانات علي اليوتيوب"
                                   name="youtube_ads_num"
                                   value="{{ $plan->youtube_ads_num }}">
                            @error('youtube_ads_num')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName">عدد الاعلانات علي جوجل</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="عدد الاعلانات علي جوجل"
                                   name="google_ads_num"
                                   value="{{ $plan->google_ads_num }}">
                            @error('google_ads_num')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName">السعر</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="السعر"
                                   name="price"
                                   value="{{ $plan->price }}">
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFName">السعر قبل الخصم</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="السعر قبل الخصم"
                                   name="last_price"
                                   value="{{ $plan->last_price }}">
                            @error('last_price')
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
