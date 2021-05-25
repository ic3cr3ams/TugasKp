@extends('dekan/MasterDekan')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-user-o"></i> Mata Kuliah Dekan</h3>
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
                <div>
                    <form method="POST" action="filtermatkuldekan">
                        @csrf
                        <label style="color: black; font-size:15pt;"><i class="fa fa-filter"></i> <b>Filter</b></label>
                        <div class="form-group row col-sm-11">
                            <div class="col-sm-5">
                                <label style="font-size: 10pt;">
                                    Program Studi
                                </label>
                                <select class="form-control" style="border-radius: 25px;" name="jrsn">
                                    <option value="all">--All--</option>
                                    @foreach ($jurusan as $j)
                                        @if (Session::get("jurusan") == $j->jur_kode)
                                            <option value={{$j->jur_kode}} selected>{{$j->jur_nama }}</option>
                                        @else
                                            <option value={{$j->jur_kode}} >{{$j->jur_nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <br>
                                <label style="font-size: 10pt;">
                                    Kurikulum
                                </label>
                                <select class="form-control" style="border-radius: 25px;" name="krklm">
                                    <option value="all">--All--</option>
                                    @foreach ($studi as $kurikulum)
                                        @if (Session::get("kurikulum") == $kurikulum->kurikulum_kode)
                                            <option value={{$kurikulum->kurikulum_kode}} selected>{{$kurikulum->kurikulum_kode }}</option>
                                        @else
                                            <option value={{$kurikulum->kurikulum_kode}}>{{$kurikulum->kurikulum_kode }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <br>
                            <button  class="btn mb-2" style="background-color: #ec697b;border-radius: 25px;"><i class="fa fa-eraser"></i> Search</button>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
                <div class="content-panel" style="border-radius: 25px;">
                    <form>
                        <div class="form-row col-sm-9">
                            <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="inputSeacrh" placeholder="Nama Mata Kuliah">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn mb-2" style="background-color: #afec85"><i class="fa fa-search"></i> Cari</button>
                              </div>
                        </div>
                    </form>
                    <table class="table table-striped table-advance table-hover" id="myTable">
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
                                    <!-- Button to Open the Modal -->
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
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{asset('asset/admin/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('asset/admin/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{asset('asset/admin/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{asset('asset/admin/lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{asset('asset/admin/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>
  <!--script for this page-->

@endsection
