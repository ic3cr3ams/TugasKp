@extends('dosen/MasterDosen')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-user-o"></i> Mata Kuliah yang Ditugaskan</h3>
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel" style="border-radius: 25px;">
                    <table class="table table-striped " id="myTable">
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
                                <td>{{ $kelas->matkul_   }}</td>
                                <td>{{ $kelas->mk_semester  }}</td>
                                <td>{{ $kelas->AkaJurusan->jur_nama }}</td>
                                <td>{{ $kelas->kurikulum_kode }}</td>
                                <td>
                                    @foreach ($silpengisi as $item)
                                        @if ($item->Kode_matkul == $kelas->mk_kodebaa && $kelas->kurikulum_kode ==$item->kurikulum_kode && $item->kode_dosen == Auth::user()->kodeDosen)
                                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal{{ $kelas->kelas_id }}">
                                            <i class="fa fa-plus-circle"></i> Tambah
                                        </button>
                                        <!-- The Modal -->
                                        <div class="modal" id="myModal{{ $kelas->kelas_id }}">
                                            <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Tambah Silabus</h4>
                                                <h5>{{ $kelas->kelas_id }}</h5>
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
                                                                    <button class="btn btn-success btn-xs" style="color: white;"><i class="fa fa-plus-circle"></i> Tambah Silabus</button>
                                                                    <button class="btn btn-danger btn-xs" style="color: white;"><i class="fa fa-trash "></i> Hapus</button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Bahasa Inggris </td>
                                                                <td>
                                                                    <button class="btn btn-warning btn-xs" style="color: white;"><i class="fa fa-pencil"></i> Edit Silabus</button>
                                                                    <button class="btn btn-danger btn-xs" style="color: white;"><i class="fa fa-trash "></i> Hapus</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-dismiss="modal">Simpan</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        @elseif ($item->Kode_matkul == $kelas->mk_kodebaa && $kelas->kurikulum_kode ==$item->kurikulum_kode && $item->kode_dosen != Auth::user()->kodeDosen)
                                            @foreach ($dosen as $dosenn)
                                                @if ($dosenn->dosen_kode == $item->kode_dosen)
                                                    {{$dosenn->dosen_nama_sk}}
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    <!-- Button to Open the Modal -->

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
  {{-- <script class="include" type="text/javascript" src="{{asset('asset/admin/lib/jquery.dcjqaccordion.2.7.js')}}"></script> --}}
  <script src="{{asset('asset/admin/lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{asset('asset/admin/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <!--common script for all pages-->
  {{-- <script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script> --}}
  <!--script for this page-->



  @endsection
