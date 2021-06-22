@extends('admin/MasterAdmin')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-list-alt"></i> Mata Kuliah</h3>
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
                <div>
                    <form method="POST" action="filtermatakuliah">
                        @csrf
                        <label style="color: black; font-size:15pt;"><i class="fa fa-filter"></i> <b>Filter</b></label>
                        <div class="form-group row col-sm-11">
                            <div class="col-sm-5">
                                <label style="font-size: 10pt;">
                                    Program Studi
                                </label>
                                <select class="form-control" style="border-radius: 25px;" name="jrsn">
                                    <option value="all">--All--</option>
                                    @foreach ($jurusan as $j)
                                        @if (Session::get("jurusan") == $j->jur_kode)
                                            <option value={{$j->jur_kode}} selected>{{$j->jur_nama }}</option>
                                        @else
                                            <option value={{$j->jur_kode}} >{{$j->jur_nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <br>
                                <label style="font-size: 10pt;">
                                    Kurikulum
                                </label>
                                <select class="form-control" style="border-radius: 25px;" name="krklm">
                                    <option value="all">--All--</option>
                                    @foreach ($studi as $kurikulum)
                                        @if (Session::get("kurikulum") == $kurikulum->kurikulum_kode)
                                            <option value={{$kurikulum->kurikulum_kode}} selected>{{$kurikulum->kurikulum_kode }}</option>
                                        @else
                                            <option value={{$kurikulum->kurikulum_kode}}>{{$kurikulum->kurikulum_kode }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <br>
                            <button  class="btn mb-2" style="background-color: #ec697b;border-radius: 25px;"><i class="fa fa-eraser"></i> Search</button>
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
                    <div class="col-12">
                        <table class="table table-bordered yajra-datatable stripe" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Kode Mata Kuliah</th>
                                    <th>Mata Kuliah</th>
                                    <th>Semester</th>
                                    <th>Program Studi</th>
                                    <th>Kurikulum</th>
                                    <th>Nama Dosen</th>
                                    <th>Pengisi Silabus</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /content-panel -->
            </div>
        </div>
        <!-- /row -->
    </section>
</section>
@endsection

@push('js')
    <script>
        $(function () {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('api/matkul/listmatkul') }}",
                columns: [
                    {data: 'mk_kodebaa', name: 'aka_matkul_kurikulum.mk_kodebaa'},
                    {data: 'matkul_nama', name: 'aka_matkul.matkul_nama'},
                    {data: 'mk_semester', name: 'aka_matkul_kurikulum.mk_semester'},
                    {data: 'jur_nama', name: 'aka_jurusan.jur_nama'},
                    {data: 'kurikulum_kode', name: 'aka_matkul_kurikulum.kurikulum_kode'},
                    {data: 'dosen_nama_sk', name: 'tk_dosen.dosen_nama_sk'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        });
    </script>
@endpush
