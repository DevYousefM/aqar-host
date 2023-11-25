<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aqar Masr Dashboard | Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{asset("dashboard/plugins/fontawesome-free/css/all.min.css")}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset("dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("dashboard/dist/css/adminlte.min.css")}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">تسجيل الدخول</p>

            <form action="{{ route('admin.store') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text rounded-pill" style="border: 1px solid gray;">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <input style="border: 1px solid gray;" type="email" name="email" value="{{ old('email') }}"
                           class="form-control text-right" placeholder="البريد الإلكتروني">
                </div>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text rounded-pill" style="border: 1px solid gray;">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <input style="border: 1px solid gray;" type="password" name="password"
                           class="form-control text-right"
                           placeholder="كلمة المرور">
                </div>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">دخول</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset("dashboard/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

</body>
</html>
