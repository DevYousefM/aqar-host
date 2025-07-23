@extends('layouts.main')
@section('title')
    <title>عقار مصر | مش القي شقتك ؟</title>
@endsection
@section('description')
    <meta property="description"
        content="دلوقتي على عقار مصر هتقدر تدخل بيانات الشقة اللي انت بتدور عليها و لو
        كانت مش متاحة هنتواصل معاك بوجود فرص مشابهة لطلباتك">
@endsection
@section('content')
    <!-- Start Sign In -->
    <div class="back-gr">
        <h3 class="pe-5 pt-5 text-white text-center">قم بتسجيل بيانات العقار الذي تحتاجه وسوف نقوم بالبحث نيابة عنك</h3>
    </div>
    @if (session('success'))
        <div class="container mt-5">
            <div id="success" style="padding: 20px;background-color: #198754;color: white"
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert"><span
                    class="block sm:inline" style=" padding-right: 2rem; ">{{ session('success') }}</span></div>
        </div>
    @endif

    <div class="sign-in pt-3 m-auto mt-5 mb-5">
        <div class="container">

            <div class="box">
                <h4 class="border-bottom border-2 border-danger pb-1 d-inline-block"> بيانات العقار المطلوب :</h4>
                <form class="d-flex flex-column align-items-center gap-2" method="POST"
                    action="{{ route('store.request') }}">
                    @method('POST')
                    @csrf
                    <label class="mt-2" for="type">نوع العقار</label>
                    <select name="type" id="type" class="w-75 p-1 border">
                        <option value='0'>اختر نوع العقار</option>
                        <option value='شقق'>شقق</option>
                        <option value='محلات'>محلات</option>
                        <option value='اراضى'>اراضى</option>
                        <option value='ارضي بجنينة'>ارضي بجنينة</option>
                        <option value='ادارى'>ادارى</option>
                        <option value='مبانى'>مبانى</option>
                        <option value='روف'>روف</option>
                        <option value='فيلا'>فيلا</option>
                        <option value='سكن الطلبة'>سكن الطلبة</option>
                    </select>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="meters">المساحة (بالمتر)</label>
                    <input value="{{ old('meters') }}" class="w-75 p-1 border" type="number" name="meters">
                    @error('meters')
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

                    <label class="mt-2" id="rooms_title" for="rooms">عدد الغرف</label>
                    <input value="{{ old('rooms') }}" id="rooms" class="w-75 p-1 border" type="number" name="rooms">
                    @error('rooms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="contract_type">نوع التعاقد</label>
                    <select name="contract_type" id="contract_type" class="w-75 p-1 border">
                        <option value='تمليك'>تمليك</option>
                        <option value='ايجار'>ايجار</option>
                    </select>
                    @error('contract_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div id="price" style="display: flex !important;"
                        class="flex-column align-items-center gap-2 w-100">
                        <label class="mt-2" for="price">السعر</label>
                        <input value="{{ old('price') }}" class="w-75 p-1 border" type="number" name="price">
                    </div>
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <button class="btn sec-main-btn mt-3 mb-3 fw-bold" type="submit">ارسال</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Sign In -->
@endsection
