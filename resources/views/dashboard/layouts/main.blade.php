<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Aqar Masr</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset("dashboard/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("dashboard/dist/css/adminlte.min.css")}}">
    <link rel="stylesheet" href="{{asset("dashboard/css/bootstrap_rtl-v4.2.1/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("dashboard/css/bootstrap_rtl-v4.2.1/custom_rtl.css")}}">
    <link rel="stylesheet" href="{{asset("dashboard/css/mycustomstyle.css")}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Cairo', sans-serif;
        }
    </style>
    @yield("css")
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    @include("dashboard.components.navbar")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("dashboard.components.sidepar")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield("content")
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset("dashboard/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("dashboard/dist/js/adminlte.min.js")}}"></script>
@yield("script")
</body>
</html>
