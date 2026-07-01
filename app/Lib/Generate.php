<?php

namespace App\Lib;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class Generate
{
    public static $mPengeluaran = "mPengeluaran";
    public static $mTransaksi = "mTransaksi";

	public static function kode($kode, $prefix, $table)
    {
        $nomer = "0000001";
		$autonum = "";
        $autonum = DB::table($table)->max($kode);

        $nomer_len = strlen($nomer);

		# Cek Parameter
		if($autonum == "")
		{
			$autonum = $prefix.$nomer;
		}
		else
		{
			$autonum = (int) substr($autonum, strlen($prefix), $nomer_len + 1);
			$autonum++;
			$autonum =  $prefix.sprintf('%0'.($nomer_len).'s', $autonum);
		}

		return $autonum;
    }

	public static function kodeByModul($modul)
    {
        if($modul == self::$mPengeluaran)
        {
            $table = "tbl_pengeluaran";
            $kode = "kodepengeluaran";
            $prefix = "PENG-";
        }

        elseif($modul == self::$mTransaksi)
        {
            $table = "tbl_transaksi_hd";
            $kode = "kodetransaksihd";
            $prefix = "TRS-";
        }

        $res = self::kode(kode: $kode, prefix: $prefix, table: $table);
		return $res;
    }

}
