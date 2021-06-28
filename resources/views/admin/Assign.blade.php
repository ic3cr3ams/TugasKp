@extends('admin/MasterAdmin')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-12 mt-10">
                <h3><i class="fa fa-users"></i> Assign Dosen Pengisi Silabus</h3>
            </div>
            <div class="col-12 px-4">
                <div class="content-panel" style="border-radius: 25px;">
                    <div class="col-12">
                    <label style="color: black; font-size:15pt;"><b>Pilih Dosen</b></label>
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <select class="select2 form-control form-control-md" style="border-radius: 25px;" id="dosen">
                                @foreach ($listdosen as $atr)
                                    <option value={{ $atr->dosen_kode }}>{{ $atr->dosen_nama_sk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label style="color: black;font-size:15pt;"><i class="fa fa-filter"></i> <b>Filter</b></label>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>
                                <input type="checkbox" id="matkulkosong" >
                                Tampilkan Mata Kuliah yang telah memiliki Dosen
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <label>
                                <input type="checkbox" id="matkuldosen">
                                Tampilkan Mata Kuliah yang dimiliki oleh Dosen sekarang
                            </label>
                        </div>
                    </div>
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
        </div>
    </section>
</section>
<script>
    $('#matkulkosong').click(function(e) {
        if (!$('#matkuldosen').is(':checked')) {
            if ($('#matkulkosong').is(':checked')) var table = $('.yajra-datatable').DataTable().ajax.url("{{ url('api/matkul/pengisikosong') }}");
            else var table = $('.yajra-datatable').DataTable().ajax.url("{{ url('api/matkul/list') }}");
        }
        $('.yajra-datatable').DataTable().ajax.reload();
    })
    $('#matkuldosen').click(function(e) {
        if ($('#matkuldosen').is(':checked')) {
            var kodedosen = $('#dosen').val();
            var url ="{{ url('api/matkul/slctddosen/') }}";
            var table = $('.yajra-datatable').DataTable().ajax.url(url+"/"+kodedosen);
        }
        else var table = $('.yajra-datatable').DataTable().ajax.url("{{ url('api/matkul/list') }}");
        $('.yajra-datatable').DataTable().ajax.reload();
    })

</script>
<script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>
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
