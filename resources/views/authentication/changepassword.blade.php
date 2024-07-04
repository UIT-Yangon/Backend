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
                        <h3 class="card-title" style="text-align: center;">Update Password Form</h3>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form class="forms-sample" method="POST" action="{{ route('admin#changepassword') }}">
                            @csrf
                            <div class="form-group">
                                <label for="current_password" style="font-size: 16px !important;">Current Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control bg-white border-0 text-dark" id="current_password" placeholder="Current Password" name="current_password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="new_password" style="font-size: 16px !important;">New Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control bg-white border-0 text-dark" id="new_password" placeholder="New Password" name="new_password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation" style="font-size: 16px !important;">Confirm Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control bg-white border-0 text-dark" id="new_password_confirmation" placeholder="Confirm Password" name="new_password_confirmation">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-dark mr-2 px-4 py-2">Submit</button>
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
