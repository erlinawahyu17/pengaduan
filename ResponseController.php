<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Models\Response;
use App\Models\Aspirasi;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function store(Request $request, aspirasi $aspirasi) {
     $request->validate(['message'=> 'required']);
     if (Auth::user()->roles == 'siswa'
     && $aspirasi->user_id !== Auth::id()){
        abort(403);
     }

     Response::create([
        //
        'aspirasi_id' =>$aspirasi->id,
        //
        'user_id' => Auth::id(),
        //
        'message' => $request->message,
     ]);
    
     //
      return redirect()->route('aspirasi.show', $aspirasi)->with('success',
      'Balasan dikirim.');
}
}