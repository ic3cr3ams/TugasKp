<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Silabus ISTTS</title>
    <link href="{{asset('asset/admin/img/logo-istts.png')}}" rel="icon">
    <link href="{{ asset('asset/admin/lib/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/admin/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/admin/lib/bootstrap-fileupload/bootstrap-fileupload.css') }}" />
    <link href="{{ asset('asset/admin/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <section id="container">
        <header class="header"style="background-color:#440000;">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <a href="/admin/Home" class="logo"><b><span><img src="{{asset('images/stts.png')}}" class="float-center" width="40" height="40"></span><span> Silabus ISTTS</span> </b></a>
            <ul class="nav pull-right top-menu">
                <a class="btn btn-danger btn-sm mt-3" href="/">Logout</a>
            </ul>
        </header>

        <aside>
            <div id="sidebar" class="nav-collapse " style="background-color:#440000;">
                <ul class="sidebar-menu" id="nav-accordion">
                <h5 class="centered">Welcome,Admin BAA</h5>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/admin/Home")) ? 'active' : '' }}" href="/admin/Home">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Home</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/admin/MataKuliah")) ? 'active' : '' }}" href="/admin/MataKuliah">
                    <i class="fa fa-file-text"></i>
                    <span>Mata Kuliah</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/admin/Assign")) ? 'active' : '' }}" href="/admin/Assign">
                    <i class=" fa fa-users"></i>
                    <span>Assign Dosen Silabus</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <button class="btn btn-success"><i class="fa fa-download"></i> Report Pengisian Silabus</button>
                </li>
                <li class="sub-menu">
                    <button class="btn btn-info"><i class="fa fa-external-link-square"></i> Export Deskripsi Mata Kuliah</button>
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
                <a href="" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
    </section>
    <script src="{{ asset('asset/admin/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/admin/lib/bootstrap/js/bootstrap.js') }}"></script>
</body>

</html>
