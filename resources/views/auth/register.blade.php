@extends("layouts.main")
@section("content")
    <!-- Start Sign In -->
    <div class="back-gr">
        <h1 class="pe-5 pt-5 text-white">انشاء حساب</h1>
    </div>

    <div class="sign-in pt-3 m-auto mt-5 mb-5">
        <div class="container">
            <div class="box">
                <h4 class="border-bottom border-2 border-danger pb-1 d-inline-block"> حساب جديد :</h4>
                <ul class="nav nav-tabs justify-content-center mb-4">
                    <li class="nav-item">
                        <div class="nav-link active" style="cursor: pointer" id="per_tap">حساب فرد</div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link " style="cursor: pointer" id="com_tap">حساب شركة</div>
                    </li>
                </ul>
                <form class="d-flex flex-column align-items-center gap-2" method="POST" action="{{route("register")}}"
                      id="personal" enctype="multipart/form-data">
                    @method("POST")
                    @csrf
                    <label class="mt-2" for="name">الأسم</label>
                    <input value="{{old("name")}}" class="w-75 p-1 border" type="text" name="name">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="email">البريد الالكترونى</label>
                    <input value="{{old("email")}}" class="w-75 p-1 border" type="email" name="email">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="phone">رقم الهاتف</label>
                    <input value="{{old("phone")}}" class="w-75 p-1 border" type="tel" name="phone">
                    @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="phone_second">رقم هاتف ثانوي (أختياري)</label>
                    <input value="{{old("phone_second")}}" class="w-75 p-1 border" type="tel" name="phone_second">
                    @error('phone_second')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <label class="mt-2" for="images">صورة الحساب</label>
                    <input value="{{old("image")}}" id="propertyImages" class="w-75 p-1 border" type="file"
                           name="image">
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div id="imageFilenames" class="d-flex gap-3"></div>
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

                    <label class="mt-2" for="password_confirmation">تأكيد كلمة المرور</label>
                    <div class="pass-con">
                        <input value="{{old("password_confirmation")}}" class="w-75 p-1 border pass-input"
                               type="password"
                               name="password_confirmation"
                        >
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
                    @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <input type="hidden" name="account_type" value="personal">
                    <button class="btn sec-main-btn mt-3 fw-bold" type="submit">انشاء الحساب</button>
                    <div class="title mb-5 d-flex flex-column gap-2 align-items-center">
                        <p>تسجيل الدخول ؟ <a class="fw-bold" href="{{route("login")}}">هل لديك حساب بالفعل؟</a></p>
                    </div>
                </form>
                <form class="d-none flex-column align-items-center gap-2" method="POST"
                      action="{{route("register")}}" id="company" enctype="multipart/form-data">
                    @method("POST")
                    @csrf
                    <label class="mt-2" for="name">الأسم</label>
                    <input value="{{old("name")}}" class="w-75 p-1 border" type="text" name="name">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="company_name">أسم الشركة</label>
                    <input value="{{old("company_name")}}" class="w-75 p-1 border" type="text" name="company_name">
                    @error('company_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="company_brief">نبذة عن الشركة</label>
                    <textarea name="company_brief" class="w-75 p-1 border">{{old("company_brief")}}</textarea>
                    @error('company_brief')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="company_type">نوع الشركة</label>
                    <input value="{{old("company_type")}}" class="w-75 p-1 border" type="text" name="company_type">
                    @error('company_type')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="email">البريد الالكترونى</label>
                    <input value="{{old("email")}}" class="w-75 p-1 border" type="email" name="email">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="location">الموقع (أختياري)</label>
                    <input value="{{old("location")}}" class="w-75 p-1 border" type="text" name="location">
                    @error('location')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="phone">رقم الهاتف</label>
                    <input value="{{old("phone")}}" class="w-75 p-1 border" type="tel" name="phone">
                    @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <label class="mt-2" for="images">صورة الحساب</label>
                    <input value="{{old("image")}}" id="" class="w-75 p-1 border" type="file"
                           name="image">
                    @error('image')
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

                    <label class="mt-2" for="password_confirmation">تأكيد كلمة المرور</label>
                    <div class="pass-con">
                        <input value="{{old("password_confirmation")}}" class="w-75 p-1 border pass-input"
                               type="password"
                               name="password_confirmation"
                        >
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
                    @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="hidden" name="account_type" value="company">
                    <button class="btn sec-main-btn mt-3 fw-bold" type="submit">انشاء الحساب</button>
                    <div class="title mb-5 d-flex flex-column gap-2 align-items-center">
                        <p>تسجيل الدخول ؟ <a class="fw-bold" href="{{route("login")}}">هل لديك حساب بالفعل؟</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Sign In -->
@endsection
