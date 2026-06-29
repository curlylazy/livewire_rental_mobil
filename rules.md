# Proyek Website: Bali Car Rental

## 1. Stack Teknologi
* **Framework:** Laravel 13
* **Komponen:** Livewire 4
* **Styling:** Tailwind CSS

## 2. Persiapan Data (Content Inventory)
Untuk membangun website yang kredibel, berikut adalah aset yang perlu disiapkan:

* **Pengelompokan Armada:**
    * **SUV:** Terios, Rush.
    * **Mobil Besar/Keluarga:** APV, HiACE, Innova.
    * **Mobil Mewah (Luxury):** Alphard, Vellfire.
* **Keunggulan Layanan (Selling Points):**
    * Layanan Chat 24/7 untuk bantuan darurat atau reservasi.
    * Kondisi armada prima (terawat, bersih, dan harum).
    * Lokasi strategis di Bali untuk kemudahan penjemputan.
    * Sopir profesional dan berpengalaman.
* **Profil Bisnis:** Visi-misi Bali Car Rental.
* **Kontak:** Nomor WhatsApp bisnis, alamat email, dan titik koordinat Google Maps.

---

## 3. Struktur Menu Website

| Menu | Konten Utama |
| :--- | :--- |
| **Beranda (Home)** | *Hero Section* (Foto Alphard + Teks: "Perjalanan Nyaman dan Elegan di Pulau Dewata"), Keunggulan Kami (Chat 24/7, Armada Terawat, Harga Kompetitif), & Preview Kategori Armada. |
| **Armada (Fleet)** | Katalog detail per kategori: SUV (Terios, Rush), Mobil Besar (APV, HiACE, Innova), dan Luxury (Alphard, Vellfire). |
| **Layanan (Services)** | Detail paket (Lepas Kunci, Harian + Sopir, Paket Wisata Bali). |
| **Tentang Kami** | Visi, misi, dan komitmen Bali Car Rental melayani wisatawan. |
| **Kontak** | Tombol CTA "Chat via WhatsApp 24/7" dan peta lokasi pool. |

untuk kebutuhan data photonya kamu bisa gunakan dari unsplash dulu untuk dummy photonya

## 3.1 Halaman Paket Armada
- pada bagian hero section buat ukuran nya lebih pendek, dengan tagline "Armada Handal, Kapan Saja dan Dimana Saja"
- berikan background image dibagian hero sectionnya
- kemudian lanjutkan dengan bagian daftar armadanya, dengan komposisi seperti ini
    1. ada bagian kata kunci pencarian berupa text box, kemudian tambahkan dropdown kategori mobil yang dingiinkan
    2. pada bagian daftar armadanya, isinya adalah : 
        - photo mobilnya, 
        - nama mobilnya, 
        - harga (berikan warna yang berbeda dan lebih bold), 
        - paket ini include apa saja, (driver, bensin)
        - fasilitas : Air Mineral, Snack, Selimut, Buah
        - Waktu Pemakaian : full day, half day
        - tambahkan contact wa, dengan tulisan booking now, ketika di klik akan langsung mengarah ke kontak WA.
---

## 4. Panduan Desain & UX
* **Identitas Visual:** Menggunakan kombinasi warna elegan (Putih, Biru Tua, Aksen Emas) untuk membangun kepercayaan dan kesan mewah.
* **Navigasi Mobile:** Implementasi *floating button* (tombol melayang) WhatsApp 24/7 di sudut layar agar mudah diakses wisatawan kapan saja.
* **Responsivitas:** Desain harus *mobile-first* menggunakan sistem *grid* dan *utility classes* dari Tailwind CSS.

---

## 5. Aturan Pemrograman & Konvensi Kode
* **Konvensi Penamaan Model:** Semua file model dan class-nya di direktori `app/Models` wajib menggunakan akhiran `Model` (contoh: `GaleriModel.php` dengan class `GaleriModel`, `PaketModel.php` dengan class `PaketModel`, dst.).
* **Properti Tabel Eksplisit:** Karena penamaan model menggunakan akhiran `Model` (misalnya `PaketModel`), setiap model harus mendefinisikan properti `$table` secara eksplisit untuk menunjuk ke tabel database yang tepat (contoh: `protected $table = 'paket';`).
* **Rendering View pada Livewire Single File Component:** Jangan gunakan attribute class seperti `#[Title(...)]` atau `#[Layout(...)]` untuk mengatur title dan layout view. Lebih baik definisikan secara eksplisit menggunakan method `render()` yang mengembalikan `$this->view()->layout(...)->title(...)` (contoh: `return $this->view()->layout('layouts.app')->title('Login Admin');`).