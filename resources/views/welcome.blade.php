<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UIT Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/img.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

    <style>
      .text{
        color:white !important
      }
      .icon-bg{
        background-color:white !important
      }
      .logo{
        margin-top: 10px; 
        color:#3798A6 !important


      }
      .nav-link1:hover{
        border:3px solid white !important;
        background-color: #3798A6 !important;
      }
      .logo-box{
        background-color: white !important;
        border: 4px double #3798A6;
        color:#3798A6 !important
      }
      .logo-img{
        width: 70px;
      }
      .menu{
        border: 2px solid #3798A6 !important;
      }
      .menu p{
        color: #3798A6;
      }
      .dropdown-divider{
        color: #3798A6 !important;
        background-color: #3798A6 !important;
      }
      .menu a{
        border: 3px solid white !important;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #3798A6; border-right: 2px solid white">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top logo-box" style="background-color: #3798A6; ">
          <img src="{{asset('assets/images/UIT-Logo-big.png')}}" alt="" class="logo-img">
          <a class=" text-white logo" href="#"><h2>UIT Admin</h2></a>
          {{-- <a class="sidebar-brand brand-logo-mini" href="index.html" >A</a> --}}
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="{{asset('assets/images/faces/face15.jpg')}}" alt="">
                  <span class="count bg-success"></span>


                </div>
                <div class="profile-name">
<<<<<<< HEAD
                @if(Auth::check())
                  <h5 class="mb-0 font-weight-normal"> {{ Auth::user()->name }} </h5>
=======
                  <h5 class="mb-0 font-weight-normal">user name here</h5>
>>>>>>> origin/main
                  <span class="text">Admin</span>
                @endif
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical text"></i></a>
              <div class="dropdown-menu bg-white menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="#" class="dropdown-item preview-item border-danger ">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle " style="background-color: #3798A6 !important;">
                      <i class="mdi mdi-contacts text-white "></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Admin Profile</p>
                  </div>
                </a>
                <div class="dropdown-divider bg-danger"></div>
                <a href="{{ route('changepassword') }}" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle " style="background-color: #3798A6 !important;">
                      <i class="mdi mdi-onepassword  text-white "></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link text">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link1 nav-link" href="{{route('news#list')}}">
              <span class="menu-icon icon-bg">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title text " >News</span>
            </a>
          </li>
  
          <li class="nav-item menu-items">
            <a class="nav-link1 nav-link" href="{{route('conf#list')}}">
              <span class="menu-icon icon-bg">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title text">Conferences</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link1 nav-link" href="pages/forms/basic_elements.html">
              <span class="menu-icon icon-bg">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title text">Staffs</span>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper" style="border-bottom: 2px solid white !important">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row" style="background-color: #3798A6; border-bottom: 2px solid white !important">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            {{-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a> --}}
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <span class="count bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="{{asset('assets/images/faces/face15.jpg')}}" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                      <p class="text-muted mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">4 new messages</p>
                </div>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-calendar text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Event today</p>
                      <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                      <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-link-variant text-warning"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Launch Admin</p>
                      <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="{{asset('assets/images/faces/face15.jpg')}}" alt="">
                    @if(Auth::check())
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                    @endif
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="menu dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0 bg-white" style="color: #3798A6;">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item bg-white" href="{{ route('changepassword') }}">
                    
                    <div class="preview-thumbnail">
                      <div class="preview-icon  rounded-circle " style="background-color: #3798A6;">
                        <i class="mdi mdi-contacts " style="color: white;"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Change Password</p>
                    </div>
                    
                  </a>
                  <div class="dropdown-divider"></div>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                  <a class="dropdown-item preview-item bg-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="preview-thumbnail">
                      <div class="preview-icon  rounded-circle"  style="background-color: #3798A6;">
                        <i class="mdi mdi-logout " style="color: white;"></i>
                      </div>
                    </div>
                    <div class="preview-item-content bg-white">
                      <p class="preview-subject mb-1">Log out</p>
                    </div>
                  </a>
                  <div class="dropdown-divider bg-white"></div>
                  <p class="p-3 mb-0 text-center bg-white"></p>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel" style="background-color: white !important;">
          <div class="content-wrapper" style="background-color: white !important;">
           <div>
                @yield('content')
           </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer" style="background-color:white  !important;">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block " style="color:#3798A6 !important">Copyright © university of information</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    {{-- <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/misc.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/settings.js')}}"></script> --}}
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
  </body>
</html>