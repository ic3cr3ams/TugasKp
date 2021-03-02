@extends('kajur/MasterKajur')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Verifikasi Silabus Dosen</h3>
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel">
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Kurikulum</th>
                                <th>Deskripsi</th>
                                <th>Nama Dosen</th>
                                <th>Silabus</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <a>Mata Kuliah</a>
                                </td>
                                <td>Lorem Ipsum dolor</td>
                                <td>
                                    <a>K13</a>
                                </td>
                                <td>Lorem Ipsum dolor</td>
                                <td>Lorem Ipsum dolor</td>
                                <td>
                                    <button class="btn btn-primary btn-xs" style="color: white;"><i class="fa fa-file-text"></i> Lihat Silabus</button>  
                                </td>
                                <td>
                                    <!-- Button to Open the Modal -->
                                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-check-circle"></i> Verifikasi
                                        </button>
                                        <!-- The Modal -->
                                        <div class="modal" id="myModal">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                        
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Verifikasi Silabus</h4>
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
                                                                    <button class="btn btn-success btn-xs" style="color: white;"><i class="fa fa-check-circle"></i> Setujui</button>  
                                                                    <button class="btn btn-danger btn-xs" style="color: white;"><i class="fa fa-ban "></i> Tolak</button>  
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Bahasa Inggris </td>
                                                                <td>
                                                                    <button class="btn btn-success btn-xs" style="color: white;"><i class="fa fa-check-circle"></i> Setujui</button>  
                                                                    <button class="btn btn-danger btn-xs" style="color: white;"><i class="fa fa-ban "></i> Tolak</button>  
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
