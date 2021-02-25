@extends('admin/MasterAdmin')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
              <h3><i class="fa fa-home"></i> Home</h3>
              <!-- BASIC FORM ELELEMNTS -->
              <div class="row mt">
                <div class="col-lg-12">
                  <div class="form-panel">
                    <h4 class="mb"><i class="fa fa-sign-in"></i> Login Sebagai Dosen</h4>
                    <form class="form-horizontal style-form" method="get">
                      <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Pilih Nama Dosen</label>
                          <div class="col-sm-10">
                            <select class="form-control">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                          <br>
                          <div class="col-sm-2">
                            <button type="button" class="btn btn-round btn-block btn-success">Pilih</button>
                          </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-panel">
                    <h4 class="mb"><i class="fa fa-upload"></i> Upload Pedoman Silabus</h4>
                    <div class="form-group">
                      <div class="controls col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                          <span class="btn btn-theme02 btn-file">
                            <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select file</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" />
                          </span>
                          <span class="fileupload-preview" style="margin-left:5px;"></span>
                          <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="col-sm-2">
                    </div>
                  </div>
                </div>
                <!-- col-lg-12-->
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
  @push('js')
  <script src="{{asset('asset/admin/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('asset/admin/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{asset('asset/admin/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{asset('asset/admin/lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{asset('asset/admin/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>
  <!--script for this page-->


  @endpush

  @endsection
