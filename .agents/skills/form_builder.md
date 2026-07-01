---
name: form_builder
description: Skill untuk membuat atau memodifikasi class Livewire Form berdasarkan skema database tabel atau Model Eloquent di Laravel, termasuk penanganan upload dan hapus gambar.
---

# Livewire Form Builder Skill

Skill ini memandu pembuatan dan pembaruan kelas Livewire Form (di direktori `app/Livewire/Forms`) agar konsisten dengan skema database, konvensi penamaan model, dan pemrosesan data sebelum/setelah validasi, termasuk fitur upload gambar otomatis.

## Alur Pembuatan Form

Ketika membuat kelas Form baru atau memodifikasi yang sudah ada, ikuti aturan terstruktur berikut:

### 1. Konvensi Penamaan & Hubungan File
- **Form Class**: Akhiri dengan kata kunci `Form`, contoh: `{Name}Form` (misal: `BlogForm`).
- **Eloquent Model**: Akhiri dengan kata kunci `Model`, contoh: `{Name}Model` (misal: `BlogModel`).
- **Lokasi File Form**: `app/Livewire/Forms/{Name}Form.php`.

### 2. Analisis Skema Database & Gambar
- Baca file migration tabel terkait atau cari informasi skema tabel database untuk mendeteksi:
  - Kolom-kolom fisik database (nama kolom, tipe data, nullable, dll.).
  - Primary Key tabel (misal: `id`, `kodeuser`, `kodeblog`).
- **Deteksi Kolom Password**: Kolom bernama `password` atau berakhiran `_password`.
- **Deteksi Kolom Gambar**: Kolom dengan nama/prefix mengandung kata `gambar` (misal: `gambar`, `gambarblog`, `gambar_produk`).

### 3. Struktur Properti Kelas
- **Properti Kolom Fisik**: Deklarasikan properti `public` untuk setiap kolom fisik database dengan default string kosong `''` atau nilai awal sesuai tipe datanya (misal: `public $gambar = '';`).
- **Properti Password**:
  - Deklarasikan properti utama: `public $password = '';`.
  - Deklarasikan properti cadangan: `public $password_old = '';`.
- **Properti Upload Gambar**:
  - Untuk setiap kolom gambar (misal `gambar`), deklarasikan properti file sementara untuk menerima file upload dari Livewire dengan suffix `File` (contoh: `public $gambarFile;`).
  - Berikan anotasi validasi Livewire pada properti file tersebut:
    ```php
    #[Validate('nullable|image|max:1024', onUpdate: false)] // 1MB Max atau sesuaikan kebutuhan
    public $gambarFile;
    ```
- **Parameter Pembantu (Helper)**: Jika ada properti form yang dideklarasikan tetapi tidak ada di kolom fisik database (seperti `$akses`), tetap deklarasikan sebagai properti `public`.

### 4. Metode `rules()`
- Kembalikan array validasi standar Laravel.
- Pastikan hanya properti yang membutuhkan input/validasi yang masuk ke dalam array rules.
- Jangan pernah memasukkan properti password lama (`*_old`) atau properti file gambar (`*File`) ke dalam aturan validasi di metode ini.

### 5. Metode `setPost(string $id)`
- Mengambil data dari database saat form dalam mode edit/update.
- Gunakan model pasangan untuk mencari data berdasarkan Primary Key.
- Struktur standard:
  ```php
  public function setPost(string $id)
  {
      if(empty($id))
          return;

      $data = {ModelName}::find($id);
      $this->{PrimaryKey} = $data->{PrimaryKey};
      // Pemetaan kolom fisik lainnya...
  }
  ```
- **Khusus Password**: Map nilai hash dari database ke properti `_old`, sedangkan properti utama password dibiarkan kosong agar siap menerima input baru.
  ```php
  $this->password_old = $data->password;
  ```
