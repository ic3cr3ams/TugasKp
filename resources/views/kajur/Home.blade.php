@extends('kajur/MasterKajur')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-12 mt-3">
                <h3><i class="fa fa-list-alt"></i> Mata Kuliah Jurusan</h3>
            </div>
            <div class="col-12 px-4">
                <div class="content-panel" style="border-radius: 25px;">
                    <table class="cell-border stripe" id="myTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>Semester</th>
                                <th>Kurikulum</th>
                                <th>Nama Dosen Pengisi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelass as $kelas)
                                <tr>
                                    <td>{{ $kelas->mk_kodebaa }}</td>
                                    <td>{{ $kelas->matkul_nama }}</td>
                                    <td>{{ $kelas->mk_semester  }}</td>
                                    <td>{{ $kelas->kurikulum_kode }}</td>
                                    <td>
                                        @php
                                            $hasil="";
                                            foreach ($dosen as $atr){
                                                foreach ($silpengisi as $item){
                                                if ($item->mk_kodebaa == $kelas->mk_kodebaa){
                                                    if ($item->kurikulum_kode == $kelas->kurikulum_kode){
                                                            if ($atr->dosen_kode == $item->dosen_kode) echo($atr->dosen_nama_sk);
                                                            $hasil="ada";
                                                        }
                                                    }
                                                }
                                            }
                                            if ($hasil=="") {
                                                echo "Dosen Belum Terpilih";
                                            }
                                        @endphp
                                    </td>
                                    <td>
                                        <?php $hasil="kosong" ?>
                                        @foreach ($silpengisi as $item)
                                            @if ($item->mk_kodebaa == $kelas->mk_kodebaa && $item ->kurikulum_kode == $kelas->kurikulum_kode)
                                            <button type="button" class="btn
                                                @if ($item->sd_status_ind==3 && $item->sd_status_eng==3) btn-success
                                                @elseif($item->sd_status_ind==0 && $item->sd_status_eng==0) btn-danger
                                                @else btn-warning
                                                @endif
                                                <?php $hasil="isi" ?>
                                            @endif
                                        @endforeach
                                            @if ($hasil=="kosong") <button type="button" class="btn btn-danger
                                            @endif btn-xs"

                                            data-toggle="modal" data-target="#myModal_{{ $kelas->mk_kodebaa.$kelas->kurikulum_kode}}">
                                            @foreach ($silpengisi as $item)
                                                @if ($item->mk_kodebaa == $kelas->mk_kodebaa && $item ->kurikulum_kode == $kelas->kurikulum_kode)
                                                    @if ($item->sd_status_ind!=0 && $item->sd_status_eng!=0) <i class="fa fa-pencil"></i> Edit
                                                    @else <i class="fa fa-plus-circle"></i> Tambah
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if ($hasil=="kosong")
                                                <i class="fa fa-plus-circle"></i> Tambah
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
                                                        @foreach ($silpengisi as $item)
                                                            @if ($item->mk_kodebaa == $kelas->mk_kodebaa && $item ->kurikulum_kode == $kelas->kurikulum_kode)
                                                                @if ($item->sd_status_ind!=0 && $item->sd_status_eng!=0) Edit
                                                                @else Tambah
                                                                @endif Silabus
                                                            @endif
                                                        @endforeach
                                                        @if ($hasil=="kosong")
                                                            Tambah Silabus
                                                        @endif
                                                        {{$kelas->matkul_nama}} {{$kelas->kurikulum_kode}}</h4>
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
                                                                        @foreach ($silpengisi as $item)
                                                                            @if ($item->mk_kodebaa == $kelas->mk_kodebaa && $item->kurikulum_kode == $kelas->kurikulum_kode)
                                                                                @if ($item->sd_status_ind==3) btn-success
                                                                                @elseif($item->sd_status_ind==0) btn-danger
                                                                                @elseif($item->sd_status_ind==1) btn-info
                                                                                @elseif($item->sd_status_ind==2) btn-danger
                                                                                @endif btn-xs" style="color: white;">
                                                                                @if ($item->sd_status_ind!=0) <i class="fa fa-pencil"></i> Edit
                                                                                @else <i class="fa fa-plus-circle"></i> Tambah
                                                                                @endif
                                                                                Silabus</button>
                                                                            @endif
                                                                        @endforeach
                                                                        @if ($hasil=="kosong")
                                                                            btn-danger btn-xs" style="color: white;"> <i class="fa fa-plus-circle"></i> Tambah
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Bahasa Inggris </td>
                                                                    <td>
                                                                        <button id="{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}e"
                                                                        name="{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}"
                                                                        class="btn
                                                                        @foreach ($silpengisi as $item)
                                                                            @if ($item->mk_kodebaa == $kelas->mk_kodebaa && $item ->kurikulum_kode == $kelas->kurikulum_kode)
                                                                                @if ($item->sd_status_eng==3) btn-success
                                                                                @elseif($item->sd_status_eng==0) btn-danger
                                                                                @elseif($item->sd_status_eng==1) btn-info
                                                                                @elseif($item->sd_status_eng==2) btn-danger
                                                                                @endif btn-xs" style="color: white;">
                                                                                @if ($item->sd_status_eng!=0) <i class="fa fa-pencil"></i> Edit
                                                                                @else <i class="fa fa-plus-circle"></i> Tambah
                                                                                @endif
                                                                                Silabus</button>
                                                                            @endif
                                                                        @endforeach
                                                                        @if ($hasil=="kosong")
                                                                            btn-danger btn-xs" style="color: white;"> <i class="fa fa-plus-circle"></i> Tambah
                                                                        @endif
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
                                        var dosen_kode =  "kajur";
                                        var url = "{{ url('kajur/silabus') }}";
                                        window.open(url+"/"+dosen_kode+"/"+kodebaa+"/"+periode+"/i");
                                    })
                                    $('#{{$kelas->mk_kodebaa.$kelas->kurikulum_kode}}e').click(function(e) {
                                        var kodebaa = $(this).attr('name').slice(0,5);
                                        var kurikulum_kode = $(this).attr('name').slice(5,9);
                                        var dosen_kode =  "kajur";
                                        var url = "{{ url('kajur/silabus') }}";
                                        window.open(url+"/"+dosen_kode+"/"+kodebaa+"/"+kurikulum_kode+"/e");
                                    })
                                </script>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /content-panel -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"></script>
<script src="https://cdn.datatables.net/1.10.25/css/dataTables.semanticui.min.css"></script>
  @endsection
