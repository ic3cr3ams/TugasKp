@extends('kajur/MasterKajur')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Assign Dosen Pengisi Silabus</h3>
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
                <div>
                <form>
                    <label style="color: black; font-size:15pt;"><b>Pilih Dosen</b></label>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <select class="form-control form-control-md">
                                <option>Small select</option>
                              </select>
                        </div>
                      </div>
                </form>
                <form>
                    <label style="color: black"><i class="fa fa-filter"></i> <b>Filter</b></label>
                    <div class="form-group row">
                        <div class="col-sm-3">
                        <label>
                            <input type="checkbox" value="">
                             Tampilkan Mata Kuliah yang telah memiliki Dosen
                            </label>
                        </div>
                        <div class="col-sm-5">
                            <label>
                                <input type="checkbox" value="">
                                 Tampilkan Mata Kuliah yang dimiliki oleh Dosen sekarang
                                </label>
                        </div>
                      </div>
                </form>
            </div>
                <div class="content-panel">
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Deskripsi</th>
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
                <div>
                    <a href="/admin/tambahPaket"><button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button></a>
                </div>
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
