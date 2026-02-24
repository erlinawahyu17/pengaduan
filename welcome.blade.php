<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaduan Sarana Sekolah</title>
</head>
<body>

<h1>Pengaduan Sarana Sekolah</h1>

@auth
    <p>Halo, {{ auth()->user()->name }}</p>
    <a href="{{ route('aspirasi.index') }}">Masuk Aplikasi</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@else
    <a href="{{ route('login') }}">Login</a>
@endauth

</body>
</html>