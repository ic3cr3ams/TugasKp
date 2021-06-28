@extends('dekan/MasterDekan')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <br>
      <h1><i class="fa fa-angle-right"></i>
        @foreach ($status as $item)
        @if ($item->sd_status=="0") Tambah
        @else Edit
        @endif Silabus</h1>
        @endforeach
      <h3>@foreach ($matkul_nama as $item) {{$item['matkul_nama']}} </h3>
      <h5>Silabus @if ($bahasa=="i") Bahasa Indonesia
        @else Bahasa Inggris
      @endif </h5>
      <h5>{{$item->mk_sks}} SKS</h5>
      @endforeach
      <!-- BASIC FORM ELELEMNTS -->
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Materi Kuliah</h4>
            <h5>Minimal 100 kata</h5>
            <form class="form-horizontal style-form" method="get">
              <div class="form-group">
                <textarea class="form-control" name="materikuliah" id="contact-message" placeholder="Deskripsi Mengenai Mata Kuliah" rows="5" data-rule="required" data-msg="Tuliskan deskripsi mengenai mata kuliah"></textarea>
                <div class="validate"></div>
              </div>
            </form>
          </div>
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Tujuan Kuliah Kuliah</h4>
            <form class="form-horizontal style-form" method="get">
              <div class="form-group">
                <textarea class="form-control" name="message" id="contact-message" placeholder="Tujuan dari Mata Kuliah" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                <div class="validate"></div>
              </div>
            </form>
          </div>
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i>Silabus</h4>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 1</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 2</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 3</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 4</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 5</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 6</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 7</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 8</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 9</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 10</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 11</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 12</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 13</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 14</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
          </div>
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Referensi Buku</h4>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Referensi Buku 1</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Nama Pengarang.Judul Buku.Edisi Buku.Nama Penerbit.Tahun Terbit" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Referensi Buku 2</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Nama Pengarang.Judul Buku.Edisi Buku.Nama Penerbit.Tahun Terbit" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Referensi Buku 3</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Nama Pengarang.Judul Buku.Edisi Buku.Nama Penerbit.Tahun Terbit" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Referensi Buku 4</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Nama Pengarang.Judul Buku.Edisi Buku.Nama Penerbit.Tahun Terbit" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <form class="form-horizontal style-form" method="get">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Referensi Buku 5</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="contact-message" placeholder="Nama Pengarang.Judul Buku.Edisi Buku.Nama Penerbit.Tahun Terbit" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
            </form>
            <button class="btn btn-info"><i class="fa fa-save"></i> Simpan </button>
          </div>
        </div>
        <!-- col-lg-12-->
      </div>
      <!-- /row -->
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
  <script>

  </script>
@endsection
