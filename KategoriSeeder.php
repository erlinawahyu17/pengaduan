<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     Kategori::updateOrcreate(
        ['ket_kategori'=> 'Kerusakan Barang'],
     );
     Kategori::updateOrcreate(
        ['ket_kategori'=>'Kehilangan Barang'],
     );
     Kategori::updateOrcreate(
        ['ket_kategori'=>'Kerusakan Bangunan'],
     );
     Kategori::updateOrcreate(
        ['ket_kategori'=>'Penemuan Barang'],
     );
    }
}
