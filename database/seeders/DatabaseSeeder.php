<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@argon.com',
            'password' => bcrypt('secret'),
            'role' => 'admin'
            // 'picture' => 'pictures/Logo_Admin.jpg'
        ]);
        
        DB::table('kotaks')->insert([
            ['nama_kotak' => 'Ruang K3L'], 
            ['nama_kotak' => 'Pos Satpam'], 
            ['nama_kotak' => 'Ruang Asmen KU'],
            ['nama_kotak' => 'Ruang SDM'],
            ['nama_kotak' => 'Ruang Drafter (R.perencanaan)'],
            ['nama_kotak' => 'Aula'],
            ['nama_kotak' => 'Ruang Kendaraan (W3)'],
            ['nama_kotak' => 'Ruang Tool (W4)'],
            ['nama_kotak' => 'W2'],
            ['nama_kotak' => 'Ruang CNC'],
            ['nama_kotak' => 'Ruang Mekanikal (Lantai 2)'],
            ['nama_kotak' => 'W1'],
            ['nama_kotak' => 'TPS Limbah B3'],
            ['nama_kotak' => 'Gudang Material Sisa'],
            ['nama_kotak' => 'Ruang P3K'],
                
        ]);    
        
        // DB::table('data_p3ks')->insert([
        //     ['item_name' => 'Alkohol', 'picture' => 'pictures/Alkohol.jpeg'],
        //     ['item_name' => 'Antiseptic', 'picture' => 'pictures/antiseptic.jpg'],
        //     ['item_name' => 'Perban 5cm', 'picture' => 'pictures/Perban.jpg'],
        //     ['item_name' => 'Perban 10cm', 'picture' => 'pictures/Perban.jpg'],
        //     ['item_name' => 'Aquades', 'picture' => 'pictures/Aquades.jpeg'],
        //     ['item_name' => 'Betadine', 'picture' => 'pictures/betadine.jpeg'],
        //     ['item_name' => 'Buku Catatan Daftar Isi', 'picture' => 'pictures/Buku_Catatan_Daftar_isi.jpeg'],
        //     ['item_name' => 'Buku Panduan', 'picture' => 'pictures/Buku_Panduan.jpg'],
        //     ['item_name' => 'Gelas Cuci Mata', 'picture' => 'pictures/Gelas_Cuci_Mata.jpeg'],
        //     ['item_name' => 'Gunting', 'picture' => 'pictures/Gunting.jpeg'],
        //     ['item_name' => 'Kantong Plastik', 'picture' => 'pictures/Kantong_Plastik.png'],
        //     ['item_name' => 'Kapas', 'picture' => 'pictures/kapas.jpg'],
        //     ['item_name' => 'Kasa Steril', 'picture' => 'pictures/kasa_steril.jpeg'],
        //     ['item_name' => 'Lampu Senter', 'picture' => 'pictures/Lampu_Senter.jpeg'],
        //     ['item_name' => 'Masker', 'picture' => 'pictures/Masker.jpeg'],
        //     ['item_name' => 'Peniti', 'picture' => 'pictures/Peniti.jpeg'],
        //     ['item_name' => 'Perban', 'picture' => 'pictures/Perban.jpg'],
        //     ['item_name' => 'Pinset', 'picture' => 'pictures/Pinset.jpeg'],
        //     ['item_name' => 'Plester', 'picture' => 'pictures/Plester.jpeg'],
        //     ['item_name' => 'Plester Cepat', 'picture' => 'pictures/Plester_Cepat.jpeg'],
        //     ['item_name' => 'Sarung Tangan', 'picture' => 'pictures/Sarung_Tangan.jpg'],
        // ]);
    }

    
}
