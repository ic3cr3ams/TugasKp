<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Silabus</title>
</head>
<body>
    {{-- {{dd($silabus)}} --}}
    @foreach ($silabus as $item)
            <h1>Silabus {{$nama->matkul_nama}} Bahasa {{$item->Bahasa}} </h1>
            <hr>
            <h1>Tujuan</h1>
            {{$item->tujuan}}
            <hr>
            <h1>Materi</h1>
            {{$item->materi}}
            <hr>
            <h1>Tatap Muka 1</h1>
            {{$item->tm_1}}
            <hr>
            <h1>Tatap Muka 2</h1>
            {{$item->tm_2}}
            <hr>
            <h1>Tatap Muka 3</h1>
            {{$item->tm_3}}
            <hr>
            <h1>Tatap Muka 4</h1>
            {{$item->tm_4}}
            <hr>
            <h1>Tatap Muka 5</h1>
            {{$item->tm_5}}
            <hr>
            <h1>Tatap Muka 6</h1>
            {{$item->tm_6}}
            <hr>
            <h1>Tatap Muka 7</h1>
            {{$item->tm_7}}
            <hr>
            <h1>Tatap Muka 8</h1>
            {{$item->tm_8}}
            <hr>
            <h1>Tatap Muka 9</h1>
            {{$item->tm_9}}
            <hr>
            <h1>Tatap Muka 10</h1>
            {{$item->tm_10}}
            <hr>
            <h1>Tatap Muka 11</h1>
            {{$item->tm_11}}
            <hr>
            <h1>Tatap Muka 12</h1>
            {{$item->tm_12}}
            <hr>
            <h1>Tatap Muka 13</h1>
            {{$item->tm_13}}
            <hr>
            <h1>Tatap Muka 14</h1>
            {{$item->tm_14}}
            <hr>
            <h1>Referensi Buku 1</h1>
            {{$item->rb_1}}
            <hr>
            <h1>Referensi Buku 2</h1>
            {{$item->rb_2}}
            <hr>
            <h1>Referensi Buku 3</h1>
            {{$item->rb_3}}
            <hr>
            <h1>Referensi Buku 4</h1>
            {{$item->rb_4}}
            <hr>
            <h1>Referensi Buku 5</h1>
            {{$item->rb_5}}
    @endforeach
</body>
</html>
