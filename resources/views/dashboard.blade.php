<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            {{ __('أعلاناتك') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include("components.includes_user.error")
                @include("components.includes_user.success")
                @include("components.includes_user.message")
                <div class="p-6 text-gray-900 " style="display: flex;gap: 10px">
                    <?php $count = 0 ?>
                    @foreach($properties as $property)
                        <div style="width: 20rem" class="rounded overflow-hidden shadow-lg">
                            <img class="w-full" style="height: 10rem;"
                                 src="{{ asset("property_images/". $property->images[0]->path)}}"
                            >
                            <div class="px-6 py-4">
                                <div
                                    class="font-bold text-xl mb-2 text-right">{{$property->title}} {{$property->is_special ? "(مميز)" : null}}</div>
                            </div>
                            <div style="display: flex;justify-content: space-evenly;margin: 10px">
                                <x-primary-button style="background-color: red">
                                    <a href="{{route("property.show",$property->id)}}">
                                        {{ __('عرض العقار') }}
                                    </a>
                                </x-primary-button>
                                @if(auth()->user()->account_type === "personal")
                                    <div onclick="showPlans({{$count}})">
                                        <x-primary-button style="background-color: red">
                                            {{ __('تمويل العقار') }}
                                        </x-primary-button>
                                    </div>
                                @endif
                            </div>
                            <p style="margin-bottom: 10px;text-align: center;font-size: 18px">
                                المدة المتبقية
                                للاعلان: {{45 - \Carbon\Carbon::now()->diffInDays($property->created_at)}} يوم
                            </p>
                            @if( (45 - \Carbon\Carbon::now()->diffInDays($property->created_at)) < 16)
                                <div style="display: flex;justify-content: space-evenly;margin: 10px">
                                    <x-primary-button style="background-color: red">
                                        <a href="{{route("property.reset",$property->id)}}">
                                            {{ __('تجديد المدة') }}
                                        </a>
                                    </x-primary-button>
                                </div>
                            @endif
                            <p style="margin-bottom: 10px;text-align: center;font-size: 18px">
                                عدد زيارات صفحة
                                العقار: {{$property->seen}} زيارات
                            </p>
                        </div>
                        @if(auth()->user()->account_type === "personal")

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
                        @endif
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
