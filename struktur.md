# Struktur & Arsitektur Projek (Monolit)

Projek ini adalah aplikasi web rental mobil (**Bali Car Rental**) berbasis **Laravel 13** dan **Livewire 4**. Projek ini menggunakan arsitektur **Monolit** di mana seluruh logika bisnis, database, front-end, dan panel admin berada dalam satu repositori tunggal.

## 1. Pembagian Area Aplikasi

Aplikasi ini dibagi menjadi dua area utama yang memisahkan akses pengguna:
1. **Front-End (Guest Area):** Ditujukan untuk calon pelanggan atau tamu umum (guest) yang ingin melihat katalog armada, layanan, informasi kontak, dan profil perusahaan.
2. **Admin Panel (Admin Area):** Ditujukan untuk administrator atau pengelola rental untuk mengelola data armada, paket, layanan, testimonial, galeri, serta pengguna sistem.

---

## 2. Struktur Direktori Utama

Berikut adalah penjelasan fungsi direktori penting di dalam projek ini:

### 📂 `app/`
Direktori ini berisi seluruh logika backend berbasis PHP:
* **`app/Http/`**: Berisi Middleware dan controller standar (jika diperlukan).
* **`app/Lib/`**: Helper class kustom untuk fungsionalitas tambahan (misalnya, `Upload.php` untuk memproses unggahan gambar menggunakan Intervention Image).
* **`app/Livewire/Forms/`**: Berisi Form Objects Livewire (seperti [UserForm.php](file:///e:/web/livewire_rental_mobil/app/Livewire/Forms/UserForm.php)) yang bertugas mengelola validasi input dan state form secara terpisah dari file view/controller utama.
* **`app/Models/`**: Berisi Eloquent Model (seperti [UserModel.php](file:///e:/web/livewire_rental_mobil/app/Models/UserModel.php), [PaketModel.php](file:///e:/web/livewire_rental_mobil/app/Models/PaketModel.php)) yang terhubung ke database.

### 📂 `resources/`
Direktori ini berisi aset front-end dan template tampilan (views):
* **`resources/views/layouts/`**: Berisi master layout aplikasi:
  * `front.blade.php`: Layout utama untuk area guest/pelanggan.
  * `admin.blade.php`: Layout utama untuk panel admin.
  * `app.blade.php`: Layout default bawaan.
* **`resources/views/pages/`**: Folder tempat komponen utama Livewire dideklarasikan menggunakan pendekatan *Single File Component (SFC)*:
  * `front/`: Halaman-halaman untuk area guest (Home, Armada, Layanan, Tentang Kami, dll.).
  * `admin/`: Halaman-halaman untuk area administrator (Dashboard, Manajemen User, Form Login Admin).
* **`resources/views/components/`**: Komponen visual kecil/reusable (seperti tombol, alert, modal) yang digunakan di berbagai halaman.

### 📂 `routes/`
* **`routes/web.php`**: Berisi definisi rute web. Di sini rute tidak mengarah ke Controller tradisional, melainkan langsung memetakan URL ke Livewire Page Components menggunakan `Route::livewire()`.

---

## 3. Sistem Routing & Namespace Livewire

Di Livewire 4, projek ini menggunakan fitur **Component Namespaces** untuk menyederhanakan pemetaan rute ke view. Konfigurasi ini dideklarasikan di [config/livewire.php](file:///e:/web/livewire_rental_mobil/config/livewire.php):

```php
'component_namespaces' => [
    'layouts' => resource_path('views/layouts'),
    'pages' => resource_path('views/pages'),
    'pages-front' => resource_path('views/pages/front'),
    'pages-admin' => resource_path('views/pages/admin'),
    'components' => resource_path('views/components'),
],
```

### Implementasi di `routes/web.php`
Dengan pemetaan namespace di atas, rute dapat ditulis dengan lebih ringkas tanpa perlu membuat file kelas Controller PHP terpisah untuk setiap halaman:

* **Rute Guest (Front):**
  ```php
  Route::livewire('/', 'pages::dashboard')->name('dashboard');
  ```
  Rute di atas akan merender file `resources/views/pages/dashboard.blade.php`.

* **Rute Admin:**
  ```php
  Route::livewire('/admin/login', 'pages-admin::login')->name('admin_login');

  Route::prefix('/admin')->middleware('auth')->group(function () {
      Route::livewire('/dashboard', 'pages-admin::dashboard')->name('admin_dashboard');
      Route::livewire('/user', 'pages-admin::user.list')->name('user_list');
      Route::livewire('/user/add', 'pages-admin::user.ae')->name('user_add');
      Route::livewire('/user/edit/{id}', 'pages-admin::user.ae')->name('user_edit');
  });
  ```
  Namespace `pages-admin::` merujuk ke folder `resources/views/pages/admin/`. Contohnya, `pages-admin::user.list` merujuk ke `resources/views/pages/admin/user/list.blade.php`.

---

## 4. Single File Component (SFC) Livewire

Setiap halaman di folder `resources/views/pages/` ditulis menggunakan format **Single File Component (SFC)**. Artinya, logika controller PHP dan template UI Blade digabungkan dalam satu file `.blade.php`.

Contoh struktur file SFC:
```html
<?php

use Livewire\Component;
use App\Models\PaketModel;

new class extends Component {
    public $pageTitle = "Beranda";
    public $packages;

    public function mount() {
        $this->packages = PaketModel::all();
    }

    public function render() {
        return $this->view()
            ->layout('layouts.admin') // Menggunakan layout admin
            ->title($this->pageTitle);
    }
};
?>

<div>
    <!-- HTML / Blade View Anda Di Sini -->
    <h1>{{ $pageTitle }}</h1>
    <!-- Loop packages, dll. -->
</div>
```

---

## 5. Standar Penulisan Kode (Coding Guidelines)

Dalam melakukan pengembangan pada codebase ini, wajib mengikuti aturan berikut:

### A. Konfigurasi Model Eloquent (PHP 8 Attributes)
Ketika membuat atau memodifikasi Model Eloquent Laravel di direktori `app/Models/`, **wajib** menggunakan PHP Attributes dari namespace `Illuminate\Database\Eloquent\Attributes` sebagai ganti dari properti kelas klasik.
* **Benar (Attributes):**
  ```php
  #[Table(name: 'users')]
  #[Fillable(['username', 'nama', 'password'])]
  class UserModel extends Authenticatable { ... }
  ```
* **Salah (Properti Klasik):**
  ```php
  protected $table = 'users';
  protected $fillable = ['username', 'nama'];
  ```

### B. Deklarasi Import Trait
Seluruh import trait (seperti `SoftDeletes`, `HasFactory`, dll.) wajib dideklarasikan di bagian atas file menggunakan statement `use` namespace, dan hanya menggunakan nama singkat trait di dalam tubuh class.
* **Benar:**
  ```php
  use Illuminate\Database\Eloquent\SoftDeletes;
  // ...
  class UserModel extends Authenticatable {
      use SoftDeletes;
  }
  ```
* **Salah:**
  ```php
  class UserModel extends Authenticatable {
      use \Illuminate\Database\Eloquent\SoftDeletes;
  }
  ```

### C. Path Navigasi Literal di View
Ketika mendefinisikan tautan (`href`) navigasi pada menu sidebar atau navbar di view/layout, **jangan** menggunakan helper `route(...)` dengan nama route. Gunakan path literal langsung.
* **Benar:** `<a href="/admin/user">Manajemen User</a>`
* **Salah:** `<a href="{{ route('user_list') }}">Manajemen User</a>`

Untuk memeriksa halaman aktif (`active class`), gunakan `request()->is('path*')` atau `request()->is('path', 'path/*')` sebagai ganti `request()->routeIs(...)`.
* **Benar:** `class="{{ request()->is('admin/user*') ? 'active' : '' }}"`
* **Salah:** `class="{{ request()->routeIs('user_list') ? 'active' : '' }}"`
