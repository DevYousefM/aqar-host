@extends('layouts.main')
@section('content')
    <!-- Start Sign In -->
    <div class="back-gr">
        <h1 class="pe-5 pt-5 text-white">اضافة عقار </h1>
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
                        <option value="شقق مصيفية">شقق مصيفية</option>
                        <option value="شاليهات">شاليهات</option>
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


                    <label class="mt-2" for="location_url">رابط موقع العقار</label>
                    <div class="d-flex align-items-center w-75">
                        <input id="location_url" value="{{ old('location_url') }}" class="p-1 border flex-grow-1"
                            type="text" name="location_url" readonly>
                        <button type="button" class="btn btn-outline-success ms-2" id="openMapBtn">
                            📍 اختر من الخريطة
                        </button>
                    </div>

                    @error('location_url')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <!-- Map Modal -->
                    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="إغلاق"></button>
                                    <h5 class="modal-title text-right">اختر موقع العقار</h5>
                                </div>
                                <div class="modal-body">
                                    <div id="map" style="height: 400px;"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <label class="mt-2" id="level_title" for="level">الدور</label>
                    <select name="level" id="level" class="w-75 p-1 border">
                    </select>
                    @error('level')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror


                    <label class="mt-2" id="rooms_title" for="rooms">عدد الغرف</label>
                    <input value="{{ old('rooms') }}" id="rooms" class="w-75 p-1 border" type="number"
                        name="rooms">
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
                    @if ($errors->has('images.*'))
                        <ul>
                            @foreach ($errors->get('images.*') as $index => $errorMessages)
                                @foreach ($errorMessages as $error)
                                    <li>الصورة {{ (int) $index + 1 }}: {{ $error }}</li>
                                @endforeach
                            @endforeach
                        </ul>
                    @endif

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
@section('script')
    <!-- Bootstrap Modal (لو مش محمل في layout) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var map, marker;

            document.getElementById("openMapBtn").addEventListener("click", function() {
                var modal = new bootstrap.Modal(document.getElementById('mapModal'));
                modal.show();

                if (!map) {
                    map = L.map('map').setView([30.0444, 31.2357], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    map.on('click', function(e) {
                        var lat = e.latlng.lat;
                        var lng = e.latlng.lng;

                        if (marker) {
                            map.removeLayer(marker);
                        }

                        marker = L.marker([lat, lng]).addTo(map);

                        document.getElementById('location_url').value =
                            `https://www.google.com/maps?q=${lat},${lng}`;
                    });
                }

                setTimeout(() => {
                    map.invalidateSize();
                }, 200);
            });
        });
    </script>
@endsection
