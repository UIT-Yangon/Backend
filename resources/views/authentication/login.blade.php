<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    <style>
        html, body {
            background-color: #d6eff4 !important;
        }
        .card-body {
            background-color: #3798A6 !important;
        }
        * {
            overflow-y: hidden;
        }
    </style>
</head>
<body>
    <div class="main-panel">
            <div class="col-6 offset-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title" style="text-align: center;">Login Form</h3>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form class="forms-sample" method="POST" action="{{ route('admin#login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-size: 16px !important;">Email address<span class="text-danger">*</span></label>
                                <input type="email" class="form-control bg-white border-0 text-dark" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" style="font-size: 16px !important;">Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control bg-white border-0 text-dark" id="exampleInputPassword1" placeholder="Password" name="password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-dark mr-2 px-4 py-2">Login</button>
                            <p class="card-description mt-4 text-dark"> Don't have an account yet? Register here! </p>
                            <a href="{{ route('register') }}"><button type="button" class="btn btn-warning text-dark px-4 py-2">Register</button></a>
                        </form>
                    </div>
                </div>
            </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
</body>
</html>
