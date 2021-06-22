@foreach ($dosen as $atr)
    @foreach ($list_dosen as $item)
            @if ($atr->dosen_kode == $item->dosen_kode)
                @if ($item->mk_kodebaa == $selected->mk_kodebaa)
                    @if ($item->kurikulum_kode == $selected->kurikulum_kode)
                        {{$atr->dosen_nama_sk}}
                    @endif
                @endif
            @endif
    @endforeach
@endforeach
