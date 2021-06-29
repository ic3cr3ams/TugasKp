@extends('admin/MasterAdmin')
@section('body')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-12 mt-10">
                <h3><i class="fa fa-download"></i> Download Report Pengisian Silabus</h3>
            </div>
            <div class="col-12 px-4">
                <div class="content-panel" style="border-radius: 25px;">
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-1">
                                <button class="btn btn-warning btn-file btn-round ">
                                    <a href="{{ url('admin/history/xlsx') }}" >
                                        <i class="fa fa-download"></i>
                                        <span>xlsx</span>
                                    </a>
                                </button>
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-theme02 btn-file btn-round ">
                                    <a href="{{ url('admin/history/csv') }}" >
                                        <i class="fa fa-download"></i>
                                        <span>csv</span>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>
@endsection
