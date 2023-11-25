@extends("layouts.main")
@section("css")
    <link rel="stylesheet" href="{{asset("css/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/owl.theme.default.min.css")}}">
@endsection
@section("content")
    <!-- Start Advertisement -->
    <div style="margin-top:2rem">
        <div class="container">
            <div class="d-flex justify-content-center mb-2"><img
                    style="width: 120px;height: 120px;"
                    src="{{ $company->image && $company->image !== "#" ? asset($company->image) :asset("img/default.svg")}}"
                    class="img-thumbnail" alt=""></div>
            <h2 class="text-center mb-1">{{$company->company_name}}</h2>
            <div class="d-flex justify-content-center col-12">
                <p class="text-center mx-2 col-8 ">{{$company->company_brief}}</p>
            </div>
            @if( count($company->properties) > 0)
                <div class="mb-5 border-bottom border-danger" style="width: fit-content">
                    <h4 class="text-right">أعلانات الشركة</h4>
                </div>
                <div class="row">
                    @foreach($company->properties as $ad)
                        <div class="col-md-6 col-lg-3 mb-4 position-relative">
                            @if($ad->is_special)
                                <div class="specialTag">
                                    <strong style="color: red">اعلان مميز</strong>
                                    <i class="fas fa-star " style="color: gold"></i>
                                </div>
                            @endif
                            <div class="feat mb-3 rounded">
                                <img class="mb-3 rounded-top col-12" style="height: unset;"
                                     src="{{ asset("property_images/". $ad->images[0]->path)}}" alt="">
                                <div class="title ps-2 pe-2 pb-3">
                                    <h4 class="fs-6 pb-3 mb-2 border-bottom fw-bold">{{$ad->title}}...</h4>
                                    <p class="text-secondary">{{$ad->brief}}</p>
                                    <div class=" d-block m-auto w-50">
                                        <a class="d-block m-auto btn main-btn"
                                           href="{{route("property.show",$ad->id)}}">قراءة
                                            المزيد</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(count($company->company_projects) > 0)
                <div class="mb-5 border-bottom border-danger" style="width: fit-content">
                    <h4 class="text-right">مشاريع الشركة</h4>
                </div>
                <div class="row">
                    @foreach($company->company_projects as $project)
                        <div class="col-12 mb-4 position-relative">
                            <div class="feat mb-3 rounded">
                                <div class="owl-carousel owl-theme mt-1">
                                    @foreach($project->images as $index => $img)
                                        <div class="item" style="height: 25vh;border:solid 1px rgba(0,0,0,.3)">
                                            <img src="{{ asset("project_images/". $project->images[$index]->image)}}"
                                                 class="d-block " style="height: 100%;"
                                                 alt="{{$project->title}}">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="title ps-2 pe-2 pb-3">
                                    <h4 class="fs-6 pb-3 mb-2 border-bottom fw-bold">{{$project->title}}...</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
@endsection
@section("script")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset("js/owl.carousel.min.js")}}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            margin: 20,
            autoWidth: true,
            rtl: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            loop: true,
            items: 1,
            center: true,
        })
    </script>
@endsection
