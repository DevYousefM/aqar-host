<style>
    table {
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: right;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            {{ __('طلبات التمويل') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include("components.includes_user.error")
                @include("components.includes_user.success")
                @include("components.includes_user.message")
                <div class="p-6 text-gray-900 flex" style="justify-content: space-between;flex-wrap: wrap">
                    <?php $count = 0 ?>
                    @foreach($requests as $request)
                        <div style="width: 20rem" class="rounded overflow-hidden shadow-lg">
                            <img class="w-full" style="height: 10rem;"
                                 src="{{ asset("property_images/". $request->property->images[0]->path)}}"
                            >
                            <table class="mt-1">
                                <tr>
                                    <th>عدد ايام ظهور الاعلان مميز</th>
                                    <td>{{$request->user_plan->days_num == 2 ? "يومين" : $request->user_plan->days_num . " ايام "}}</td>
                                </tr>
                                <tr>
                                    <th>ظهور على السوشيال ميديا في المنطقة المستهدفة</th>
                                    <td>{{number_format($request->user_plan->social_media_appear)}}</td>
                                </tr>
                                <tr>
                                    <th>سعر الباقة</th>
                                    <td>{{$request->user_plan->price . " جنية "}}</td>
                                </tr>
                            </table>
                            <table class="mt-1 " style="width: 100%">
                                <tr>
                                    <th>تاريخ الطلب</th>
                                    <td>
                                        {{$request->created_at->format("Y-m-d")}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>حالة الطلب</th>
                                    <td>
                                        @lang("site.".$request->status)
                                    </td>
                                </tr>
                                @if($request->start_date !== null)
                                    <tr>
                                        <th>بداية الاشتراك</th>
                                        <td>{{$request->start_date}}</td>
                                    </tr>
                                @endif
                                @if($request->expire_date !== null)
                                    <tr>
                                        <th>انتهاء الاشتراك</th>
                                        <td>{{$request->expire_date}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>سعر الباقة</th>
                                    <td>{{$request->user_plan->price . " جنية "}}</td>
                                </tr>
                            </table>
                            <div style="display: flex;justify-content: space-evenly;margin: 10px">
                                <x-primary-button style="background-color: red">
                                    <a href="{{route("property.show",$request->property->id)}}">
                                        {{ __('عرض العقار') }}
                                    </a>
                                </x-primary-button>
                            </div>
                        </div>
                        <div id="plans-{{$count}}" class="min-h-screen space-x-4 w-full plans-container">
                            @foreach($user_plans as $plan)
                                <div class="bg-white  rounded-lg shadow-md px-3 py-4"
                                     style="width: 250px;margin: 8px">
                                    <div class="text-right mb-4">
                                        <p class="font-bold">تفاصيل الباقة</p>
                                        <ul class="ml-4 mt-2">
                                            <li>- ظهور الاعلان
                                                لمدة {{$plan->days_num  == 2 ? "يومين": $plan->days_num . " أيام "}}
                                                كإعلان مميز
                                            </li>
                                            <br>
                                            <li>
                                                {{number_format($plan->social_media_appear)}}
                                                ظهور على
                                                السوشيال ميديا في المنطقة المستهدفة
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="text-gray-600 font-semibold">السعر : {{$plan->price}} جنية </p>

                                    <form action="{{route("make.property.request")}}"
                                          method="post"
                                          style="display: flex;justify-content: center;margin-top: 14px;">
                                        @csrf
                                        @method("post")
                                        <input type="hidden" name="user_plan_id" value="{{$plan->id}}">
                                        <input type="hidden" name="property_id" value="{{$property->id}}">
                                        <x-primary-button type="submit" style="background-color: red">
                                            {{ __('اختيار') }}
                                        </x-primary-button>
                                    </form>
                                </div>
                            @endforeach
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
