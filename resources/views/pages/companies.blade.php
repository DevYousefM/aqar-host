@extends('layouts.main')
@section('content')
    <div class="back-gr">
        <h1 class="pe-5 pt-5 text-white">الشركات</h1>
    </div>
    <div class=" text-center">
        <div class="container-fluid d-flex justify-content-center ">
            <div class="com-banner mt-3">
                <div id="carouselBanner" style="height: 100%;" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" style="height: 100%;">
                        <?php $active = true; ?>
                        @foreach ($banners as $i)
                            <div class="carousel-item {{ $active ? 'active' : null }}"
                                style="height: 100%;background-image: url('{{ asset('' . $i->path) }}');background-repeat: no-repeat;background-position: center;background-size: auto 100%">
                            </div>
                            <?php $active = false; ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <h2 class="text-center mt-5">الشركات</h2>
        <div class="container-fluid d-flex flex-nowrap justify-content-between flex-nowrap">
            @include('advertisements.right')

            <div class="row company mx-1" style="width: inherit">
                @foreach ($companies as $com)
                    <div class="col-md-6 col-lg-3 mb-4" href="{{ route('company.profile', $com->company_name) }}">

                        <div class="feat mb-3 rounded">
                            <a href="{{ route('company.profile', $com->company_name) }}">
                                <img class="mb-3  rounded-top"
                                    src="{{ $com->image && $com->image !== '#' ? asset($com->image) : asset('img/default.svg') }}"
                                    height="30" alt="">
                            </a>
                            <div class="title" style="padding-left: 7px; padding-bottom: 12px; padding-right: 7px;">
                                <h4 class="fs-6  fw-bold"><a
                                        href="{{ route('company.profile', $com->company_name) }}">{{ $com->company_name }}</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                @endforeach
                <nav aria-label="Page navigation example">
                    {{ $companies->links('pagination.custom') }}
                </nav>
            </div>
            @include('advertisements.left')

        </div>
    @endsection
    @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script>
            const carouselBanner = document.querySelector('#carouselBanner')
            const carousel = new bootstrap.Carousel(carouselBanner, {
                interval: 6000,
                touch: true
            })
        </script>
    @endsection
