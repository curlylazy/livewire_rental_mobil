## Layout Design Website Rental
ada dua layout yaitu front dan admin
* **Front :**  ini adalah halaman depan yang dapat dilihat oleh semua user atau pengguna, ini adalah halaman landing dimana nanti base viewnya kamu bisa contoh di file `html/index.html`, untuk contoh struktunya projeknya kamu bisa tiru di projek `/home/curly-lazy/web/livewire_balicraftsupplier`
* **Admin :**  ini adalah halaman admin yang hanya dapat dilihat oleh admin, dimana admin dapat mengelola data armadanya, data pemesanannya, dan data lainnya, untuk layout ini kamu bisa total tiru dan porting di projek `livewire_admin_tailwind` di path `/home/curly-lazy/web/livewire_admin_tailwind/` 

perlu diperhatikan kita akan gunakan struktur monolith, jadi ada front dan admin, untuk contoh struktur projeknya itu ada di halaman `/home/curly-lazy/web/livewire_balicraftsupplier`, namun untuk adminnya kamu contoh `/home/curly-lazy/web/livewire_admin_tailwind/` 

## Tech Stack
* Frontend : LIVEWIRE, Laravel 13, Tailwind CSS
* Backend : Laravel 13, MySQL

## Model Database
untuk struktur database
- tbl_user : user, email, password, created_at, updated_at
- tbl_paket : kodepaket(uuid), tipe_mobil(string), merk(string), mobil(text), harga(int), isDriver(boolean), isFuel(boolean), fasilitas(text), created_at, updated_at, deleted_at
- tbl_our_service : kodeour_service(uuid), title, description, created_at, updated_at, deleted_at
- tbl_testimoni : kodetestimoni, nama, alamat, isi, created_at, updated_at, deleted_at
- tbl_galeri: kodegaleri, gambar, created_at, updated_at

