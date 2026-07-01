<?php

namespace App\Lib;

use Illuminate\Support\Arr;

class Option
{
    public static $optNameKategori = "kategori";
    public static $optNameStatusSiswa = "statussiswa";
    public static $optNameStatusPesan = "statuspesan";
    public static $optNameStatusBayar = "statusbayar";

	public static function statusPesan()
	{
        $res = collect();
        $res->push(['value' => 0, 'name' => 'Belum Dikerjakan']);
        $res->push(['value' => 1, 'name' => 'Sedang Dikerjakan']);
        $res->push(['value' => 2, 'name' => 'Siap Dikirim']);
        $res->push(['value' => 3, 'name' => 'Selesai']);
        $res->push(['value' => 9, 'name' => 'Batal']);
		return $res;
	}

	public static function statusBayar()
	{
        $res = collect();
        $res->push(['value' => 0, 'name' => 'Belum Dibayar']);
        $res->push(['value' => 1, 'name' => 'DP']);
        $res->push(['value' => 2, 'name' => 'Lunas']);
		return $res;
	}

	public static function layanan()
	{
		$res = collect();
        $res->push(['nama' => 'Produksi Uniform']);
        $res->push(['nama' => 'Produksi Pakaian Anak']);
        $res->push(['nama' => 'Cetak dan Bordir']);
        $res->push(['nama' => 'Pengiriman Pesanan']);
        $res->push(['nama' => 'Pengemasan dan Konsultasi']);
		return $res;
	}

	public static function uniform()
	{
		$res = collect();
        $res->push(['nama' => 'Uniform Sekolah']);
        $res->push(['nama' => 'Uniform Hotel']);
        $res->push(['nama' => 'Uniform Villa']);
        $res->push(['nama' => 'Uniform Restaurant']);
        $res->push(['nama' => 'Uniform Kantoran']);
        $res->push(['nama' => 'Uniform Komunitas']);
		return $res;
	}

	public static function kategoriDokumen()
	{
		$res = collect();
        $res->push(['value' => 'desaantikorupsi', 'name' => 'Desa Anti Korupsi']);
        $res->push(['value' => 'desawisata', 'name' => 'Desa Wisata']);
        $res->push(['value' => 'ppid', 'name' => 'Pejabat Pengelola Informasi dan Dokumentasi']);
		return $res;
	}

	public static function subKategoriProdukHukum()
	{
		$res = collect();
        $res->push(['value' => 'Surat Lainnya', 'name' => 'Surat Lainnya']);
        $res->push(['value' => 'Surat Keterangan', 'name' => 'Surat Keterangan']);
        $res->push(['value' => 'Laporan', 'name' => 'Laporan']);
        $res->push(['value' => 'SK Kepala Desa', 'name' => 'SK Kepala Desa']);
        $res->push(['value' => 'Peraturan Desa', 'name' => 'Peraturan Desa']);
        $res->push(['value' => 'Peraturan Kepala Desa', 'name' => 'Peraturan Kepala Desa']);
		return $res;
	}

    public static function statusSiswa()
	{
		$res = collect();
        $res->push(['value' => 0, 'name' => 'Belum Terdaftar']);
        $res->push(['value' => 1, 'name' => 'Aktif']);
        $res->push(['value' => 9, 'name' => 'Lulus']);
		return $res;
	}

    public static function kategoriBantuan()
	{
		$res = collect();
        $res->push(['value' => "item", 'name' => 'Item']);
        $res->push(['value' => "satuan", 'name' => 'Satuan']);
		return $res;
	}

    public static function posisi()
	{
		$res = collect();
        $res->push(['value' => 'D', 'name' => 'Debet']);
        $res->push(['value' => 'K', 'name' => 'Kredit']);
		return $res;
	}

    public static function tahun()
	{
        $res = collect();
        for($i=2025; $i <= date('Y'); $i++){
            $res->push(['value' => $i, 'name' => $i]);
        }
		return $res;
	}

    public static function statusPembayaran()
	{
		$res = collect();
        $res->push(['value' => '0', 'name' => 'Belum Ada Pembayaran']);
        $res->push(['value' => '1', 'name' => 'DP (Down Payment)']);
        $res->push(['value' => '2', 'name' => 'Lunas']);
		return $res;
	}

    public static function satuan()
	{
        $res = collect();
        $res->push(['value' => 'PCS', 'name' => 'PCS']);
        $res->push(['value' => 'Meter', 'name' => 'Meter']);
        $res->push(['value' => 'Rol', 'name' => 'Rol']);
        $res->push(['value' => 'Sentimeter', 'name' => 'Sentimeter']);
        $res->push(['value' => 'Kilo', 'name' => 'Kilo']);
        $res->push(['value' => 'Yard', 'name' => 'Yard']);
		return $res;
	}

    public static function statusRead()
	{
		$res = collect();
        $res->push(['value' => '0', 'name' => 'Belum']);
        $res->push(['value' => '1', 'name' => 'Sudah']);
		return $res;
	}

	public static function getOptionName($name, $value)
	{
        $res = "";
        if($name == self::$optNameKategori)
        {
            $res = self::kategoriDokumen()->firstWhere('value', $value)['name'];
        }

        elseif($name == self::$optNameStatusSiswa)
        {
            $res = self::statusSiswa()->firstWhere('value', $value)['name'];
        }

        elseif($name == self::$optNameStatusPesan)
        {
            $res = self::statusPesan()->firstWhere('value', $value)['name'];
        }

        elseif($name == self::$optNameStatusBayar)
        {
            $res = self::statusBayar()->firstWhere('value', $value)['name'];
        }

		return $res;
	}

}
