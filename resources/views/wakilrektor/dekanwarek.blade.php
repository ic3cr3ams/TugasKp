@extends('wakilrektor/MasterWakil')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-list-alt"></i> Mata Kuliah Dekan</h3>
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
                <div>
                    <form method="POST" action="filterdekan">
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
                            <button  class="btn mb-2" style="background-color: #ec697b;border-radius: 25px;" ><i class="fa fa-eraser"></i> Search</button>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
                <div class="content-panel" style="border-radius: 25px;">
                    <table class="table table-striped table-advance table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>Semester</th>
                                <th>Program Studi</th>
                                <th>Kurikulum</th>
                                <th>Nama Dosen</th>
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
  <!--common script for all pages-->
  <script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>
  <!--script for this page-->
  @endsection
