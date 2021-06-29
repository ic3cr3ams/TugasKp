@extends('admin/MasterAdmin')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-12 mt-10">
                <h3><i class="fa fa-download"></i> Export Data Silabus</h3>
            </div>
            <div class="col-12 px-4">
                <div class="content-panel" style="border-radius: 25px;">
                    <form action="reportxlsx" method="get">
                        @csrf
                    <div class="col-sm-12">
                        <select class="form-control select2" name="username">
                            @foreach ($jurusan as $atr)
                                <option value={{$atr->jur_kode}}>{{$atr->jur_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="col-12">
                        <button type="submit" class="btn btn-round btn-block btn-success">Export</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
</section>
<script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>
@endsection
