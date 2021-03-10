@extends('kajur/MasterKajur')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-list-alt"></i> Mata Kuliah Jurusan</h3>
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
                <div>
                   
                    <form>
                        <label style="color: black; font-size:15pt;"><i class="fa fa-filter"></i> <b>Filter</b></label>
                        <div class="form-group row col-sm-5">
                            <div class="col-auto">
                                <label style="font-size: 10pt;">
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                    Program Studi
                                </label>
                            </div>
                            <div class="col-auto">
                                <label style="font-size: 10pt;">
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                    Kurikulum
                                </label>
                            </div>
                          </div>
                        <div>
                                <div class="col-sm-5">
                                    <select class="form-control" style="border-radius: 25px;">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                      </select>
                                      <br>
                                <button type="submit" class="btn mb-2" style="background-color: #ec697b;border-radius: 25px;"><i class="fa fa-eraser"></i> Hapus</button>
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
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Kurikulum</th>
                                <th>Nama Dosen</th>
                                <th>Action</th>
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
                            <td>
                                Lorem Ipsum Color
                            </td>
                            <td>
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal">
                                        <i class="fa fa-plus-circle"></i> Tambah
                                    </button>
                                    <!-- The Modal -->
                                    <div class="modal" id="myModal">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                    
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title">Tambah Silabus</h4>
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
                                                                <button class="btn btn-success btn-xs" style="color: white;"><i class="fa fa-check-circle"></i> Tambah Silabus</button>  
                                                                <button class="btn btn-danger btn-xs" style="color: white;"><i class="fa fa-ban "></i> Tolak</button>  
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bahasa Inggris </td>
                                                            <td>
                                                                <button class="btn btn-warning btn-xs" style="color: white;"><i class="fa fa-pencil"></i> Edit Silabus</button>  
                                                                <button class="btn btn-danger btn-xs" style="color: white;"><i class="fa fa-ban "></i> Tolak</button>  
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
                                <td>
                                    Lorem Ipsum Color
                                </td>
                                <td>
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal">
                                        <i class="fa fa-plus-circle"></i> Tambah
                                    </button>
                                    <!-- The Modal -->
                                    <div class="modal" id="myModal">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                    
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title">Tambah Silabus</h4>
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
