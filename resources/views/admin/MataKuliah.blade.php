@extends('admin/MasterAdmin')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Mata Kuliah</h3>
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
                <div>
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                              <input type="text" class="form-control" id="inputSeacrh" placeholder="Nama Mata Kuliah">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn mb-2" style="background-color: rgb(206, 105, 65)"><i class="fa fa-search"></i> Cari</button>
                              </div>
                        </div>
                    </form>
                    <form>
                        <label style="color: black"><i class="fa fa-filter"></i> <b>Filter</b></label>
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label">Program Studi</label>
                            <div class="col-sm-3">
                                <select class="form-control form-control-sm">
                                    <option>Small select</option>
                                  </select>
                            </div>
                            <label class="col-sm-1 col-form-label">Kurikulum</label>
                            <div class="col-sm-3">
                                <select class="form-control form-control-sm">
                                    <option>Small select</option>
                                  </select>
                            </div>
                          </div>
                    </form>
                </div>
                <div class="content-panel">
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Kurikulum</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>

                         <tr>
                            <td>
                                Bahasa Indonesia
                            </td>
                            <td class="hidden-phone">Lorem Ipsum dolor</td>
                            <td>K13</td>
                            <td>
                                Lorem Ipsum Color
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>
                                    Bahasa Indonesia
                                </td>
                                <td class="hidden-phone">Lorem Ipsum dolor</td>
                                <td>K13</td>
                                <td>
                                    Lorem Ipsum Color
                                </td>
                            </tr>
                        </tr>
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
