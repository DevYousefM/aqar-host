@extends('layouts.main')
@section('content')
    <!-- Start Sign In -->
    <div class="back-gr">
        <h1 class="pe-5 pt-5 text-white">انشاء حساب</h1>
    </div>

    <div class="sign-in pt-3 m-auto mt-5 mb-5">
        <div class="container">
            <div class="box">
                <h4 class="border-bottom border-2 border-danger pb-1 d-inline-block"> أضافة عقار :</h4>
                @include('components.includes.success')
                @include('components.includes.error')

                <form class="d-flex flex-column align-items-center gap-2" method="POST" action="{{ route('property.store') }}"
                    enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <label class="mt-2" for="title">العنوان</label>
                    <input value="{{ old('title') }}" class="w-75 p-1 border" type="text" name="title">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="brief">نبذه عن العقار</label>
                    <textarea class="w-75 p-1 border" name="brief">{{ old('brief') }}</textarea>
                    @error('brief')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="type">نوع العقار</label>
                    <select name="type" id="type" class="w-75 p-1 border">
                        <option value='0'>اختر نوع العقار</option>
                        <option value='شقق'>شقق</option>
                        <option value='محلات'>محلات</option>
                        <option value='اراضى'>اراضى</option>
                        <option value='ارضى'>ارضى</option>
                        <option value='ارضى بجنينة'>ارضى بجنينة</option>
                        <option value='ادارى'>ادارى</option>
                        <option value='مبانى'>مبانى</option>
                        <option value='روف'>روف</option>
                        <option value='فيلا'>فيلا</option>
                        <option value='سكن الطلبة'>سكن الطلبة</option>
                    </select>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="purpose">الغرض</label>
                    <select name="purpose" id="purpose" class="w-75 p-1 border">
                        <option value='بيع'>بيع</option>
                        <option value='شراء'>شراء</option>
                        <option value='ايجار'>ايجار</option>
                    </select>
                    @error('purpose')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="gov">المحافظة</label>
                    <select name="gov" id="govs" class="w-75 p-1 border">
                        <option value='1'>القاهرة</option>
                    </select>
                    @error('gov')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="area">المنطقة</label>
                    <select name="area" id="areas" class="w-75 p-1 border">
                    </select>
                    @error('area')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" id="level_title" for="level">الدور</label>
                    <select name="level" id="level" class="w-75 p-1 border">
                    </select>
                    @error('level')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror


                    <label class="mt-2" id="rooms_title" for="rooms">عدد الغرف</label>
                    <input value="{{ old('rooms') }}" id="rooms" class="w-75 p-1 border" type="number" name="rooms">
                    @error('rooms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="meters">المساحة (بالمتر)</label>
                    <input value="{{ old('meters') }}" class="w-75 p-1 border" type="number" name="meters">
                    @error('meters')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="payment" id="title_payment">اسلوب الدفع</label>
                    <select name="payment" id="payment" class="w-75 p-1 border">
                        <option value="0" selected>
                            اختر اسلوب الدفع
                        </option>
                        <option value="كاش" {{ old('payment') === 'كاش' ? 'selected' : '' }}>
                            كاش
                        </option>
                        <option value="قسط" {{ old('payment') === 'قسط' ? 'selected' : '' }}>
                            قسط
                        </option>
                    </select>
                    @error('payment')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div id="presenter" class="d-none flex-column align-items-center gap-2 w-100">
                        <label class="mt-2" for="presenter">قيمة المقدم</label>
                        <input value="{{ old('presenter') }}" class="w-75 p-1 border" type="number" name="presenter">
                        @error('presenter')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="price" class="d-none flex-column align-items-center gap-2 w-100">
                        <label class="mt-2" for="price">السعر</label>
                        <input value="{{ old('price') }}" class="w-75 p-1 border" type="number" name="price">
                    </div>
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="images">صور العقار</label>
                    <input value="{{ old('images') }}" id="propertyImages" class="w-75 p-1 border" type="file"
                        name="images[]" multiple>
                    @error('images')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div id="imageFilenames" class="d-flex gap-3"></div>

                    @if (auth()->user()->has_special)
                        <div class="form-checkbox ">
                            <input class="p-1 m-1 border" {{ old('is_special') ? 'checked' : '' }} type="checkbox"
                                name="is_special">
                            <label class="mt-2" for="meters">تحديد الاعلان كمميز</label>
                        </div>
                        @error('is_special')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    @endif
                    <button class="btn sec-main-btn mt-3 mb-3 fw-bold" type="submit">اضافة العقار</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Sign In -->
@endsection
