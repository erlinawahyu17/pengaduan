<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
public function index(){
    $query = User::query();
    $siswa = $query->paginate(10);
    return view('siswa.index', compact('siswa'));
}

public function create() {
    if (Auth::user()->roles !== 'admin'){
        abort(403);
    }
    $title = 'Daftar Akun Siswa';
    return view('siswa.create', compact('title'));
 }

public function store(Request $request) {
    if (Auth::user()->roles !== 'admin'){
        abort(403);
    }
    $request->validate([
        'nis' => 'required',
        'name' => 'required|max:255',
        'username' => 'required|max:255|unique:users',
        'password' => 'required|min:6|max:32',
        'kelas' => 'required',
    ]);
    //
    $user = User::create([
        'nis' => $request->nis,
        'name' => $request->name,
        'username' => $request->username,
        'password' => $request->password,
        'kelas' => $request->kelas,
    ]);
    //
    return redirect()->route('siswa.index')->with('success',
    'Registrasi berhasil');
 }

 public function edit(User $siswa){
    $title = 'Edit Data';
    return view('siswa.edit', compact('title', 'siswa'));
 }

public function update(Request $request, User $siswa) {
    $request->validate([
        'nis' => 'required',
        'name' => 'required|max:255',
        'username' => 'required|max:255|unique:users,username,' . $siswa->id, 
        'password' => 'required|min:6|max:32',
        'kelas' => 'required', 
    ]);
    $siswa->update($request->all());
    return redirect()->route('siswa.index')->with('sukses', 'Berhasil Mengupdate Data');
}
public function destroy(User $siswa){
    $siswa->delete();
     return redirect()->route('siswa.index')->with('sukses', 'Berhasil Menghapus Data');
 }
}
