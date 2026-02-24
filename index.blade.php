@extends('layouts.app')

@section('content')

@if(session('success'))
<p>{{ session('success') }}</p>
@endif
<button><a href="{{ route('siswa.create') }}">Tambah Data</a></button>
<h4>Akun Siswa</h4>
<table border="1" cellspacing="2" cellpadding="5">
    <thead>
        <tr>
            <th>#</th>
            <th>USERNAME</th>
            <th>NAMA SISWA</th>
            <th>NIS</th>
            <th>KELAS</th>
            <th>Role</th>
            <th>Opsi</th>
            
          
</tr>   
</thead>
<tbody>
    @foreach ($siswa as $s)
    <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $s->username }}</td>
        <td>{{ $s->name }}</td>
        <td>{{ $s->nis }}</td>
        <td>{{ $s->kelas }}</td>
        <td>{{ $s->roles }}</td>
         <td>
            <a href="{{ route('siswa.edit', $s->id) }}">Edit</a>
                <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" style="display:
                inline;">
                @csrf 
                @method('DELETE')
                <button type=" submit " onclick= "return confirm('Hapus User ini?')">Hapus
                </button>
            </form>
                 </td>
                </tr>
@endforeach
</tbody>
</table>

@endsection