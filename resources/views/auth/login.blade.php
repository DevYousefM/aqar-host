@extends("layouts.main")
@section("content")
    <!-- Start Sign In -->
    <div class="back-gr">
        <h1 class="pe-5 pt-5 text-white">تسجيل الدخول</h1>
    </div>

    <div class="sign-in pt-3 m-auto mt-5 mb-5">
        <div class="container">
            <div class="box">
                <h4 class="border-bottom border-2 border-danger pb-1 d-inline-block">تسجيل الدخول :</h4>
                <form class="d-flex flex-column align-items-center gap-2" action="{{route("login")}}" method="post">
                    @method("POST")
                    @csrf
                    <label class="mt-2" for="email">البريد الالكترونى</label>
                    <input value="{{old("email")}}" class="w-75 p-1 border" type="email" name="email">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="password">كلمة المرور</label>
                    <div class="pass-con">
                        <input value="{{old("password")}}" class="w-75 p-1 border " type="password"
                               name="password">
                        <span class="pass-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                             height="16" fill="currentColor"
                             class="bi bi-eye"
                             viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                        </svg>
                    </span>
                    </div>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <button class="btn sec-main-btn mt-3 fw-bold" type="submit">تسجيل دخول</button>
                    <div class="title mb-5 d-flex flex-column gap-2 align-items-center">
                        <a class="fw-bold" href="{{route("password.request")}}">هل نسيت كلمة المرور ؟</a>
                        <p>لا تملك حساب ؟ <a class="fw-bold" href="{{route("register")}}">سجل الان </a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Sign In -->

@endsection
