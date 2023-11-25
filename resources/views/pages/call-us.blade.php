@extends("layouts.main")

@section("content")
    <!--Start Call Us -->
    <div class="call-us">
        <div class="container">
            <div class="text-center dark-grey-text mb-5">
                <div class="card">
                    <div class="card-body rounded-top border-top p-5">
                        @include("components.includes.success")
                        <h3 class="font-weight-bold my-4">اتصل بنا</h3>
                        <p class="font-weight-light mx-auto mb-4 pb-2" style="color: #428283;font-weight: bold;">نتشرف و
                            نتقبل استفساراتكم و مقترحاتكم لنطور خدمتنا للافضل</p>
                        <form class="mb-4 mx-md-5 contact" method="POST" action="{{route("send.message")}}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="text" class="w-100 p-1 border" placeholder="الاسم الاول"
                                           name="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <input type="text" class="w-100 p-1 border" placeholder="الاسم الاخير"
                                           name="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="email" class="w-100 p-1 border" placeholder="البريد الاكتروني"
                                           name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <select class="w-100 border text-danger" aria-label="Default select example"
                                            name="category" required>
                                        <option value="1" selected>استفسار</option>
                                        <option value="2">اقتراح</option>
                                        <option value="3">اخر</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <input type="text" class="w-100 p-1 border" placeholder="عنوان الرسالة"
                                           name="subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <textarea class="rounded w-100 p-1 border" id="message" rows="3"
                                                  placeholder="الرسالة؟" name="message"
                                                  required>{{ old('message') }}</textarea>
                                        @error('message')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-md text-white">ارسال</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Call Us-->
@endsection
