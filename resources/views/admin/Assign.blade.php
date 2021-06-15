@extends('admin/MasterAdmin')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-users"></i> Assign Dosen Pengisi Silabus</h3>
        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel"style="border-radius: 25px;">
                    <form class="col-sm-10">
                        <label style="color: black; font-size:15pt;"><b>Pilih Dosen</b></label>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <select class="form-control form-control-md" style="border-radius: 25px;">
                                    @foreach ($dosen as $atr)
                                        @foreach ($jumlah as $item)
                                            @if ($item->kode_dosen == $atr->dosen_kode)
                                                <option value={{$atr->dosen_kode}}>{{$atr->dosen_nama_sk }} {{$item->jumlah}}</option>
                                            @else
                                                <option value={{$atr->dosen_kode}}>{{$atr->dosen_nama_sk }} &nbsp&nbsp&nbsp&nbsp 0</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                  </select>
                            </div>
                          </div>
                          <label style="color: black;font-size:15pt;"><i class="fa fa-filter"></i> <b>Filter</b></label>
                          <div class="form-group row">
                              <div class="col-sm-4">
                              <label>
                                  <input type="checkbox" value="">
                                   Tampilkan Mata Kuliah yang telah memiliki Dosen
                                  </label>
                              </div>
                              <div class="col-sm-4">
                                  <label>
                                      <input type="checkbox" value="">
                                       Tampilkan Mata Kuliah yang dimiliki oleh Dosen sekarang
                                      </label>
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
                                <th>Nama Dosen</th>
                                <th>Pengisi Silabus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua as $kelas)
                            <tr>
                                <td>{{ $kelas->mk_kodebaa }}</td>
                                <td>{{ $kelas->matkul_nama }}</td>
                                <td>{{ $kelas->mk_semester  }}</td>
                                <td>{{ $kelas->AkaJurusan->jur_nama }}</td>
                                <td>{{ $kelas->kurikulum_kode }}</td>
                                <td>{{$kelas->dosen_nama_sk }}</td>
                                <td>
                                    <select class="js-example-basic-multiple" multiple="multiple" name="dosen">
                                        <option value="" selected> </option>
                                        @foreach ($dosen as $dosenn)
                                            @foreach ($jumlah as $item)
                                                @if ($item->kode_matkul==$semua->mk_kodebaa && $dosen->dosen_kode == $item->kode_dosen)
                                                    <option value="{{$dosenn->dosen_nama_sk}}" selected>{{$dosenn->dosen_nama_sk}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /content-panel -->
                <br>
                <div class="col-sm-5">
                    <a href="/admin/tambahPaket"><button type="submit" class="btn btn-primary" style="border-radius: 25px;"><i class="fa fa-save"></i> Simpan</button></a>
                </div>
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
