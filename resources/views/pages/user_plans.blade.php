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
                                    <th>بداية الاشتراك</th>
                                    <th>انتهاء الاشتراك</th>
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
                                    <td>
                                            <?php
                                            $start_date = \Carbon\Carbon::parse($sub->start_date);
                                            ?>
                                        <div class="date-format">
                                            <span>{{$start_date->format('d')}}</span>
                                            <span class="mx-1">{{$start_date->format('M')}}</span>
                                            <span>{{$start_date->format('Y')}}</span>
                                        </div>
                                    </td>
                                    <td>
                                            <?php
                                            $end_date = \Carbon\Carbon::parse($sub->end_date);
                                            ?>
                                        <div class="date-format">
                                            <span>{{$end_date->format('d')}}</span>
                                            <span class="mx-1">{{$end_date->format('M')}}</span>
                                            <span>{{$end_date->format('Y')}}</span>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                            <?php $count++ ?>
                    @endforeach
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
