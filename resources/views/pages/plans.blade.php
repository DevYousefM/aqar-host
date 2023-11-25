@extends("layouts.main")
@section("css")
    <style>
        .row:after {
            content: unset;
        }
    </style>
@endsection
@section("content")
    <!-- Start Advertisement -->
    <div style="margin-top:2rem">
        <div class="container-fluid d-flex flex-nowrap justify-content-between flex-nowrap">
            @include("advertisements.right")
            <div class="row mx-1 justify-content-between">
                <h2 class="text-center mb-4">باقات تمويل الاعلانات للافراد</h2>
                @foreach($user_plans as $plan)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-lg">
                            <div class="card-body" style="flex: none">
                                <div class="text-center ">
                                    <span class="h2">{{$plan->price}} جنية </span>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush pe-1">

                                <li class="list-group-item" style="padding: 15px 10px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                    </svg>
                                    ظهور الاعلان لمدة
                                    <strong
                                        style="font-size: 14px">{{$plan->days_num == 2 ? "يومين" : $plan->days_num . "أيام "}}</strong>
                                    كإعلان مميز
                                </li>
                                <li class="list-group-item" style="padding: 15px 10px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                    </svg>
                                    <h5 style="display: inline">{{number_format($plan->social_media_appear)}}</h5> ظهور
                                    على السوشيال ميديا في
                                    المنطقة
                                    المستهدفة
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
                <h2 class="text-center mb-4">باقات الشركات</h2>
                @foreach($company_plans as $plan)
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card h-100 shadow-lg">
                            <div class="card-body" style="flex: none">
                                <div class="text-center p-3">
                                    <h5 class="card-title">@lang("site.".$plan->name)
                                    </h5>
                                    <h6 style="height: 14px">
                                        @if($plan->name === "gold")
                                            ( ينصح بها )
                                        @endif
                                    </h6>

                                    <span
                                        class="h4">{{number_format($plan->price). " جنية "}}</span>
                                    <span
                                        style="text-decoration: line-through">{{number_format($plan->last_price). " جنية "}}</span>
                                    <br>
                                    <span>سنوي</span>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush" style="padding-right: 0;">
                                <li class="list-group-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                    </svg>
                                    القدرة علي اضافة حتي {{$plan->property_num}} مشروع
                                </li>
                                <li class="list-group-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                    </svg>
                                    {{$plan->special_property_num}} اعلان مميز
                                </li>
                                <li class="list-group-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                    </svg>
                                    {{$plan->facebook_ads_num <= 10 ?$plan->facebook_ads_num . " اعلانات مدفوعة علي الفيسبوك" : $plan->facebook_ads_num . " اعلان مدفوع علي الفيسبوك"}}
                                </li>
                                @if($plan->header_appear_days)
                                    <li class="list-group-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-check" viewBox="0 0 16 16">
                                            <path
                                                d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                        </svg>
                                        {{$plan->header_appear_days . " ايام ظهور علي الهيدر العلوي بالموقع" }}
                                    </li>
                                @endif
                                @if($plan->slider_appear_days)
                                    <li class="list-group-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-check" viewBox="0 0 16 16">
                                            <path
                                                d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                        </svg>
                                        {{$plan->slider_appear_days . " ايام ظهور علي السلايدر الخاص بالموقع" }}
                                    </li>
                                @endif
                                @if($plan->youtube_ads_num)
                                    <li class="list-group-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-check" viewBox="0 0 16 16">
                                            <path
                                                d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                        </svg>
                                        {{$plan->youtube_ads_num . " اعلانات يوتيوب" }}
                                    </li>
                                @endif
                                @if($plan->google_ads_num)
                                    <li class="list-group-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-check" viewBox="0 0 16 16">
                                            <path
                                                d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                        </svg>
                                        {{$plan->google_ads_num . " اعلانات جوجل" }}
                                    </li>
                                @endif
                            </ul>
                            @if(auth()->user() && auth()->user()->account_type === "company")
                                <div class="card-body text-center"
                                     style="display: flex; flex-direction: column; align-items: center; justify-content: flex-end;">
                                    <form action="{{route("sub.company.plan")}}" method="post">
                                        @csrf
                                        @method("post")
                                        <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                        <button type="submit" class="btn btn-outline-danger btn-lg"
                                                style="border-radius:30px">اشتراك
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            @include("advertisements.left")
        </div>
    </div>
@endsection
