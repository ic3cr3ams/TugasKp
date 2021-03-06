@extends('dosen/MasterDosen')
@section('body')
    <section id="main-content">
        <input type="hidden" value="{{$dosen_kode}}" id="dosen_kode">
        <section class="wrapper">
            <div class="row">
                <div class="col-12 mt-3">
                    <h3><i class="fa fa-user-o"></i> Mata Kuliah yang Ditugaskan</h3>
                </div>
                <div class="col-12 px-3">
                    <div class="content-panel" style="border-radius: 25px;">
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

                                            @if ($kelas->sd_status_ind!=0 && $kelas->sd_status_eng!=0) <i class="fa fa-pencil"></i> Edit
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
                                                    @if ($kelas->sd_status_ind!=0 && $kelas->sd_status_eng!=0)  Edit
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
                                        var url = "{{ url('dosen/silabus') }}";
                                        window.open(url+"/"+dosen_kode+"/"+kodebaa+"/"+periode+"/i");
                                    })
                                    $('#{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}e').click(function(e) {
                                        var kodebaa = $(this).attr('name').slice(0,5);
                                        var kurikulum_kode = $(this).attr('name').slice(5,9);
                                        var dosen_kode =  $('#dosen_kode').val();
                                        var url = "{{ url('dosen/silabus') }}";
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
    <script src="{{asset('asset/admin/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('asset/admin/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <script class="include" type="text/javascript" src="{{asset('asset/admin/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('asset/admin/lib/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('asset/admin/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>
@endsection
