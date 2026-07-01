<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OurServiceModel;
use App\Models\PaketModel;
use App\Models\TestimoniModel;
use App\Models\GaleriModel;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Our Services (Selling Points)
        OurServiceModel::create([
            'title' => 'Layanan Chat 24/7',
            'description' => 'Layanan bantuan darurat dan reservasi cepat yang siap melayani Anda 24 jam sehari, 7 hari seminggu.',
        ]);
        OurServiceModel::create([
            'title' => 'Armada Prima & Bersih',
            'description' => 'Kondisi semua armada dijamin prima, terawat, bersih, dan harum untuk memastikan kenyamanan perjalanan Anda.',
        ]);
        OurServiceModel::create([
            'title' => 'Lokasi Strategis di Bali',
            'description' => 'Lokasi pool kami sangat strategis dan dekat dengan bandara untuk kemudahan penjemputan dan pengembalian unit.',
        ]);
        OurServiceModel::create([
            'title' => 'Sopir Profesional & Berpengalaman',
            'description' => 'Didukung oleh sopir profesional yang ramah, berpengalaman, dan memahami rute-rute terbaik di Bali.',
        ]);

        // 2. Seed Paket Rental
        PaketModel::create([
            'tipe_mobil' => 'SUV',
            'merk' => 'Toyota',
            'mobil' => 'Rush',
            'harga' => 450000,
            'isDriver' => true,
            'isFuel' => false,
            'fasilitas' => 'Air Mineral, AC Dingin, Tissue',
        ]);
        PaketModel::create([
            'tipe_mobil' => 'SUV',
            'merk' => 'Daihatsu',
            'mobil' => 'Terios',
            'harga' => 400000,
            'isDriver' => false,
            'isFuel' => false,
            'fasilitas' => 'Air Mineral, Charger HP',
        ]);
        PaketModel::create([
            'tipe_mobil' => 'Mobil Besar/Keluarga',
            'merk' => 'Toyota',
            'mobil' => 'Innova Reborn',
            'harga' => 750000,
            'isDriver' => true,
            'isFuel' => true,
            'fasilitas' => 'Air Mineral, Snack, Tissue',
        ]);
        PaketModel::create([
            'tipe_mobil' => 'Mobil Mewah (Luxury)',
            'merk' => 'Toyota',
            'mobil' => 'Alphard',
            'harga' => 2000000,
            'isDriver' => true,
            'isFuel' => true,
            'fasilitas' => 'Air Mineral, Snack, Selimut, Buah-buahan segar',
        ]);

        // 3. Seed Testimoni
        TestimoniModel::create([
            'nama' => 'Budi Santoso',
            'alamat' => 'Jakarta',
            'isi' => 'Sangat puas dengan pelayanan Bali Car Rental. Mobil Alphard-nya bersih wangi, dan driver-nya sangat profesional serta sabar mengantar keliling Kuta.',
        ]);
        TestimoniModel::create([
            'nama' => 'Siti Aminah',
            'alamat' => 'Surabaya',
            'isi' => 'Sewa Innova lepas kunci mudah sekali prosesnya. Mobil dalam keadaan sehat tanpa kendala selama 4 hari keliling Bali.',
        ]);

        // 4. Seed Galeri (no image files, just record names for now)
        GaleriModel::create([
            'nama' => 'Armada Alphard Luxury',
            'gambar' => '',
        ]);
        GaleriModel::create([
            'nama' => 'Penjemputan Tamu Bandara',
            'gambar' => '',
        ]);
    }
}
