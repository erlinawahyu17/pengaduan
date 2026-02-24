<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controller\AuthController;

class AspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $title = 'Daftar aspirasi';
    $status = $request->status;

    $query = Aspirasi::with('user');

    // Role check
    if (Auth::user()->roles !== 'admin') {
        $query->where('user_id', Auth::id());
    }

    // Filter status
    if (!empty($status)) {
        $query->where('status', $status);
    }

    $aspirasi = $query->orderByRaw("FIELD(status,'menunggu','proses','selesai')")
        ->orderByDesc('created_at')
        ->get();

    return view('aspirasi.index', compact('title', 'aspirasi', 'status'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = \App\Models\Kategori::all();
        $title = 'aspirasi';
        return view('aspirasi.create', compact('kategori', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'kategori_id' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',//kilobyte
        ]);
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('aspirasis', 'public');
        }

        aspirasi::create([
            'user_id' => Auth::id(), //mengambil id user yang sedang login agar aspirasi di ketahui
            'title' =>$request->title,
            'description' => $request->description,
            'kategori_id' =>$request->kategori_id,
            'photo' => $photoPath,
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Tiket berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(aspirasi $aspirasi)
    {
        //
        $title = 'Detail Aspirasi';
        $kategori = Kategori::all();
        if (Auth::user()->roles== 'user' && 
        $aspirasi->user_id !== Auth::id()) {
            abort(403);
        }
        return view('aspirasi.show', compact('title', 'aspirasi', 'kategori'));
    }

    public function updateStatus(Request $request, aspirasi $aspirasi) {
        //
        if (Auth::user()->roles!== 'admin') {
            //
            abort(403);
        }
        //
        $aspirasi->update(['status' => $request->status]);
        //
        return redirect()->route('aspirasi.index')->with('success', 'Status tiket di perbarui.');
    }

    }

