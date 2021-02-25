@extends('kajur/MasterKajur')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Mata Kuliah Jurusan</h3>
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
                                <td>
                                    <button class="btn btn-success btn-xs" style="color: white;"><i class="fa fa-plus-circle"></i> Add Silabus</button>
                                    <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i> Delete</button>
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
