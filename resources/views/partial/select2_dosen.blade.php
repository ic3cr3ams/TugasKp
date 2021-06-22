<select
 class='form-control form-control-md select2' style='border-radius: 25px;'
id="select2_{{ $selected->mk_kodebaa }}_{{ $selected->kurikulum_kode }}"
data-mk_kodebaa='{{ $selected->mk_kodebaa }}'
data-kurikulum_kode='{{ $selected->kurikulum_kode }}'
data-matkul_nama="{{$selected->matkul_nama}}">

    <option value="Pilih Dosen">Pilih Dosen</option>

    @foreach ($dosen as $atr)
        <option value={{ $atr->dosen_kode }}
        @foreach ($list_dosen as $item)
                @if ($atr->dosen_kode == $item->dosen_kode)
                    @if ($item->mk_kodebaa == $selected->mk_kodebaa)
                        @if ($item->kurikulum_kode == $selected->kurikulum_kode)
                            selected
                        @endif
                    @endif
                @endif
        @endforeach
        >{{ $atr->dosen_nama_sk }}</option>
    @endforeach
</select>


<script>
    $(document).ready(function() {
        $('#select2_{{ $selected->mk_kodebaa }}_{{ $selected->kurikulum_kode }}').select2();
        $('#select2_{{ $selected->mk_kodebaa }}_{{ $selected->kurikulum_kode }}').on('select2:select', function (e) {

            if ($(this).val()=='Pilih Dosen') {
                return alert('Dosen belum terpilih')
            }
            console.log($(this).data('mk_kodebaa'));
            console.log($(this).data('kurikulum_kode'));
            console.log($(this).val());

            $.post('{{ url("api/matkul/assign") }}',
                    {
                        'mk_kodebaa':$(this).data('mk_kodebaa'),
                        'kurikulum_kode':$(this).data('kurikulum_kode'),
                        'dosen_kode':$(this).val(),
                    }
                    ,
                    function (data) {
                        console.log(data);

                        data = $.parseJSON(data);
                        alert(data.message +"dengan ");
                    }
            );
        });
    });
</script>
