<style>
    table {
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: right;
    }

    .table-responsive {
        max-width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #ccc;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .date-format {
        display: flex;
        justify-content: flex-end;
    }

    .date-format span {
        margin-left: 5px;
    }
    .container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 20px;
}

.card {
    border: 1px solid #ccc;
    border-radius: 10px;
    overflow: hidden;
    width: 300px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    height: fit-content;
}

.card-body {
    padding: 15px;
}

.card-title {
    font-size: 1.2rem;
    margin-bottom: 0;
}

.special-tag {
    height: 14px;
    margin-top: 5px;
}

.price {
    font-size: 1.5rem;
}

.discounted-price {
    text-decoration: line-through;
    color: #868e96;
}

.duration {
    display: block;
    margin-top: 5px;
    color: #495057;
}

.list-group {
    margin: 0;
    padding: 0;
    list-style: none;
}

.list-group-item {
    border: none;
    padding: 10px 15px;
    display: flex;
    align-items: center;
}

.check-icon {
    width: 16px;
    height: 16px;
    margin-right: 10px;
    fill: #28a745;
}

.subscribe-button {
    padding: 10px 20px;
    background-color: #c82333 !important;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    margin-bottom: 10px;
    transition: background-color 0.3s;
}
.pricing {
    margin-top: 15px;
    text-align: center;
}

.monthly-price,
.three-month-price,
.six-month-price {
    display: block;
    margin-bottom: 5px;
    font-size: 0.9rem;
    color: #495057;
}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            {{ __('الباقات') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include("components.includes_user.error")
                @include("components.includes_user.success")
                @include("components.includes_user.message")
                <div class="p-6 text-gray-900 flex" style="flex-direction: column">
                    <?php $count = 0 ?>
                    @foreach($subs as $sub)
                        <div class="table-responsive" style="margin-bottom: 15px">
                            <table>
                                <thead>
                                <tr>
                                    <th>الباقة</th>
                                    <th>العقارات المتبقية</th>
                                    <th>الاعلان المميزة</th>
                                    <th>اعلانات الفيسبوك</th>
                                    <th>اعلانات اليوتيوب</th>
                                    <th>اعلانات جوجل</th>
                                    <th>حالة الطلب</th>
                                    <!--<th>بداية الاشتراك</th>-->
                                    <!--<th>انتهاء الاشتراك</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>@lang("site.".$sub->company_plan->name)</td>
                                    <td>{{$sub->remaining_properties}}</td>
                                    <td>{{$sub->remaining_special}}</td>
                                    <td>{{$sub->remaining_facebook_ads}}</td>
                                    <td>{{$sub->remaining_youtube_ads}}</td>
                                    <td>{{$sub->remaining_google_ads}}</td>
                                    <td>@lang("site.".$sub->status)</td>
                                    <!--<td>-->
                                            <?php
                                            $start_date = \Carbon\Carbon::parse($sub->start_date);
                                            ?>
                                        <!--<div class="date-format">-->
                                        <!--    <span>{{$start_date->format('d')}}</span>-->
                                        <!--    <span class="mx-1">{{$start_date->format('M')}}</span>-->
                                        <!--    <span>{{$start_date->format('Y')}}</span>-->
                                        <!--</div>-->
                                    <!--</td>-->
                                    <!--<td>-->
                                            <?php
                                            $end_date = \Carbon\Carbon::parse($sub->end_date);
                                            ?>
                                        <!--<div class="date-format">-->
                                        <!--    <span>{{$end_date->format('d')}}</span>-->
                                        <!--    <span class="mx-1">{{$end_date->format('M')}}</span>-->
                                        <!--    <span>{{$end_date->format('Y')}}</span>-->
                                        <!--</div>-->
                                    <!--</td>-->
                                </tr>
                                </tbody>
                            </table>
                        </div>
                            <?php $count++ ?>
                    @endforeach
                    <div class="container">
        @foreach($company_plans as $plan)
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h5 class="card-title">@lang("site.".$plan->name)</h5>
                        <h6 class="special-tag">
                            @if($plan->name === "gold")
                                ( ينصح بها )
                            @endif
                        </h6>
                        <span class="price">{{number_format($plan->one_year)}} جنية</span>
                        <br>
                        <span class="duration">سنوي</span>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                        القدرة على إضافة حتى {{$plan->property_num}} مشروع
                    </li>
                    <li class="list-group-item">
                        <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                        {{$plan->special_property_num}} اعلان مميز
                    </li>
                    <li class="list-group-item">
                        <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                        {{$plan->facebook_ads_num <= 10 ?$plan->facebook_ads_num . " اعلانات مدفوعة علي الفيسبوك" : $plan->facebook_ads_num . " اعلان مدفوع علي الفيسبوك"}}
                    </li>
                    @if($plan->header_appear_days)
                        <li class="list-group-item">
                            <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>
                            {{$plan->header_appear_days . " ايام ظهور علي الهيدر العلوي بالموقع" }}
                        </li>
                    @endif
                    @if($plan->slider_appear_days)
                        <li class="list-group-item">
                            <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>
                            {{$plan->slider_appear_days . " ايام ظهور علي السلايدر الخاص بالموقع" }}
                        </li>
                    @endif
                    @if($plan->youtube_ads_num)
                        <li class="list-group-item">
                            <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>
                            {{$plan->youtube_ads_num . " اعلانات يوتيوب" }}
                        </li>
                    @endif
                    @if($plan->google_ads_num)
                        <li class="list-group-item">
                            <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>
                            {{$plan->google_ads_num . " اعلانات جوجل" }}
                        </li>
                    @endif
                </ul>
                          <div class="pricing">
                    <span class="monthly-price">السعر الشهري: {{$plan->price}} جنية</span>
                    <span class="three-month-price">السعر لمدة 3 أشهر: {{$plan->three_month}} جنية</span>
                    <span class="six-month-price">السعر لمدة 6 أشهر: {{$plan->six_month}} جنية</span>
                </div>
                @if(auth()->user() && auth()->user()->account_type === "company")
                    <div class="card-body text-center">
                        <form action="{{route("sub.company.plan")}}" method="post">
                            @csrf
                            @method("post")
                            <input type="hidden" name="plan_id" value="{{$plan->id}}">
                            <button type="submit" class="subscribe-button">اشتراك</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let plans;

    function showPlans(count) {
        plans = document.getElementById(`plans-${count}`);
        plans.style.display = "flex";
    }

    window.onclick = (e) => {
        e.target.classList.contains("plans-container") ? e.target.style.display = "none" : null;
    }
</script>
