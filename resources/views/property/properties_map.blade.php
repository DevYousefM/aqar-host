@extends('layouts.main')
@section('title')
    <title>عقار مصر | خريطة العقارات</title>
@endsection
@section('description')
    <meta property="description"
        content="خدمات عقار مصر هي خدمه مجانية تساعدك على بيع وشراء العقارات بسهولة
        و توصلك بالبائع مباشرةً بدون اي وسيط وتزودك بالمعلومات الاساسية لإتخاذ واحد من أهم
        القرارات المالية في حياتك">
@endsection
@section('content')
    <!-- Start Nearby Properties -->
    <div class="advertisement" id="nearby">
        <div class="col-12">
            <h2 class="text-center mb-5">عقارات قريبة منك</h2>
            <div id="map" style="height: 500px; width: 100%;"></div>

        </div>
    </div>
@endsection
@section('script')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/nearby-properties.js') }}"></script>
@endsection
