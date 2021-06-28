@extends('kajur/MasterKajur')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-check-square-o"></i> Verifikasi Silabus Dosen</h3>
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel" style="border-radius: 25px;">
                    <table class="cell-border stripe" id="myTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Kurikulum</th>
                                <th>Nama Dosen</th>
                                <th>Silabus</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($silabus as $item)
                            <tr>
                                <td>{{$item->matkul_nama}}</td>
                                <td>{{$item->kurikulum_kode}}</td>
                                @foreach ($dosen as $itemm)
                                    @if ($itemm->dosen_kode==$item->dosen_kode)
                                        <td>{{$itemm->dosen_nama_sk}}</td>
                                    @endif
                                @endforeach
                                <td>
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-primary btn-xs" style="color: white;" data-toggle="modal" data-target="#myModal_{{$item->mk_kodebaa.$item->kurikulum_kode}}">
                                        <i class="fa fa-file-text"></i> Lihat Silabus
                                    </button>
                                    <!-- The Modal -->
                                    <div class="modal" id="myModal_{{$item->mk_kodebaa.$item->kurikulum_kode}}">
                                        <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title">Lihat Silabus {{$item->matkul_nama}}</h4>
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
                                                                <button class="btn btn-success btn-xs" style="color: white;"><i class="fa fa-file-text"></i> Lihat</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bahasa Inggris </td>
                                                            <td>
                                                                <button class="btn btn-success btn-xs" style="color: white;"><i class="fa fa-file-text"></i> Lihat</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button"
                                    id="{{$item->mk_kodebaa.$item->kurikulum_kode}}s"
                                    class="btn
                                    @if ($item->sd_status_ind=="3" && $item->sd_status_eng=="3") btn-success
                                    @else btn-warning
                                    @endif
                                    btn-xs" data-toggle="modal" data-target="#myModalVerif_{{$item->mk_kodebaa.$item->kurikulum_kode}}">
                                        <i class="fa fa-check-circle"></i> Verifikasi
                                    </button>
                                    <!-- The Modal -->
                                    <div class="modal" id="myModalVerif_{{$item->mk_kodebaa.$item->kurikulum_kode}}">
                                        <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title">Verifikasi Silabus {{$item->matkul_nama}}</h4>
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
                                                                <button class="btn btn-success btn-xs" style="color: white;"
                                                                id="{{$item->mk_kodebaa.$item->kurikulum_kode}}acci"
                                                                @if ($item->sd_status_ind==0) disabled  @endif>
                                                                <i class="fa fa-check-circle"></i> Setujui</button>
                                                                <button class="btn btn-danger btn-xs" style="color: white;"
                                                                id="{{$item->mk_kodebaa.$item->kurikulum_kode}}denyi"
                                                                @if ($item->sd_status_ind==0) disabled @endif>
                                                                <i class="fa fa-ban "></i> Tolak</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td id="{{$item->mk_kodebaa.$item->kurikulum_kode}}e"
                                                            value="{{$item->sd_status_eng}}">Bahasa Inggris </td>
                                                            <td>
                                                                <button class="btn btn-success btn-xs" style="color: white;"
                                                                id="{{$item->mk_kodebaa.$item->kurikulum_kode}}acce"
                                                                @if ($item->sd_status_eng == 0) disabled @endif>
                                                                <i class="fa fa-check-circle"></i> Setujui</button>
                                                                <button class="btn btn-danger btn-xs" style="color: white;"
                                                                id="{{$item->mk_kodebaa.$item->kurikulum_kode}}denye"
                                                                @if ($item->sd_status_eng == 0) disabled @endif>
                                                                <i class="fa fa-ban "></i> Tolak</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <script>

                                            $('#{{$item->mk_kodebaa.$item->kurikulum_kode}}acci').click(function(e) {
                                                var matkul_nama = "{{$item->matkul_nama}}";
                                                var id = "{{$item->mk_kodebaa.$item->kurikulum_kode}}";
                                                var mk_kodebaa=  id.slice(0,5);
                                                var kurikulum_kode = id.slice(5,9);
                                                $.post('{{ url("verif") }}',
                                                {
                                                    "_token": "{{ csrf_token() }}",
                                                    'matkul_nama':matkul_nama,
                                                    'mk_kodebaa':mk_kodebaa,
                                                    'kurikulum_kode':kurikulum_kode,
                                                    'bahasa':"i",
                                                    'status':"3",
                                                }
                                                ,
                                                function (data) {
                                                    console.log(data);
                                                    data = $.parseJSON(data);
                                                    alert(data.message);
                                                });
                                            })
                                            $('#{{$item->mk_kodebaa.$item->kurikulum_kode}}acce').click(function(e) {
                                                var matkul_nama = "{{$item->matkul_nama}}";
                                                var id = "{{$item->mk_kodebaa.$item->kurikulum_kode}}";
                                                var mk_kodebaa=  id.slice(0,5);
                                                var kurikulum_kode = id.slice(5,9);
                                                $.post('{{ url("verif") }}',
                                                {
                                                    "_token": "{{ csrf_token() }}",
                                                    'matkul_nama':matkul_nama,
                                                    'mk_kodebaa':mk_kodebaa,
                                                    'kurikulum_kode':kurikulum_kode,
                                                    'bahasa':"e",
                                                    'status':"3",
                                                }
                                                ,
                                                function (data) {
                                                    console.log(data);
                                                    data = $.parseJSON(data);
                                                    alert(data.message);
                                                });
                                            })
                                            $('#{{$item->mk_kodebaa.$item->kurikulum_kode}}denyi').click(function(e) {
                                                var matkul_nama = "{{$item->matkul_nama}}";
                                                var id = "{{$item->mk_kodebaa.$item->kurikulum_kode}}";
                                                var mk_kodebaa=  id.slice(0,5);
                                                var kurikulum_kode = id.slice(5,9);
                                                $.post('{{ url("verif") }}',
                                                {
                                                    "_token": "{{ csrf_token() }}",
                                                    'matkul_nama':matkul_nama,
                                                    'mk_kodebaa':mk_kodebaa,
                                                    'kurikulum_kode':kurikulum_kode,
                                                    'bahasa':"i",
                                                    'status':"2",
                                                }
                                                ,
                                                function (data) {
                                                    console.log(data);
                                                    data = $.parseJSON(data);
                                                    alert(data.message);
                                                });
                                            })
                                            $('#{{$item->mk_kodebaa.$item->kurikulum_kode}}denye').click(function(e) {
                                                var matkul_nama = "{{$item->matkul_nama}}";
                                                var id = "{{$item->mk_kodebaa.$item->kurikulum_kode}}";
                                                var mk_kodebaa=  id.slice(0,5);
                                                var kurikulum_kode = id.slice(5,9);
                                                $.post('{{ url("verif") }}',
                                                {
                                                    "_token": "{{ csrf_token() }}",
                                                    'matkul_nama':matkul_nama,
                                                    'mk_kodebaa':mk_kodebaa,
                                                    'kurikulum_kode':kurikulum_kode,
                                                    'bahasa':"e",
                                                    'status':"2",
                                                }
                                                ,
                                                function (data) {
                                                    console.log(data);
                                                    data = $.parseJSON(data);
                                                    alert(data.message);
                                                });
                                            })
                                        </script>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /content-panel -->
            </div>
        </div>
        <!-- /row -->
    </section>
</section>
  <script src="{{asset('asset/admin/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('asset/admin/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{asset('asset/admin/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{asset('asset/admin/lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{asset('asset/admin/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>
@endsection
