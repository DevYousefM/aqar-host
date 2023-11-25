@extends("layouts.main")
@section("content")
    <!-- Start Advertisement -->
    <div style="margin-top:2rem">
        <h2 class="text-center mb-5">أهم الاعلانات</h2>
        <div class="container-fluid d-flex flex-nowrap justify-content-between flex-nowrap">
            @include("advertisements.right")
            <div class="row mx-1 mt-3" style="width: fit-content">
                @foreach($ads as $ad)
                    <div class="col-md-6 col-lg-3 mb-4 position-relative">
                        <div class="specialTag">
                            <strong style="color: red">اعلان مميز</strong>
                            <i class="fas fa-star " style="color: gold"></i>
                        </div>
                        <div class="feat mb-3 rounded">
                            <img class="mb-3 rounded-top col-12" style="height: unset;"
                                 src="{{ asset("property_images/". $ad->images[0]->path)}}" alt="">
                            <div class="title ps-2 pe-2 pb-3">
                                <h4 class="fs-6 pb-3 mb-2 border-bottom fw-bold">{{$ad->title}}...</h4>
                                <p class="text-secondary">{{$ad->brief}}</p>
                                <div class=" d-block m-auto w-50">
                                    <a class="d-block m-auto btn main-btn" style="font-size: 12px"
                                       href="{{route("property.show",$ad->id)}}">قراءة
                                        المزيد</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <nav aria-label="Page navigation example">
                    {{ $ads->links('pagination.custom') }}
                </nav>
            </div>
            @include("advertisements.left")
        </div>
    </div>
@endsection
