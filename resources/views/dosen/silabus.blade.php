@extends('dosen/MasterDosen')
@section('body')
<section id="main-content">
    <section class="wrapper">
        @foreach ($status as $item)
        @if ($bahasa=="i") <input type="hidden" id="status" onchange="isistatus()" value="{{$item->sd_status_ind}}">
        @else <input type="hidden" id="status" value="{{$item->sd_status_eng}}">
        @endif
        @endforeach
        <br>
      <h1 id="judul"><i class="fa fa-angle-right"></i> </h1>
      <h3>@foreach ($matkul_nama as $item) {{$item['matkul_nama']}} </h3>
      <h5>Silabus @if ($bahasa=="i") Bahasa Indonesia
        @else Bahasa Inggris
      @endif </h5>
      <h5>{{$item->mk_sks}} SKS</h5>
      @endforeach
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Materi Kuliah <br>
            <small>Jumlah kata dalam materi kuliah minimum 100 kata : </small><small id="count1">0</small>
            <h4>
            <form class="form-horizontal style-form" method="get">
              <div class="form-group">
                <textarea class="form-control" name="materikuliah" id="mk" onkeypress="countmk()" onload="countmk1()" placeholder="Deskripsi Mengenai Mata Kuliah" rows="5" data-rule="required" data-msg="Tuliskan deskripsi mengenai mata kuliah"></textarea>
                <div class="validate"></div>
              </div>
          </div>
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Tujuan Kuliah <br>
            <small>Jumlah kata dalam tujuan kuliah minimum 40 kata : <small id="count2">0</small></small></h4>

              <div class="form-group">
                <textarea class="form-control" onkeypress="counttujuan()" id="tujuan" placeholder="Tujuan dari Mata Kuliah" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                <div class="validate"></div>
              </div>

          </div>
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i>Silabus</h4>

                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 1</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm1()" id="tm1" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 2</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm2()" id="tm2" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 3</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm3()" id="tm3" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>


                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 4</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm4()" id="tm4" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>


                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 5</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm5()" id="tm5" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>


                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 6</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm6()" id="tm6" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>


                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 7</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm7()" id="tm7" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>


                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 8</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm8()" id="tm8" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 9</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm9()" id="tm9" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 10</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm10()" id="tm10" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 11</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm11()" id="tm11" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 12</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm12()" id="tm12" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 13</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm13()" id="tm13" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Tatap Muka 14</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="counttm14()" id="tm14" placeholder="Penjelasan Materi" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
          </div>
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Referensi Buku</h4>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Referensi Buku 1</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="countrb1()" id="rb1" placeholder="Nama Pengarang.Judul Buku.Edisi Buku.Nama Penerbit.Tahun Terbit" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Referensi Buku 2</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="countrb2()" id="rb2" placeholder="Nama Pengarang.Judul Buku.Edisi Buku.Nama Penerbit.Tahun Terbit" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Referensi Buku 3</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="countrb3()" id="rb3" placeholder="Nama Pengarang.Judul Buku.Edisi Buku.Nama Penerbit.Tahun Terbit" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Referensi Buku 4</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="countrb4()" id="rb4" placeholder="Nama Pengarang.Judul Buku.Edisi Buku.Nama Penerbit.Tahun Terbit" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Referensi Buku 5</label>
                    <div class="form-group">
                        <textarea class="form-control" onkeypress="countrb5()" id="rb5" placeholder="Nama Pengarang.Judul Buku.Edisi Buku.Nama Penerbit.Tahun Terbit" rows="5" data-rule="required" data-msg="Tuliskan Tujuan dari kuliah"></textarea>
                        <div class="validate"></div>
                    </div>
                  </div>
                </form>
            <button class="btn btn-info" id="save"><i class="fa fa-save"></i> Simpan </button>
          </div>
        </div>
      </div>
    </section>
  </section>
  <input type="hidden" id="mk_kodebaa" value="{{$mk_kodebaa}}">
  <input type="hidden" id="periode" value="{{$periode}}">
  <input type="hidden" id="bahasa" value="{{$bahasa}}">
  <input type="hidden" id="periode" value="{{$periode}}">

  <script src="{{asset('asset/admin/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('asset/admin/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{asset('asset/admin/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{asset('asset/admin/lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{asset('asset/admin/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>
  <!--script for this page-->
  <script>
          $(document).ready(function() {
              if ($('#status').val()=="0") {
                $('#judul').append('Tambah Silabus');
              }else {
                    $('#judul').append('Edit Silabus');
                    <?php
                        foreach($data as $value)
                        {
                            echo 'document.getElementById("mk").innerHTML = "'.$value->materi.'";';
                            echo 'document.getElementById("tujuan").innerHTML = "'.$value->tujuan.'";';
                            echo 'document.getElementById("rb1").innerHTML = "'.$value->rb_1.'";';
                            echo 'document.getElementById("rb2").innerHTML = "'.$value->rb_2.'";';
                            echo 'document.getElementById("rb3").innerHTML = "'.$value->rb_3.'";';
                            echo 'document.getElementById("rb4").innerHTML = "'.$value->rb_4.'";';
                            echo 'document.getElementById("rb5").innerHTML = "'.$value->rb_5.'";';
                            echo 'document.getElementById("tm1").innerHTML = "'.$value->tm_1.'";';
                            echo 'document.getElementById("tm2").innerHTML = "'.$value->tm_2.'";';
                            echo 'document.getElementById("tm3").innerHTML = "'.$value->tm_3.'";';
                            echo 'document.getElementById("tm4").innerHTML = "'.$value->tm_4.'";';
                            echo 'document.getElementById("tm5").innerHTML = "'.$value->tm_5.'";';
                            echo 'document.getElementById("tm6").innerHTML = "'.$value->tm_6.'";';
                            echo 'document.getElementById("tm7").innerHTML = "'.$value->tm_6.'";';
                            echo 'document.getElementById("tm8").innerHTML = "'.$value->tm_7.'";';
                            echo 'document.getElementById("tm9").innerHTML = "'.$value->tm_8.'";';
                            echo 'document.getElementById("tm10").innerHTML = "'.$value->tm_9.'";';
                            echo 'document.getElementById("tm11").innerHTML = "'.$value->tm_10.'";';
                            echo 'document.getElementById("tm12").innerHTML = "'.$value->tm_11.'";';
                            echo 'document.getElementById("tm13").innerHTML = "'.$value->tm_12.'";';
                            echo 'document.getElementById("tm14").innerHTML = "'.$value->tm_13.'";';
                        }
                    ?>
                }
          })
        function countmk(e) {document.getElementById('count1').innerHTML= $('#mk').val().split(" ").length.toString();}
        function counttujuan(e) {document.getElementById('count2').innerHTML= $('#tujuan').val().split(" ").length.toString();}
        $('#save').click(function (e) {
            var mk = document.getElementById('count1').textContent;
            var tujuan = document.getElementById('count1').textContent;
            if (mk!="0" && tujuan!="0" ) {
                if (parseInt(mk) < 100) return alert('Kata pada materi kuliah kurang dari 100');
                else if (parseInt(tujuan) < 100) return alert('Kata pada tujuan kurang dari 100');
                else {
                    $.post('{{ url("fill") }}',
                    {
                        "_token": "{{ csrf_token() }}",
                        'materi':$('#mk').val(),
                        'tujuan':$('#tujuan').val(),
                        'tm1':$('#tm1').val(),
                        'tm2':$('#tm2').val(),
                        'tm3':$('#tm3').val(),
                        'tm4':$('#tm4').val(),
                        'tm5': $('#tm5').val(),
                        'tm6': $('#tm6').val(),
                        'tm7': $('#tm7').val(),
                        'tm8': $('#tm8').val(),
                        'tm9': $('#tm9').val(),
                        'tm10': $('#tm10').val(),
                        'tm11': $('#tm11').val(),
                        'tm12': $('#tm12').val(),
                        'tm13': $('#tm13').val(),
                        'tm14': $('#tm14').val(),
                        'rb1': $('#rb1').val(),
                        'rb2': $('#rb2').val(),
                        'rb3': $('#rb3').val(),
                        'rb4': $('#rb4').val(),
                        'rb5': $('#rb5').val(),
                        'mk_kodebaa':$('#mk_kodebaa').val(),
                        'bahasa':$('#bahasa').val(),
                        'kurikulum_kode':$('#periode').val(),
                        'status':$('#status').val(),
                    }
                    ,
                    function (data) {
                        document.getElementById('status').value =data.value;
                        document.getElementById('judul').innerHTML="Edit Silabus";
                        console.log(data);
                        data = $.parseJSON(data);
                        alert(data.hasil);
                    });
                }
            }
            else return alert('Kata pada materi kurang dari 100');
        })
  </script>
@endsection
