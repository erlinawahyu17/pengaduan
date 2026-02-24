@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('siswa.store') }} " entype="multipart/form-data">
    @csrf 
    <table cellpadding="5">
        <tr>
            <td>Nama Siswa</td>
            <td><input type="text" name="name" required></td>
        </tr>
         <tr>
            <td>Username</td>
            <td><input type="text" name="username" required></td>
        </tr>
         <tr>
            <td>Nis</td>
            <td><input type="text" name="nis" required></td>
        </tr>
          <tr>
            <td>Kelas</td>
            <td><input type="text" name="kelas"></td>
        </tr>
         <tr>
            <td>Password</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td><button type="submit">Kirim</button></td></tr>
    </table>
</form>
@endsection