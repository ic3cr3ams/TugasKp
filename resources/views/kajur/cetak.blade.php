@extends('kajur/MasterKajur')
@section('body')
<section id="main-content">
<section class="wrapper site-min-height">
    <h3><i class="fa fa fa-print"></i>Cetak PDF Silabus</h3>
    <div class="row mt">
    <div class="col-lg-12">
        {{-- <!-- The file upload form used as target for the file upload widget -->
        <form id="fileupload" action="http://jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript>
            <input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/">
            </noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload --> --}}
        {{-- {{dd($kelass)}} --}}
        <div class="row fileupload-buttonbar">
            <div class="col-lg-8">
                <form action="cetakpdf" method="get">
                    @csrf
                    <select class="form-control select2" name="kode">
                        @foreach ($kelass as $item)
                            <option value="{{$item->mk_kodebaa.$item->kurikulum_kode}}">{{$item->matkul_nama}} - {{$item->kurikulum_kode}}</option>
                        @endforeach
                    </select>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-info ">
                        <i class="fa fa-print"></i>
                        <span>Cetak PDF</span>
                        </button>
                </form>
            </div>
        </div>
        </form>
        <br>
    </div>
    </div>
</section>
</section>
<script src="{{asset('asset/admin/lib/jquery/jquery.min.js')}}"></script>
<script src="{{asset('asset/admin/lib/bootstrap/js/bootstrap.min.js')}}"></script>
<script class="include" type="text/javascript" src="{{asset('asset/admin/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('asset/admin/lib/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('asset/admin/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
<!--common script for all pages-->
<script src="{{asset('asset/admin/lib/common-scripts.js')}}"></script>
<!--script for this page-->
@endsection
