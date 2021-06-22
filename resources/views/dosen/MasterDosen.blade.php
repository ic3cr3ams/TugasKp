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

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!--external css-->
    <link href="{{ asset('asset/admin/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('asset/admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/admin/css/style-responsive.css') }}" rel="stylesheet">


</head>

<body>
    <section id="container">
                    {{-- Header --}}
        <header class="header black-bg" style="background-color:#192D35;">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <a href="/dosen/Home" class="logo"><b><span><img src="{{asset('images/stts.png')}}" class="float-center" width="40" height="40"></span><span> Silabus ISTTS</span> </b></a>
            <ul class="nav pull-right top-menu">
                <a class="btn btn-danger btn-sm mt-3" href="{{ url('logout') }}">Logout</a>
            </ul>
        </header>

        <aside>
            <div id="sidebar" class="nav-collapse "style="background-color:#224350;">
                <ul class="sidebar-menu" id="nav-accordion">
                <h5 class="centered">{{Auth::user()->namaDenganJabatan()}}</h5>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/dosen/home")) ? 'active' : '' }}" href="/dosen/home">
                    <i class="fa fa-user-o" aria-hidden="true"></i>
                    <span style="font-size: 8pt;">Mata Kuliah Yang Ditugaskan</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="{{ (url()->current() == url("/dosen/cetak")) ? 'active' : '' }}" href="/dosen/cetak">
                        <i class="fa fa-print" aria-hidden="true"></i>
                    <span>Cetak PDF Silabus</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a  href="/dosen/Unduh">
                    <i class="fa fa-download"></i>
                    <span>Unduh Pedoman Silabus</span>
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
                {{-- <a href="/" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a> --}}
            </div>
        </footer>
    <!--footer end-->
    </section>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
</body>

</html>
