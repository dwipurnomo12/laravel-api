<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Validation\Factory;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ud_ID');
        for($i=0; $i<10; $i++){
            Barang::create([
                'nm_barang'     => $faker->sentence,
                'hrg_jual'      => $faker->randomNumber(6),
                'hrg_beli'      => $faker->randomNumber(6),
                'deskripsi'     => $faker->paragraph,
            ]);
        }
    }
}
