@extends('dekan/MasterDekan')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Mata Kuliah Fakultas</h3>
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">

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
                             <td>lorem ipsum</td>
                            <td>
                                <a>Mata Kuliah</a>
                            </td>
                            <td>
                                <a>S1 - SIB</a>
                            </td>
                            <td>lorem ipsum</td>
                            <td>lorem ipsum</td>
                            <td>
                                <button class="btn btn-success btn-xs" style="color: white;"data-toggle="collapse" onclick="silab()"><i class="fa fa-plus-circle" ></i> Tambah Silabus</button>
                                <script>
                                    function silab(){
                                        if(document.getElementById('bahasa').style.display==='block'){
                                            document.getElementById('bahasa').style.display='none';
                                        }else document.getElementById('bahasa').style.display='block';
                                    }
                                </script>
                                <div id="bahasa" class="collapse" style="display: none">
                                    <button class="dropdown-item" type="button">Bahasa Indonesia</button>
                                    <button class="dropdown-item" type="button">Bahasa Inggris</button>
                                </div>
                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i> Hapus</button>
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
  <script src="{{asset('asset/admin/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('asset/admin/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{asset('asset/admin/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{asset('asset/admin/lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{asset('asset/admin/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>


  @endsection
