<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Sarana Sekolah</title>
</head>
<body>
    <h1>Pengaduan Sarana Sekolah</h1>
    <hr>
    <nav style="display: flex; align-items: center; gap: 10px;">
        <a href=" {{ route('aspirasi.index')}}">HOME |</a> 
        @if(auth()->user()->roles == 'siswa')
        <a href=" {{ route('aspirasi.create')}}">Buat aspirasi baru |</a> 
        @endif
         @if(auth()->user()->roles == 'admin')
        <a href="{{ route('siswa.index') }}">Tambah Data Siswa | </a>
        @endif
        <p style="margin: o;"> Hai, {{ auth()->user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
</form>
</nav>
<hr>
@yield('content')
</body>
</html>