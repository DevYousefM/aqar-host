@extends('layouts.main')
@section('content')
    <!-- Start Sign In -->
    <div class="back-gr">
        <h1 class="pe-5 pt-5 text-white">تسجيل الدخول</h1>
    </div>

    <div class="sign-in pt-3 m-auto mt-5 mb-5">
        <div class="container">
            <div class="box">
                <h4 class="border-bottom border-2 border-danger pb-1 d-inline-block">أستعادة كلمة السر :</h4>
                <form class="d-flex flex-column align-items-center gap-2" method="POST"
                    action="{{ route('password.store') }}">
                    @method('POST')
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">


                    <input value="{{ request('email') }}" class="w-75 p-1 border" type="hidden" name="email">

                    <label class="mt-2" for="password">ادخل كلمة السر الجديدة</label>
                    <input value="{{ old('password') }}" class="w-75 p-1 border text-center" type="password"
                        name="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="password_confirmation">اعد ادخال كلمة السر</label>
                    <input value="{{ old('password_confirmation') }}" class="w-75 p-1 border text-center" type="password"
                        name="password_confirmation">
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    @error('result')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <button class="btn sec-main-btn mt-3 fw-bold mb-3" type="submit">أستعادة كلمة المرور</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Sign In -->
@endsection
