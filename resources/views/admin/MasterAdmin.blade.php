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

        {{-- Ajax  --}}
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        {{-- Select --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!--external css style-->
        <link href="{{ asset('asset/admin/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('asset/admin/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('asset/admin/css/style-responsive.css') }}" rel="stylesheet">

        <style>
            .dataTables_processing{
                background:none !important;
                background-color: #192D35!important;
                color:white!important;
                z-index: 100!important;
                padding-top: 10px!important;
            }
        </style>
    </head>

<body>
    <section id="container">
        <header class="header"style="background-color:#192D35;">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <a href="/admin/Home" class="logo"><b><span><img src="{{asset('images/stts.png')}}" class="float-center" width="40" height="40"></span><span> Silabus ISTTS</span> </b></a>
            <ul class="nav pull-right top-menu">
                <a class="btn btn-danger btn-sm mt-3" href="{{ url('logout') }}">Logout</a>
            </ul>
        </header>

        <aside>
            <div id="sidebar" class="nav-collapse " style="background-color:#224350;">
                <ul class="sidebar-menu" id="nav-accordion">
                <h5 class="centered">Welcome,Admin BAA</h5>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/admin/home")) ? 'active' : '' }}" href="/admin/home">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Home</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/admin/matakuliah")) ? 'active' : '' }}" href="/admin/matakuliah">
                    <i class="fa fa-file-text"></i>
                    <span>Mata Kuliah</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/admin/halassign")) ? 'active' : '' }}" href="/admin/halassign">
                    <i class=" fa fa-users"></i>
                    <span>Assign Dosen Silabus</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/admin/report")) ? 'active' : '' }}" href="/admin/report">
                    <i class="fa fa-download"></i>
                    <span> Report Pengisian Silabus </span>
                </a>
                </li>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/admin/export")) ? 'active' : '' }}" href="/admin/export">
                    <i class="fa fa-external-link-square"></i>
                    <span> Export Silabus</span>
                    </a>
                </li>
            </div>
        </aside>
        @yield('body')
    </section>
    <script src="{{asset('asset/admin/lib/jquery.niceScroll.js')}}" type="text/javascript"></script>
    <script src="{{ asset('asset/admin/lib/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    @stack('js')
</body>

</html>
