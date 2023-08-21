<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Barang::create([
            'nm_barang'     => 'Televisi Sharp',
            'hrg_beli'      => 1250000,
            'hrg_jual'      => 1500000,
            'deskripsi'     => 'Ini adalah deskripsi Televisi Sharp',
            'kategori_id'   => 1
        ]);
        Barang::create([
            'nm_barang' => 'Laptop Lenovo',
            'hrg_beli'  => 5500000,
            'hrg_jual'  => 6500000,
            'deskripsi' => 'Ini adalah deskripsi laptop Lenovo',
            'kategori_id'   => 1
        ]);

        Kategori::create([
            'kategori'  => 'elektronik'
        ]);
    }
}
