@extends('dosen/MasterDosen')
@section('body')
<section id="main-content">
    <section class="wrapper site-min-height">
      <h3><i class="fa fa fa-print"></i>Unduh pedoman Silabus</h3>
      <div class="row mt">
        <div class="col-lg-12">
            <a href="{{ asset('Pedoman/Pedoman.pdf') }}" download>
                <img src="{{ asset('Pedoman/Pedoman.pdf') }}" alt="Klik ini !!">
            </a>
        </div>
    </div>
  </section>
</section>
@endsection
