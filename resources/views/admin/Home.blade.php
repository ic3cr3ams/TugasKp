@extends('admin/MasterAdmin')
@section('body')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-12 mt-3">
                <h3><i class="fa fa-home"></i> Home</h3>
                </div>
                <div class="col-12 px-4">
                    <div class="content-panel" style="border-radius: 25px;">
                    <h4 class="mb"><i class="fa fa-sign-in"></i> Login Sebagai Dosen</h4>
                    <form class="form-horizontal style-form" method="POST" action="pilihdosen">
                        @csrf
                        <input type="hidden" name="password" value="123">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Pilih Nama Dosen</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="username">
                                    @foreach ($dosen as $atr)
                                        <option value={{$atr->karyawan_intranet}}>{{$atr->dosen_nama_sk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="col-sm-2">
                                <button  class="btn btn-round btn-block btn-success">Pilih</button>
                            </div>
                        </div>
                    </form>
                    <h4 class="mb"><i class="fa fa-upload"></i> Upload Pedoman Silabus</h4>
                    <div class="form-group">
                        <div class="controls col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <span class="btn btn-theme02 btn-file btn-round ">
                                <input type="file"/>
                            </span>
                            <span class="fileupload-preview" style="margin-left:5px;"></span>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </section>
    </section>
  @endsection
