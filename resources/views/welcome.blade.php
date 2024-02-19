@extends('layouts.main')
@section('title')
    <title>عقار مصر | بيع و اشتري من غير سمسار</title>
@endsection
@section('description')
    <meta property="description"
        content="خدمات عقار مصر هي خدمه مجانية تساعدك على بيع وشراء العقارات بسهولة
        و توصلك بالبائع مباشرةً بدون اي وسيط وتزودك بالمعلومات الاساسية لإتخاذ واحد من أهم
        القرارات المالية في حياتك">
@endsection
@section('content')
    <!-- Start Slider -->
    <div class="slider position-relative">
        <div id="carouselExample" class="carousel slide">
            @if (count($slides) > 0)
                <div class="carousel-inner">
                    <?php $active = true; ?>
                    @foreach ($slides as $slide)
                        <div class="carousel-item {{ $active ? 'active' : '' }}">
                            <img src="{{ asset($slide->path) }}" class="d-block w-100 slides-imgs" alt="{{ $slide->name }}">
                        </div>
                        <?php $active = false; ?>
                    @endforeach
                </div>
            @else
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('slides/default.jpg') }}" class="d-block w-100" style="height: unset;"
                            alt="اشتري او بيع مع عقارات مصر">
                    </div>
                </div>
            @endif
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- End Slider -->

    <div class="form-container">
        <form action="{{ route('home') }}"
            class="form d-flex justify-content-around gap-3 flex-column flex-lg-row flex-md-row shadow bg-white rounded p-3"
            method="GET">
            @if (auth()->user())
                <div class="btn sec-main-btn d-block d-lg-none d-md-none">
                    <a href="{{ route('property.create') }}" class="text-white">اضافة عقار جديد</a>
                </div>
            @endif
            <div class="dropdown">
                <select name="purpose" class="form-select w-100 text-end" aria-labelledby="dropdownMenuButton1">
                    <option value="" disabled selected>الغرض</option>
                    <option value="">جميع الاغراض</option>
                    <option class="dropdown-item" value="بيع">بيع</option>
                    <option class="dropdown-item" value="شراء">شراء</option>
                    <option class="dropdown-item" value="ايجار">ايجار</option>
                </select>
            </div>
            <div class="dropdown">
                <select name="type" class="form-select w-100 text-end" aria-labelledby="dropdownMenuButton1">
                    <option value="" disabled selected>نوع العقار</option>
                    <option value="">الكل</option>
                    <option class="dropdown-item" value="شقق">شقق</option>
                    <option class="dropdown-item" value="محلات">محلات</option>
                    <option class="dropdown-item" value="ادارى">ادارى</option>
                    <option class="dropdown-item" value="اراضى">اراضى</option>
                    <option class="dropdown-item" value="ارضى">ارضى</option>
                    <option class="dropdown-item" value="ارضى بجنينة">ارضى بجنينة</option>
                    <option class="dropdown-item" value="فيلا">فيلا</option>
                    <option class="dropdown-item" value="روف">روف</option>
                    <option class="dropdown-item" value="مبانى">مبانى</option>
                    <option class="dropdown-item" value="سكن الطلبة">سكن الطلبة</option>
                </select>
            </div>
            <div class="dropdown">
                <select class="form-select w-100 text-end no-local" name="gov" id="govs"
                    aria-labelledby="dropdownMenuButton1">
                    <option value="" disabled selected>المحافظة</option>
                    <option value="">أي محافظة</option>
                </select>
            </div>
            <div class="dropdown">
                <select class="form-select w-100 text-end no-local" id="areas" name="area"
                    aria-labelledby="dropdownMenuButton1">
                    <option value="" disabled selected>المنطقة</option>
                    <option value="">اي منطقة</option>
                </select>
            </div>
            <div class="search d-flex gap-2">
                <input class="border rounded pe-2" type="search" name="search" id="">
                <button type="submit" class="btn p-2 rounded bg-danger pill text-white d-flex align-items-center"
                    href=""><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>

    <!-- Start Advertisement -->
    <div class="advertisement">
        <div class="col-12">
            <h2 class="text-center mb-5">احدث الاعلانات</h2>
            <div class="container-fluid d-flex flex-nowrap adpage justify-content-between flex-nowrap">
                @include('advertisements.right')

                <div class="row mx-1 " style="width: 100%">

                    @foreach ($ads as $ad)
                        <div class="col-md-6 col-lg-4 mb-4 position-relative">
                            @if ($ad->is_special)
                                <div class="specialTag">
                                    <strong style="color: red">اعلان مميز</strong>
                                    <i class="fas fa-star " style="color: gold"></i>
                                </div>
                            @endif
                            <div class="card">
                                <div class="img-container">
                                    <img class="card-img-top" src="{{ asset('property_images/' . $ad->images[0]->path) }}"
                                        alt="">
                                    <span class="logo-tag"></span>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title text-trunc trunc-2">{{ $ad->title }}...</h4>
                                    <p class="card-text text-trunc trunc-3">{{ $ad->brief }}</p>
                                    <div class=" d-block m-auto">
                                        <a class="d-block m-auto btn main-btn btn-sm" style="font-size: 12px"
                                            href="{{ route('property.show', ['id' => $ad->id, 'name' => urlencode($ad->title)]) }}">قراءة
                                            المزيد</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @include('advertisements.left')
            </div>

            <nav aria-label="Page navigation example">
                {{ $ads->links('pagination.custom') }}
            </nav>
        </div>
    </div>
@endsection