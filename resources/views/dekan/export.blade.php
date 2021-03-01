@extends('dekan/MasterDekan')
@section('body')
<section id="main-content">
    <section class="wrapper site-min-height">
      <h3><i class="fa fa-angle-right"></i>Export Data Silabus Mata Kuliah</h3>
      <div class="row mt">
        <div class="col-lg-12">
          <!-- The file upload form used as target for the file upload widget -->
          <form id="fileupload" action="http://jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
            <!-- Redirect browsers with JavaScript disabled to the origin page -->
            <noscript>
                <input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/">
              </noscript>
            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
            <div class="row fileupload-buttonbar">
              <div class="col-lg-8">
                  <label>Pilih Program Studi : </label>
                <select class="form-control col-sm-5" style="border-radius: 25px;">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                  <br>
                <button type="submit" class="btn btn-info" style="border-radius: 25px;">
                  <i class="fa fa-external-link"></i>
                  <span>Export</span>
                  </button>
              </div>
            </div>
          </form>
          <br>
        </div>
      </div>
    </section>
    <!-- /wrapper -->
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
