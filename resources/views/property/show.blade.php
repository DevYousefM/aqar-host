@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
@endsection
@section('content')
    <div class="back-gr">
        <h4 class="pe-5 pt-5 text-white">{{ $property->title }}</h4>
    </div>
    <div class="info mt-5 mb-5">
        <div class="container">
            <div class="offer d-flex flex-column flex-lg-row">
                <div class="slider">
                    <div class="container h-100vh p-3">


                        @foreach ($property->images as $img)
                            <div class="mySlides m-3 rounded">
                                <div class="big-img-container">
                                    <img class="rounded big-img" src="{{ asset('property_images/' . $img->path) }}">
                                    <span class="logo-tag"></span>
                                </div>
                            </div>
                        @endforeach

                        <!-- Next and previous buttons -->
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>

                        <div class="row justify-content-center" style='gap:15px'>
                            <?php $count = 1; ?>
                            @foreach ($property->images as $img)
                                <div class="column">
                                    <img class="demo small-img cursor" src="{{ asset('property_images/' . $img->path) }}"
                                        style="width:100%" onclick="currentSlide({{ $count }})">
                                </div>
                                <?php $count++; ?>
                            @endforeach
                        </div>
                    </div>
                    <div class="cont mb-5">
                        <h4 class="pt-4 text-danger text-end">الوصف</h4>
                        <p class="lh-lg">
                            {{ $property->brief }}
                        </p>
                    </div>
                    <div class="favourite fw-bold">
                        <h5 class="mb-3">شارك الموضوع عبر :</h5>
                        <div class="social-icon d-flex justify-content-center gap-4">
                            <a class="text-white"
                                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                target="_blank" rel="noopener">
                                <div class="social blue d-flex align-items-center gap-2 pt-2 pb-2 ps-3 pe-3 rounded">
                                    <i class="fa-brands fa-facebook"></i>
                                    <span class="text-white">فيسبوك</span>
                                </div>
                            </a>

                            <a class="text-white"
                                href="https://twitter.com/intent/tweet?text={{ urlencode($property->title) }}&url={{ urlencode(request()->url()) }}"
                                target="_blank" rel="noopener">
                                <div class="social cyan d-flex align-items-center gap-2 pt-2 pb-2 ps-3 pe-3 rounded">
                                    <i class="fa-brands fa-twitter"></i>
                                    <span class="text-white">تويتر</span>
                                </div>
                            </a>
                            <a class="text-white"
                                href="https://api.whatsapp.com/send?text={{ urlencode($property->title . ' ' . request()->url()) }}"
                                target="_blank" rel="noopener">
                                <div class="social green d-flex align-items-center gap-2 pt-2 pb-2 ps-3 pe-3 rounded">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    <span class="text-white">واتساب</span>
                                </div>
                            </a>
                            {{--                            <a class="text-white" href=""> --}}
                            {{--                                <div class="social cyan d-flex align-items-center gap-2 pt-2 pb-2 ps-3 pe-3 rounded"> --}}
                            {{--                                    <i class="fa-solid fa-heart text-danger"></i> --}}
                            {{--                                    <span class="text-white">اضف الى المفضلة</span> --}}
                            {{--                                </div> --}}
                            {{--                            </a> --}}
                        </div>
                    </div>
                    <div class="owl-carousel owl-theme mt-4" style="width: 90%">
                        @foreach ($slides as $e)
                            <div class="item">
                                <div class="card" style="width: 18rem;">
                                    <div style="height: 135px;width:100%" class="img-container">
                                        <img style="height: 135px;width:100% !important"
                                            src="
                                    {{ asset('property_images/' . $e->images[0]->path) }}"
                                            class="card-img-top" alt="...">
                                        <span class="logo-tag"></span>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title"
                                            style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                            {{ $e->title }}</h5>
                                        <p class="card-text"
                                            style="overflow: hidden;text-overflow: ellipsis;display: -webkit-box;
                                                   -webkit-line-clamp: 2;
                                                           line-clamp: 2; 
                                                   -webkit-box-orient: vertical;">
                                            {{ $e->brief }}
                                        </p>
                                        <a href="{{ route('property.show', ['id' => $e->id, 'name' => $e->title]) }}"
                                            class="btn btn-danger">المزيد</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="description p-4 text-white">
                    <div class="address">
                        <p>{{ $property->title }}</p>
                        @if ($property->presenter)
                            <p class="currency border-bottom border-white w-100 pb-1 d-inline-block">
                                {{ number_format($property->presenter) }}جنية مقدم </p>
                        @endif
                        @if ($property->price)
                            <p class="currency border-bottom border-white pb-1 d-inline-block">
                                {{ number_format($property->price) }}
                                جنية </p>
                        @endif
                    </div>
                    <div class="icon flex-wrap w-100 d-flex justify-content-evenly mb-4">
                        <div class="some-icon d-flex flex-column gap-1">
                            <i class="fa-solid fa-earth-americas fa-fw"></i>
                            <span>المنطقة</span>
                            <span>{{ $property->area }}</span>
                        </div>
                        <div class="some-icon d-flex flex-column gap-1">
                            <i class="fa-solid fa-landmark fa-fw"></i>
                            <span>مساحة</span>
                            <span>{{ $property->meters }} متر</span>
                        </div>
                        @if ($property->rooms)
                            <div class="some-icon d-flex flex-column gap-1">
                                <i class="fa-solid fa-bed fa-fw"></i>
                                <span>غرف</span>
                                <span>{{ $property->rooms }}</span>
                            </div>
                        @endif
                        <div class="some-icon d-flex flex-column gap-1">
                            <i class="fa-solid fa-money-bill-wave fa-fw"></i>
                            <span>الغرض</span>
                            <span>{{ $property->purpose }}</span>
                        </div>
                        <div class="some-icon d-flex flex-column gap-1">
                            <i class="fa-solid fa-building fa-fw"></i>
                            <span>نوع العقار</span>
                            <span>{{ $property->type }}</span>
                        </div>
                    </div>
                    <div class="saler mt-5">
                        <h4 class="p-2 rounded mb-3">معلومات البائع</h4>
                        <div class="saler-name d-flex align-items-center gap-5 mb-2">
                            <img class="rounded" style="width: 20%;"
                                src="{{ asset($property->user->image && $property->user->image !== '#' ? 'public/' . $property->user->image : 'public/img/default.svg') }}"
                                alt="">
                            @if (!$property->user->company_name)
                                <span class="fs-3 fw-bold">{{ $property->user->name }}</span>
                            @else
                                <span class="fs-4 fw-bold">شركة {{ $property->user->company_name }}</span>
                            @endif
                        </div>
                        <p class="fs-5 fw-bold">{{ str_replace(' ', '', $property->user->phone) }}</p>
                        @if ($property->user->phone_sec)
                            <p class="fs-5 fw-bold">{{ str_replace(' ', '', $property->user->phone_sec) }}</p>
                        @endif
                        <p>عدد المشاهدات: {{$property->seen}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            margin: 20,
            autoWidth: true,
            rtl: true,

            loop: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true,
                    loop: true

                },
                600: {
                    items: 2,
                    loop: true,
                    nav: false
                },
                1000: {
                    items: 3,
                    loop: true,
                    nav: true,
                }
            }
        })
    </script>
@endsection
