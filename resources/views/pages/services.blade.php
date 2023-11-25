@extends("layouts.main")
@section("css")
    <style>
        .row:after {
            content: unset;
        }
    </style>
@endsection
@section("content")
    @php
        $services_arr = ["add_properties_service",
                "header_service",
                "slider_service",
                "youtube_service",
                "google_service",
                "facebook_service"];
    @endphp
        <!-- Start Advertisement -->
    <div style="margin-top:2rem">
        @include("components.includes.error")
        @include("components.includes.success")
        @include("components.includes.message")
        <div class="container-fluid d-flex flex-nowrap justify-content-between flex-nowrap">

            @include("advertisements.right")
            <div class="row mx-1 justify-content-center">
                <h2 class="text-center mb-4">الخدمات المنفصلة</h2>
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card h-100 shadow-lg">
                            <div class="card-body" style="flex: none">
                                <div class="text-center p-3">
                                    <h5 class="card-title">@lang("site.".$service->name)
                                    </h5>
                                    <span
                                        class="h5">{{number_format($service->price). " جنية "}}</span>
                                    <br>
                                </div>
                            </div>

                            @if(auth()->user())
                                @if($service->name === "special_property_service")
                                    <h6 class="text-danger text-center">يتم اختيار هذه الخدمة من الحساب الشخصي عند تمويل
                                        العقار</h6>
                                @endif
                                @if(in_array($service->name , $services_arr))
                                    <div class="card-body text-center"
                                         style="display: flex; flex-direction: column; align-items: center; justify-content: flex-end;">
                                        <form action="{{route("subscribe.single.service",$service->id)}}" method="post">
                                            @csrf
                                            @method("post")
                                            <button type="submit" class="btn btn-outline-danger btn-lg"
                                                    style="border-radius:30px">اشتراك
                                            </button>
                                        </form>
                                    </div>

                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
                @if(!(auth()->user()))
                    <h5 class="text-center text-success">ينبغي التسجيل في الموقع للاشتراك في الخدمات المنفصلة</h5>
                @endif
            </div>
            @include("advertisements.left")
        </div>
    </div>

@endsection
