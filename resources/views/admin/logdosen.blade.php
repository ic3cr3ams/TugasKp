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
</head>

<body>
    <section id="container">
        <header class="header black-bg" style="background-color:#192D35;">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <a href="#" class="logo"><b><span><img src="{{asset('images/stts.png')}}" class="float-center" width="40" height="40"></span><span> Silabus ISTTS</span> </b></a>
            <ul class="nav pull-right top-menu">
                <a class="btn btn-danger btn-sm mt-3" href="{{ url('logout') }}">Logout</a>
            </ul>
        </header>

        <aside>
            <div id="sidebar" class="nav-collapse "style="background-color:#224350;">
                <ul class="sidebar-menu" id="nav-accordion">
                <h5 class="centered">@foreach ($nama as $item) {{$item->dosen_nama_sk}}
                    <input type="hidden" id="nama" value="{{$item->dosen_nama_sk}}">
                    @endforeach
                </h5>
            </div>
        </aside>
        <section id="main-content">
            <input type="hidden" value="{{$dosen_kode}}" id="dosen_kode">
            <section class="wrapper">
                <div class="row">
                    <div class="col-12 mt-3">
                        <h3><i class="fa fa-user-o"></i> Mata Kuliah yang Ditugaskan</h3>
                    </div>
                    <div class="col-12 px-4">
                        <div class="content-panel" style="border-radius: 25px;">
                            <div class="col-12">
                            <table class="cell-border striped " id="myTable">
                                <thead>
                                    <tr>
                                        <th>Kode Mata Kuliah</th>
                                        <th>Mata Kuliah</th>
                                        <th>Semester</th>
                                        <th>Program Studi</th>
                                        <th>Kurikulum</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($kelass as $kelas)
                                    <tr>
                                        <td>{{ $kelas->mk_kodebaa }}</td>
                                        <td>{{ $kelas->matkul_nama }}</td>
                                        <td>{{ $kelas->mk_semester  }}</td>
                                        <td>{{ $kelas->AkaJurusan->jur_nama }}</td>
                                        <td>{{ $kelas->kurikulum_kode }}</td>
                                        <td>
                                            <button type="button" class="btn
                                                @if ($kelas->sd_status_ind==3 && $kelas->sd_status_eng==3) btn-success
                                                @elseif($kelas->sd_status_ind==0 && $kelas->sd_status_eng==0)btn-danger
                                                @else btn-warning
                                                @endif btn-xs"
                                                data-toggle="modal" data-target="#myModal_{{ $kelas->mk_kodebaa.$kelas->kurikulum_kode}}">

                                                @if ($kelas->sd_status!=0) <i class="fa fa-pencil"></i> Edit
                                                @else <i class="fa fa-plus-circle"></i> Tambah
                                                @endif
                                            </button>
                                            <!-- The Modal -->
                                            <div class="modal" id="myModal_{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}"
                                                name="{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">
                                                        @if ($kelas->sd_status!=0) Edit
                                                        @else Tambah
                                                        @endif Silabus {{$kelas->matkul_nama}} {{$kelas->kurikulum_kode}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped table-advance table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Silabus</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Bahasa Indonesia </td>
                                                                    <td>
                                                                        <button id="{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}i"
                                                                        name="{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}"
                                                                        class="btn
                                                                        @if ($kelas->sd_status_ind==3) btn-success
                                                                        @elseif($kelas->sd_status_ind==0) btn-danger
                                                                        @elseif($kelas->sd_status_ind==1) btn-info
                                                                        @elseif($kelas->sd_status_ind==2) btn-danger
                                                                        @endif
                                                                        btn-xs" style="color: white;">
                                                                        @if ($kelas->sd_status_ind!=0) <i class="fa fa-pencil"></i> Edit
                                                                        @else <i class="fa fa-plus-circle"></i> Tambah
                                                                        @endif
                                                                        Silabus</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Bahasa Inggris </td>
                                                                    <td>
                                                                        <button id="{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}e"
                                                                        name="{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}"
                                                                        class="btn
                                                                        @if ($kelas->sd_status_eng==3) btn-success
                                                                        @elseif($kelas->sd_status_eng==0) btn-danger
                                                                        @elseif($kelas->sd_status_eng==1) btn-info
                                                                        @elseif($kelas->sd_status_eng==2) btn-danger
                                                                        @endif btn-xs" style="color: white;">
                                                                        @if ($kelas->sd_status_eng!=0) <i class="fa fa-pencil"></i> Edit
                                                                        @else <i class="fa fa-plus-circle"></i> Tambah
                                                                        @endif Silabus</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <script>
                                        $('#{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}i').click(function(e) {
                                            var kodebaa = $(this).attr('name').slice(0,5);
                                            var periode = $(this).attr('name').slice(5,9);
                                            var dosen_kode =  $('#dosen_kode').val();
                                            var nama = $('#nama').val();
                                            var url = "{{ url('admin/silabus') }}";
                                            window.open(url+"/"+dosen_kode+"/"+kodebaa+"/"+periode+"/i");
                                        })
                                        $('#{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}e').click(function(e) {
                                            var kodebaa = $(this).attr('name').slice(0,5);
                                            var kurikulum_kode = $(this).attr('name').slice(5,9);
                                            var dosen_kode =  $('#dosen_kode').val();
                                            var url = "{{ url('admin/silabus') }}";
                                            window.open(url+"/"+dosen_kode+"/"+kodebaa+"/"+kurikulum_kode+"/e");
                                        })
                                    </script>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <script src="{{asset('asset/admin/lib/bootstrap/js/bootstrap.min.js')}}"></script>
        <script class="include" type="text/javascript" src="{{asset('asset/admin/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
        <script src="{{asset('asset/admin/lib/jquery.scrollTo.min.js')}}"></script>
        <script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>
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
            $('#myTable').DataTable();
        });
    </script>
</body>
</html>
