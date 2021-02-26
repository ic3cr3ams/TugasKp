@extends('admin/MasterAdmin')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Assign Dosen Pengisi Silabus</h3>
        <div class="row mt">
            <div class="col-md-12">
                <div>
                    <form>
                        <div class="input-group mb-3 col-sm-4" style="">
                            <input type="text" class="form-control" placeholder="Mata Kuliah" aria-label="Mata Kuliah" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-outline-success" style="background-color:rgb(155, 238, 155)" type="button"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                    </form>
                
            </div>
                <div class="content-panel"style="border-radius: 25px;">
                    <form class="col-sm-10">
                        <label style="color: black; font-size:15pt;"><b>Pilih Dosen</b></label>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <select class="form-control form-control-md">
                                    <option>Small select</option>
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
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Kurikulum</th>
                                <th>Dosen</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" value="">
                            </td>
                            <td>Nama Matkul
                            </td>
                            <td class="hidden-phone">Lorem Ipsum dolor</td>
                            <td>Lorem Ipsum</td>
                            <td style="color: red"><b>Belum Memiliki Dosen</b></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" value="" disabled>
                            </td>
                            <td>Nama Matkul
                            </td>
                            <td class="hidden-phone">Lorem Ipsum dolor</td>
                            <td>Lorem Ipsum</td>
                            <td><b> Hartarto Junaedi</b></td>
                        </tr>
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
