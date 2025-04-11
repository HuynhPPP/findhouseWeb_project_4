<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Admindek | 404</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
      content="Admindek Bootstrap admin template made using Bootstrap 5 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
      content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="colorlib" />
    <!-- Favicon icon -->

    <link rel="icon" href="{{ asset('admin/images/favicon.ico') }}"
      type="image/x-icon">
    <!-- Google font-->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700"
      rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"
      href="{{ asset('admin/components/bootstrap/css/bootstrap.min.css') }}">
    <!-- waves.css -->
    <link rel="stylesheet"
      href="{{ asset('admin/pages/waves/css/waves.min.css') }}" type="text/css"
      media="all">
    <!-- feather icon -->
    <link rel="stylesheet" type="text/css"
      href="{{ asset('admin/icon/feather/css/feather.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css"
      href="{{ asset('admin/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css"
      href="{{ asset('admin/icon/icofont/css/icofont.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css"
      href="{{ asset('admin/icon/font-awesome/css/font-awesome.min.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css"
      href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" type="text/css"
      href="{{ asset('admin/css/pages.css') }}">
  </head>

  <body themebg-pattern="theme6">
    <!-- Pre-loader start -->
    <div class="theme-loader">
      <div class="loader-track">
        <div class="preloader-wrapper">
          <div class="spinner-layer spinner-blue">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
          <div class="spinner-layer spinner-red">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>

          <div class="spinner-layer spinner-yellow">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>

          <div class="spinner-layer spinner-green">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
        <nav class="navbar header-navbar pcoded-header" header-theme="theme6">
          <div class="navbar-wrapper">
            <div class="navbar-logo">
              <a href="/">
                <img class="img-fluid"
                  src="{{ asset('admin/images/logo.png') }}" alt="Theme-Logo" />
              </a>
            </div>
            <div class="navbar-container container-fluid">
              <ul class="nav-left">
                <li>
                  <a href="#!" onclick="javascript:toggleFullScreen()"
                    class="waves-effect waves-light">
                    <i class="full-screen feather icon-maximize"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
      <!-- Section start -->
      <section class="login-block offline-404">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <!-- auth body start -->
              <div class="card auth-box">
                <div class="card-block text-center">
                  <form>
                    <h1>404</h1>
                    <h2 class="m-b-15 text-muted">Không tìm thấy trang !</h2>
                    <a href="#"onclick="window.history.back();"
                      class="btn btn-inverse m-t-30">Trở lại trang chủ</a>
                  </form>
                </div>
              </div>
              <!-- auth body end -->
            </div>
          </div>
        </div>
      </section>
      <!-- Section end -->
    </div>
    <!-- Required Jquery -->
    <script type="text/javascript"
      src="{{ asset('admin/components/jquery/js/jquery.min.js') }}"></script>
    <script type="text/javascript"
      src="{{ asset('admin/components/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript"
      src="{{ asset('admin/components/popper.js/js/popper.min.js') }}"></script>
    <script type="text/javascript"
      src="{{ asset('admin/components/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- waves js -->
    <script src="{{ asset('admin/pages/waves/js/waves.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript"
      src="{{ asset('admin/components/jquery-slimscroll/js/jquery.slimscroll.js') }}">
    </script>
    <!-- modernizr js -->
    <script type="text/javascript"
      src="{{ asset('admin/components/modernizr/js/modernizr.js') }}"></script>
    <script type="text/javascript"
      src="{{ asset('admin/components/modernizr/js/css-scrollbars.js') }}">
    </script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{ asset('admin/js/script.js') }}">
    </script>
  </body>

</html>
