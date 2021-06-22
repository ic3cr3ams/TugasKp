@extends('admin/MasterAdmin')
@section('body')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-12 mt-3">
                    <h3><i class="fa fa-users"></i> Assign Dosen Pengisi Silabus</h3>
                </div>
                <div class="col-12 px-4">
                    <div class="content-panel row" style="border-radius: 25px;">
                        <form class="col-sm-10">
                            <label style="color: black; font-size:15pt;"><b>Pilih Dosen</b></label>
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <select class="select2 form-control form-control-md" style="border-radius: 25px;" name="dosen">
                                        @foreach ($listdosen as $atr)
                                            <option value={{ $atr->dosen_kode }}>{{ $atr->dosen_nama_sk }} | {{ $atr->jumlah??0 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <label style="color: black;font-size:15pt;"><i class="fa fa-filter"></i> <b>Filter</b></label>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label>
                                        <input type="checkbox" value="">
                                        Tampilkan Mata Kuliah yang telah memiliki Dosen
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <label>
                                        <input type="checkbox" value="">
                                        Tampilkan Mata Kuliah yang dimiliki oleh Dosen sekarang
                                    </label>
                                </div>
                            </div>
<<<<<<< Updated upstream
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
=======
                    </form>
                    <table class="table table-striped table-advance table-hover" id="myTable">
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
                            @foreach ($semua as $kelas)
                            <tr>
                                <td>{{ $kelas->mk_kodebaa }}</td>
                                <td>{{ $kelas->matkul_nama }}</td>
                                <td>{{ $kelas->mk_semester  }}</td>
                                <td>{{ $kelas->AkaJurusan->jur_nama }}</td>
                                <td>{{ $kelas->kurikulum_kode }}</td>
                                <td>{{$kelas->dosen_nama_sk }}</td>
                                <td>
                                    <select class="js-example-basic-single" name="dosen">
                                        <option value="" selected> </option>
                                        @foreach ($dosen as $dosenn)
                                            <option value="{{$dosenn->dosen_nama_sk}}">{{$dosenn->dosen_nama_sk}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /content-panel -->
                <br>
                <div class="col-sm-5">
                    <a href="/admin/tambahPaket"><button type="submit" class="btn btn-primary" style="border-radius: 25px;"><i class="fa fa-save"></i> Simpan</button></a>
>>>>>>> Stashed changes
                </div>
            </div>
        </section>
    </section>
@endsection

@push('js')
    <script>
        $(function () {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('api/matkul/list') }}",
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
