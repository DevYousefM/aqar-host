@extends("layouts.main")
@section("title")
    {{$article->title_seo}}
@endsection
@section("content")
    <div class="mb-5 " style="background-image: url({{asset('img/footer.jpg')}})">
        <div class="px-4 py-5 text-center text-white col-12" style="height: 100%;backdrop-filter: brightness(0.5);">

            <h1 class="display-5 fw-bold">{{$article->title}}</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">{{$article->brief}}</p>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex flex-nowrap adpage justify-content-between flex-nowrap" style="">
        @include("advertisements.right")

        <div class="container reset-this">
            <div class="d-flex col-12 justify-content-center">

                <img
                    alt="{{$article->image_alt}}" style="height: 300px;width: 80%; display: block;"
                    src="{{asset($article->image)}}">
            </div>
            {!! $article->body !!}
        </div>
        @include("advertisements.left")
    </div>
@endsection
