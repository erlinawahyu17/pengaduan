@extends('layouts.app')

@section('content')
<article>
    <header>
        <!-- Menampilkan judul tiket -->
         <h2>{{ $aspirasi->title }}</h2>
         <!-- Menampilkan status tiket -->
          <p>Status: <strong>{{ $aspirasi->status }}</strong></p>
    </header>

    <section>
        <!-- Menampilkan deskripsi tiket -->
         <p><strong>Deskripsi:</strong> {{ $aspirasi->description }}</p>
         @if($aspirasi->photo)
         <h3>Foto Pendukung</h3>
         <img src="{{ asset('storage/' . $aspirasi->photo) }}"
          alt="Foto Aspirasi"
          style ="max-width: 420px; height: auto; border: 1px solid #ccc; padding: 4px">
          @endif
            </section>

    <!-- TODO: Tambahkan bagian untuk menampilkan daftar respon dari user dan admin -->
    <!-- Daftar respon dari user dan admin -->
    <section>
        <hr>
        <h3>Balasan</h3>
        <!-- Mengecek apakah ada balasan pada tiket -->
        @if ($aspirasi->responses->isEmpty())
        <p>Belum ada balasan.</p> <!-- Jika tidak ada balasan, tampilkan pesan ini -->
        @else
        <table>
            <!-- Looping semua balasan yang terkait dengan tiket -->
            @foreach ($aspirasi->responses as $response)
            <tr>
                <!-- Menampilkan nama pengguna yang memberikan balasan -->
                <td><strong>{{ $response->user->name }}</strong></td>
                <!-- Menampilkan isi pesan balasan -->
                <td>{{ $response->message }}</td>
            </tr>
            @endforeach
        </table>
        @endif
    </section>

    <!-- Form untuk mengirim balasan (hanya untuk admin atau pemilik tiket) -->
    @if(auth()->user()->roles == 'admin' || auth()->id() == $aspirasi->user_id)
    <section>
        <hr>
        <h3>Kirim Balasan</h3>
        <!-- Formulir untuk mengirim balasan terkait tiket -->
        <form method="POST" action="{{ route('response.store', $aspirasi) }}">
            @csrf
            <table>
                <tr>
                    <td><label for="message">Pesan:</label></td>
                </tr>
                <tr>
                    <!-- Input textarea untuk mengetik balasan -->
                    <td><textarea id="message" name="message" required></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <!-- Tombol untuk mengirim balasan -->
                        <button type="submit">Kirim Balasan</button>
                    </td>
                </tr>
            </table>
        </form>
    </section>
    @endif



</article>
@endsection