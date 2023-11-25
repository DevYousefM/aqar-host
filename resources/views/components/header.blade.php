<div class="header sticky-top bg-white">
    <div class="border-bottom">
        <div class="container">
            <div class="content d-flex justify-content-between pt-3 pb-2">
                <a href="{{route("home")}}"><img src="{{asset("img/logo.svg")}}" alt=""></a>
                <ul class="d-flex gap-2 flex-column flex-lg-row flex-md-row p-0">
                    @if(auth()->user())
                        <li><a class="w-100 btn main-btn fw-bold" href="{{route("property.create")}}">اضافة عقار</a>
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="w-100 btn main-btn fw-bold" onclick="event.preventDefault();
                                        this.closest('form').submit();" href="{{route("logout")}}">تسجيل الخروج</a>
                            </form>
                        </li>
                        <li><a class="w-100 btn main-btn fw-bold" href="{{route('dashboard')}}">الحساب</a></li>
                    @else
                        <li><a class="w-100 btn main-btn fw-bold" href="{{route("register")}}"
                               onclick="localStorage.setItem('current','personal')">انشاء حساب</a></li>
                        <li><a class="w-100 btn main-btn fw-bold" href="{{route("login")}}">تسجيل الدخول</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg light pt-3 shadow bg-white rounded">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav fw-bold">
                    <li class="nav-item">
                        <a class="nav-link links" aria-current="page" href="{{route("home")}}">الرئيسية</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link links" href="{{route("show.articles")}}">اخبار العقارات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link links" href="{{route("companies.show")}}">شركات العقارات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link links" href="{{route("search_request_form.show")}}">مش لاقي شقتك؟</a>
                    </li>
                </ul>
                <ul class="call d-flex justify-content-end fw-bold navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link links" href="{{route("call.us")}}">اتصل بنا</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
