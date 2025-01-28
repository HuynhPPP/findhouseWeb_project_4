<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Admindek | Admin Template</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css"
      href="{{ asset('admin/icon/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css"
      href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" type="text/css"
      href="{{ asset('admin/css/pages.css') }}">
    <link href="{{ asset('admin/sweetalert2/sweetalert2.min.css') }}"
      rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('admin/icon/icofont/css/icofont.css') }}"
      rel="stylesheet" type="text/css" id="app-style" />
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <link href="{{ asset('admin/sweetalert2/sweetalert2.min.css') }}"
      rel="stylesheet" type="text/css" id="app-style" />
    @yield('customCss')
  </head>

  <body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-bar"></div>
    </div>
    <!-- [ Pre-loader ] end -->
    <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
        <!-- [ Header ] start -->
        <nav class="navbar header-navbar pcoded-header">
          <div class="navbar-wrapper">
            <div class="navbar-logo">
              <a href="index.html">
                <img class="img-fluid"
                  src="{{ asset('admin/images/logo.png') }}"
                  alt="Theme-Logo" />
              </a>
              <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu icon-toggle-right"></i>
              </a>
              <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
              </a>
            </div>
            <div class="navbar-container container-fluid">
              <ul class="nav-left">
                <li class="header-search">
                  <div class="main-search morphsearch-search">
                    <div class="input-group">
                      <span class="input-group-text search-close">
                        <i class="feather icon-x input-group-text"></i>
                      </span>
                      <input type="text" class="form-control"
                        placeholder="Enter Keyword">
                      <span class="input-group-text search-btn">
                        <i class="feather icon-search input-group-text"></i>
                      </span>
                    </div>
                  </div>
                </li>
                <li>
                  <a href="#!" onclick="javascript:toggleFullScreen()"
                    class="waves-effect waves-light">
                    <i class="full-screen feather icon-maximize"></i>
                  </a>
                </li>
              </ul>
              <ul class="nav-right">
                <li class="header-notification">
                  <div class="dropdown-primary dropdown">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown">
                      <i class="feather icon-bell"></i>
                      <span class="badge bg-c-red">5</span>
                    </div>
                    <ul
                      class="show-notification notification-view dropdown-menu"
                      data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                      <li>
                        <h6>Notifications</h6>
                        <label class="form-label label label-danger">New</label>
                      </li>
                      <li>
                        <div class="d-flex">
                          <div class="flex-shrink-0">
                            <img class="img-radius"
                              src="{{ asset('admin/images/avatar-4.jpg') }}"
                              alt="Generic placeholder image">
                          </div>
                          <div class="flex-grow-1">
                            <h5 class="notification-user">John Doe</h5>
                            <p class="notification-msg">Lorem ipsum dolor sit
                              amet, consectetuer elit.</p>
                            <span class="notification-time">30 minutes
                              ago</span>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="d-flex">
                          <div class="flex-shrink-0">
                            <img class="img-radius"
                              src="{{ asset('admin/images/avatar-4.jpg') }}"
                              alt="Generic placeholder image">
                          </div>
                          <div class="flex-grow-1">
                            <h5 class="notification-user">Joseph William</h5>
                            <p class="notification-msg">Lorem ipsum dolor sit
                              amet, consectetuer elit.</p>
                            <span class="notification-time">30 minutes
                              ago</span>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="d-flex">
                          <div class="flex-shrink-0">
                            <img class="img-radius"
                              src="{{ asset('admin/images/avatar-4.jpg') }}"
                              alt="Generic placeholder image">
                          </div>
                          <div class="flex-grow-1">
                            <h5 class="notification-user">Sara Soudein</h5>
                            <p class="notification-msg">Lorem ipsum dolor sit
                              amet, consectetuer elit.</p>
                            <span class="notification-time">30 minutes
                              ago</span>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="header-notification">
                  <div class="dropdown-primary dropdown">
                    <div class="displayChatbox dropdown-toggle"
                      data-bs-toggle="dropdown">
                      <i class="feather icon-message-square"></i>
                      <span class="badge bg-c-green">3</span>
                    </div>
                  </div>
                </li>
                <li class="user-profile header-notification">
                  <div class="dropdown-primary dropdown">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown">
                      <img src="{{ asset('admin/images/avatar-4.jpg') }}"
                        class="img-radius" alt="User-Profile-Image">
                      <span>{{ Auth::user()->name }}</span>
                      <i class="feather icon-chevron-down"></i>
                    </div>
                    <ul
                      class="show-notification profile-notification dropdown-menu"
                      data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                      <li>
                        <a href="#">
                          <i class="feather icon-user"></i> Tài khoản
                        </a>
                      </li>
                      <li>
                        <a href="{{ route('user.logout') }}">
                          <i class="feather icon-log-out"></i> Đăng xuất

                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- [ chat user list ] start -->
        <div id="sidebar" class="users p-chat-user showChat">
          <div class="had-container">
            <div class="p-fixed users-main">
              <div class="user-box">
                <div class="chat-search-box">
                  <a class="back_friendlist">
                    <i class="feather icon-x"></i>
                  </a>
                  <div class="right-icon-control">
                    <div class="input-group input-group-button">
                      <input type="text" id="search-friends"
                        name="footer-email" class="form-control"
                        placeholder="Search Friend">
                      <button class="btn btn-primary waves-effect waves-light"
                        type="button">
                        <i class="feather icon-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="main-friend-list">
                  <div class="media userlist-box waves-effect waves-light"
                    data-id="1" data-status="online"
                    data-username="Josephin Doe">
                    <a class="media-left" href="#!">
                      <img class="media-object img-radius"
                        src="{{ asset('admin/images/avatar-4.jpg') }}"
                        alt="Generic placeholder image ">
                      <div class="live-status bg-success"></div>
                    </a>
                    <div class="media-body">
                      <div class="chat-header">Josephin Doe</div>
                    </div>
                  </div>
                  <div class="media userlist-box waves-effect waves-light"
                    data-id="2" data-status="online"
                    data-username="Lary Doe">
                    <a class="media-left" href="#!">
                      <img class="media-object img-radius"
                        src="{{ asset('admin/images/avatar-4.jpg') }}"
                        alt="Generic placeholder image">
                      <div class="live-status bg-success"></div>
                    </a>
                    <div class="media-body">
                      <div class="f-13 chat-header">Lary Doe</div>
                    </div>
                  </div>
                  <div class="media userlist-box waves-effect waves-light"
                    data-id="3" data-status="online"
                    data-username="Alice">
                    <a class="media-left" href="#!">
                      <img class="media-object img-radius"
                        src="{{ asset('admin/images/avatar-4.jpg') }}"
                        alt="Generic placeholder image">
                      <div class="live-status bg-success"></div>
                    </a>
                    <div class="media-body">
                      <div class="f-13 chat-header">Alice</div>
                    </div>
                  </div>
                  <div class="media userlist-box waves-effect waves-light"
                    data-id="4" data-status="offline"
                    data-username="Alia">
                    <a class="media-left" href="#!">
                      <img class="media-object img-radius"
                        src="{{ asset('admin/images/avatar-4.jpg') }}"
                        alt="Generic placeholder image">
                      <div class="live-status bg-default"></div>
                    </a>
                    <div class="media-body">
                      <div class="f-13 chat-header">Alia<small
                          class="d-block text-muted">10 min ago</small></div>
                    </div>
                  </div>
                  <div class="media userlist-box waves-effect waves-light"
                    data-id="5" data-status="offline"
                    data-username="Suzen">
                    <a class="media-left" href="#!">
                      <img class="media-object img-radius"
                        src="{{ asset('admin/images/avatar-4.jpg') }}"
                        alt="Generic placeholder image">
                      <div class="live-status bg-default"></div>
                    </a>
                    <div class="media-body">
                      <div class="f-13 chat-header">Suzen<small
                          class="d-block text-muted">15 min ago</small></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ chat user list ] end -->

        <!-- [ chat message ] start -->
        <div class="showChat_inner">
          <div class="d-flex chat-inner-header">
            <a class="back_chatBox">
              <i class="feather icon-x"></i> Josephin Doe
            </a>
          </div>
          <div class="main-friend-chat">
            <div class="d-flex chat-messages">
              <a class="media-left photo-table" href="#!">
                <div class="flex-shrink-0">
                  <img class="media-object img-radius m-t-5"
                    src="{{ asset('admin/images/avatar-4.jpg') }}"
                    alt="Generic placeholder image">
                </div>
              </a>
              <div class="flex-grow-1 chat-menu-content">
                <div class="">
                  <p class="chat-cont">I'm just looking around. Will you tell
                    me something about yourself?</p>
                </div>
                <p class="chat-time">8:20 a.m.</p>
              </div>
            </div>
            <div class="d-flex chat-messages">
              <div class="flex-grow-1 chat-menu-reply">
                <div class="">
                  <p class="chat-cont">Ohh! very nice</p>
                </div>
                <p class="chat-time">8:22 a.m.</p>
              </div>
            </div>
            <div class="d-flex chat-messages">
              <a class="media-left photo-table" href="#!">
                <div class="flex-shrink-0">
                  <img class="media-object img-radius m-t-5"
                    src="{{ asset('admin/images/avatar-4.jpg') }}"
                    alt="Generic placeholder image">
                </div>
              </a>
              <div class="media-body chat-menu-content">
                <div class="">
                  <p class="chat-cont">can you come with me?</p>
                </div>
                <p class="chat-time">8:20 a.m.</p>
              </div>
            </div>
          </div>
          <div class="chat-reply-box">
            <div class="right-icon-control">
              <div class="input-group input-group-button">
                <input type="text" class="form-control"
                  placeholder="Write hear . . ">
                <button class="btn btn-primary waves-effect waves-light"
                  type="button">
                  <i class="feather icon-message-circle"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- [ chat message ] end -->
        <div class="pcoded-main-container">
          <div class="pcoded-wrapper">
            <!-- [ navigation menu ] start -->
            @include('admin.navbar')
            <!-- [ navigation menu ] end -->
            @yield('content')
            <!-- [ style Customizer ] start -->
            <div id="styleSelector">
            </div>
            <!-- [ style Customizer ] end -->
          </div>
        </div>
      </div>
    </div>

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
    <!-- waves js -->
    <script src="{{ asset('admin/pages/waves/js/waves.min.js') }}"></script>
    <!-- Custom js -->
    <script src="{{ asset('admin/pages/data-table/js/data-table-custom.js') }}">
    </script>
    <script src="{{ asset('admin/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('admin/js/vertical/vertical-layout.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.mCustomScrollbar.concat.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('admin/js/script.js') }}">
    </script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script>
      $(document).ready(function() {
        // Cấu hình mặc định DataTables với ngôn ngữ tiếng Việt
        $.extend(true, $.fn.dataTable.defaults, {
          language: {
            "sProcessing": "Đang xử lý...",
            "sLengthMenu": "Hiển thị _MENU_ mục",
            "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
            "sInfo": "Đang hiển thị _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty": "Đang hiển thị 0 đến 0 của 0 mục",
            "sInfoFiltered": "(được lọc từ _MAX_ mục)",
            "sInfoPostFix": "",
            "sSearch": "Tìm kiếm:",
            "sUrl": "",
            "oPaginate": {
              "sFirst": "Đầu",
              "sPrevious": "Trước",
              "sNext": "Tiếp",
              "sLast": "Cuối"
            }
          }
        });
      });
    </script>
    <script>
      toastr.options = {
        timeOut: 2000,
        progressBar: true,
      };
      $(document).ready(function() {
        @if (Session::has('message'))
          var type = "{{ Session::get('alert-type', 'info') }}"
          switch (type) {
            case 'info':
              toastr.info(" {{ Session::get('message') }} ");
              break;
            case 'success':
              toastr.success(" {{ Session::get('message') }} ");
              break;
            case 'warning':
              toastr.warning(" {{ Session::get('message') }} ");
              break;
            case 'error':
              toastr.error(" {{ Session::get('message') }} ");
              break;
          }
        @endif
      });
    </script>
    <script src="{{ asset('admin/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin/sweetalert2/extended-sweetalerts.js') }}">
    </script>
    @yield('customJs')
  </body>


</html>