- **Khusus Gambar**: Map nama file gambar dari database ke properti fisik gambar, sedangkan properti `*File` dibiarkan kosong.
  ```php
  $this->gambar = $data->gambar;
  ```

### 6. Metode `prepare()`
- Wajib sertakan metode boilerplate `prepare()` kosong secara default:
  ```php
  public function prepare()
  {
      // Tempat untuk melakukan pra-proses data sebelum divalidasi
      // Contoh: unformat harga, generate slug/seoname dari nama produk, dll.
  }
  ```

### 7. Metode `aftervalidated()`
- Digunakan untuk memanipulasi data setelah validator berhasil berjalan. Metode ini otomatis dipanggil sebelum proses penyimpanan di `store()` dan `update()`.
- **Pemrosesan Gambar**: Lakukan upload gambar di dalam metode ini agar tidak perlu duplikasi kode di `store()` dan `update()`. Gunakan helper `App\Lib\Upload`:
  ```php
  if ($this->gambarFile) {
      $this->gambar = Upload::image($this->gambarFile, $this->gambar, true);
  }
  ```
- **Pemrosesan Password**: Jika password kosong, pertahaman password lama. Jika diisi, lakukan hashing:
  ```php
  $this->password = (!empty($this->password)) ? Hash::make($this->password) : $this->password_old;
  ```

### 8. Metode `exceptData()`
- Kembalikan list array berisi nama properti yang tidak boleh langsung disimpan ke tabel utama.
- Properti yang wajib dimasukkan ke list pengecualian:
  - Properti password cadangan (`*_old`).
  - Properti file gambar sementara (`*File`, contoh: `'gambarFile'`).
  - **Parameter Pembantu (Helper)**: Seluruh properti yang tidak ada di kolom database fisik (misalnya `$akses`).
- Struktur standard:
  ```php
  private function exceptData()
  {
      $arr = ['password_old', 'gambarFile', 'akses']; // Masukkan field helper, file, & _old di sini
      return $arr;
  }
  ```

### 9. Metode `store()` dan `update()`
- **store()**:
  - Panggil lifecycle: `prepare()`, `validate()`, dan `aftervalidated()`.
  - Simpan menggunakan `{ModelName}::create($this->except($this->exceptData()))`.
  - Berikan komentar/placeholder kustom untuk relasi atau aksi tambahan (post-save hooks).
  - Kembalikan nilai Primary Key dari model yang baru dibuat.
  ```php
  public function store()
  {
      $this->prepare();
      $this->validate();
      $this->aftervalidated();
      $data = {ModelName}::create($this->except($this->exceptData()));

      // *** post-save / relations hook (e.g., set role, upload files, dll.)
      
      return $data->{PrimaryKey};
  }
  ```
- **update()**:
  - Panggil lifecycle: `prepare()`, `validate()`, dan `aftervalidated()`.
  - Update model berdasarkan Primary Key menggunakan `exceptData()`.
  - Berikan komentar/placeholder kustom untuk post-save hooks.
  - Kembalikan nilai Primary Key.
  ```php
  public function update()
  {
      $this->prepare();
      $this->validate();
      $this->aftervalidated();
      {ModelName}::find($this->{PrimaryKey})->update($this->except($this->exceptData()));

      // *** post-save / relations hook (e.g., set role, upload files, dll.)

      return $this->{PrimaryKey};
  }
  ```

### 10. Metode `hapusGambar($kode)`
- Jika tabel database memiliki kolom gambar, wajib membuat metode pembantu penghapusan dengan nama tetap `hapusGambar($kode)`.
- Fungsi ini bertugas menghapus file fisik melalui `Upload::deleteImage` dan mengosongkan nilai kolom database menjadi `""` (string kosong).
- Struktur standard:
  ```php
  public function hapusGambar($kode)
  {
      $data = {ModelName}::find($kode);
      Upload::deleteImage($data->{namaKolomGambar});
      $data->update(['{namaKolomGambar}' => ""]);
  }
  ```
