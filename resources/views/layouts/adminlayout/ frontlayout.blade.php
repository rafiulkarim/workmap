<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title }} </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin//vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('assets/admin/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
    @yield('header_script')
</head>

<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="{{ route('admin_dashboard') }}" class="brand-logo">
            <img class="brand-title" src="{{ asset('assets/img/logo.png') }}" alt="">
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                    </div>

                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                <i class="mdi mdi-account"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="./app-profile.html" class="dropdown-item">
                                    <i class="icon-user"></i>
                                    <span class="ml-2">Profile </span>
                                </a>
                                <a href="{{ route('admin_logout') }}" class="dropdown-item">
                                    <i class="icon-key"></i>
                                    <span class="ml-2">Logout </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="quixnav">
        <div class="quixnav-scroll">
            <ul class="metismenu" id="menu">
                <li><a href="{{ route('admin_dashboard') }}" aria-expanded="false"><i
                            class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-single-04"></i><span class="nav-text">Category</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('adminCategoryList') }}">Category List</a></li>
                        <li><a href="{{ route('adminAddCategory') }}">Add Category</a></li>
                    </ul>
                </li>

                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-single-04"></i><span class="nav-text">Sub Category</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('adminSubCategoryList') }}">Sub Category List</a></li>
                        <li><a href="{{ route('adminAddsubCategory') }}">Add Sub Category</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('user_login') }}" aria-expanded="false"><i
                            class="icon icon-single-04"></i><span class="nav-text">User login</span></a>
                </li>
                <li><a href="{{ route('report_list') }}" aria-expanded="false"><i
                            class="icon icon-single-04"></i><span class="nav-text">Gig Report</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


    <!--**********************************
        Footer start
    ***********************************-->
    <div class="footer">
        <div class="copyright">
            <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
            <p>Distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a></p>
        </div>
    </div>
    <!--**********************************
        Footer end
    ***********************************-->

    <!--**********************************
       Support ticket button start
    ***********************************-->

    <!--**********************************
       Support ticket button end
    ***********************************-->


</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{ asset('assets/admin/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/quixnav-init.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom.min.js') }}"></script>


<!-- Vectormap -->
<script src="{{ asset('assets/admin/vendor/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/morris/morris.min.js') }}"></script>


<script src="{{ asset('assets/admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/chart.js/Chart.bundle.min.js') }}"></script>

<script src="{{ asset('assets/admin/vendor/gaugeJS/dist/gauge.min.js') }}"></script>

<!--  flot-chart js -->
<script src="{{ asset('assets/admin/vendor/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/flot/jquery.flot.resize.js') }}"></script>

<!-- Owl Carousel -->
<script src="{{ asset('assets/admin/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

<!-- Counter Up -->
<script src="{{ asset('assets/admin/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>


<script src="{{asset('assets/admin/js/dashboard/dashboard-1.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@yield('footer_script')
</body>

</html>
