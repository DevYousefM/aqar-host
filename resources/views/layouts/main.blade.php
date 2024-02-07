<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <title>عقار مصر</title>
    <meta name="keywords"
    content="عقار-مصر, عقارات-للبيع-مصر, شقق-للبيع-من-المالك,
    بيع-عقارات-فى-مصر, شراء-عقارات-فى-مصر, عقارات-للبيع-فى-مصر,
    عقارات-للشراء-فى-مصر, سوق-العقارات-المصرية, شقق-للبيع-فى-مصر, فلل-للبيع-فى-مصر,
    اراضى-للبيع-فى-مصر, استثمار-عقارى-فى-مصر, عقار-مصر, وحدات-للبيع, شقق-للبيع-فى-القاهرة
    , شقق-استلام-فورى, شقق-للبيع-من-المالك-مباشر, افضل-موقع-للعقارات-فى-مصر, سمسار-مصر
    , شقق-للبيع-فى-القاهرة-بالتقسيط, شقق-للايجار-فى-مصر, عقار-مصر-للايجار, بيع-وحدتى,
    مواقع-بيع-العقارات-فى-مصر, بيع-شقتى, افضل-مواقع-بيع-عقارات, اسرع-موقع-لبيع-العقارات ">
    <meta property="image" content="https://aqar-masr.com/img/logo.png" />
    @yield('description')
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @yield('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&family=Parisienne&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Start Header -->
    @include('components.header')
    <!-- End Header -->
    @yield('content')

    <!-- Start Footer -->
    @include('components.footer')
    <!-- End Footer -->
    <!-- End Advertisement -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-050PDDFFXJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-050PDDFFXJ');
    </script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('script')

</body>

</html>
