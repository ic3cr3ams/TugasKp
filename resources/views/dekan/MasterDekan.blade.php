<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Silabus ISTTS</title>

    <!-- Favicons -->
    <link href="{{asset('asset/admin/img/logo-istts.png')}}" rel="icon">
    {{-- <link href="{{asset('asset/admin/img/logo-istts.png')}}" rel="apple-touch-icon"> --}}

    <!-- Bootstrap core CSS -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}
    <link href="{{ asset('asset/admin/lib/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('asset/admin/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/admin/lib/bootstrap-fileupload/bootstrap-fileupload.css') }}" />
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('asset/admin/lib/bootstrap-datepicker/css/datepicker.css') }}" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('asset/admin/lib/bootstrap-daterangepicker/daterangepicker.css') }}" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('asset/admin/lib/bootstrap-timepicker/compiled/timepicker.css') }}" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('asset/admin/lib/bootstrap-datetimepicker/css/datetimepicker.css') }}" /> --}}
    <!-- Custom styles for this template -->
    <link href="{{ asset('asset/admin/css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('asset/admin/css/style-responsive.css') }}" rel="stylesheet"> --}}

    <!-- =======================================================
        Template Name: Dashio
        Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
        Author: TemplateMag.com
        License: https://templatemag.com/license/
    ======================================================= -->
</head>

<body>
    <section id="container">
        <header class="header black-bg" style="background-color:#192D35;">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
        <!--logo start-->
            {{-- <img src="{{asset('asset/admin/img/logo-istts.png')}}" alt="" srcset="" class="rounded float-left"> --}}
            <a href="index.html" class="logo"><b><span><img src="{{asset(('images/stts.png'))}}" class="float-center" width="40" height="40"></span><span> Silabus ISTTS</span> </b></a>
            <!--logo end-->

            <ul class="nav pull-right top-menu">
                <a class="btn btn-danger btn-sm mt-3" href="/">Logout</a>
            </ul>
        </header>
        <!--header end-->
        <!-- **********************************************************************************************************************************************************
            MAIN SIDEBAR MENU
            *********************************************************************************************************************************************************** -->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse "style="background-color:#224350;">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                <h5 class="centered">Nama Dekan Login</h5>
                <h6 class="centered">Dekan</h6>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/dekan/Home")) ? 'active' : '' }}" href="/dekan/Home">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <span>Mata Kuliah Fakultas</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/dekan/AssignDekan")) ? 'active' : '' }}" href="/dekan/AssignDekan">
                    <i class="fa fa-user-o" aria-hidden="true"></i>
                    <span>Mata Kuliah Yang Ditugaskan</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/dekan/cetak")) ? 'active' : '' }}" href="/dekan/cetak">
                        <i class="fa fa-print" aria-hidden="true"></i>
                    <span>Cetak PDF Silabus</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="/dekan/Unduh">
                    <i class="fa fa-download"></i>
                    <span> Unduh Pedoman Silabus</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="/dekan/Export">
                    <i class="fa fa-external-link" aria-hidden="true"></i>
                    <span>Export Data Silabus</span>
                    </a>
                </li>
            </div>
        </aside>
        @yield('body')
        <footer class="site-footer">
            <div class="text-center">
                <p>

                </p>
                <div class="credits">
                </div>
                <a href="advanced_form_components.html#" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
    <!--footer end-->
    </section>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('asset/admin/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/admin/lib/bootstrap/js/bootstrap.js') }}"></script>
    {{-- <script class="include" type="text/javascript" src="{{ asset('asset/admin/lib/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('asset/admin/lib/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('asset/admin/lib/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <!--common script for all pages-->
    <script src="{{ asset('asset/admin/lib/common-scripts.js') }}"></script>
    <!--script for this page-->
    <script src="{{ asset('asset/admin/lib/jquery-ui-1.9.2.custom.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/admin/lib/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/admin/lib/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/admin/lib/bootstrap-daterangepicker/date.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/admin/lib/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/admin/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/admin/lib/bootstrap-daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/admin/lib/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('asset/admin/lib/advanced-form-components.js') }}"></script>
    @stack('js') --}}
</body>

</html>
