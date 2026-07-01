<?php

namespace App\Lib;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class FilterString
{
	public static function filterInt($value)
	{
		$res = "";
        $res = str_replace(',', '', $value);
		$res = filter_var($res, FILTER_SANITIZE_NUMBER_INT);
		return $res;
	}

	// public static function filterDecimal($value)
	// {
	// 	$res = "";
    //     $res = str_replace(',', '', $value);
	// 	$res = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT);
	// 	return $res;
	// }

    public static function filterDecimal($value)
    {
        // 1. Hapus semua karakter selain angka, titik, koma
        $cleaned = preg_replace('/[^0-9.,]/', '', $value);

        // 2. Hapus semua koma (anggap sebagai pemisah ribuan)
        $cleaned = str_replace(',', '', $cleaned);

        // 3. Ambil posisi titik terakhir
        $lastDotPos = strrpos($cleaned, '.');
        if ($lastDotPos !== false) {
            $before = str_replace('.', '', substr($cleaned, 0, $lastDotPos));
            $after  = substr($cleaned, $lastDotPos + 1);
            return $before . '.' . $after;
        }

        // Kalau tidak ada titik
        return $cleaned;
    }

	public static function filterString($value)
	{
		$res = "";
		$res = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH);
		// $res = htmlspecialchars($value);
		return $res;
	}

	public static function filterDate($date)
	{
		$res = empty($date) ? null : Carbon::parse($date);
		return $res;
	}

    public static function isDigits(string $s, int $minDigits = 9, int $maxDigits = 14): bool {
        return preg_match('/^[0-9]{'.$minDigits.','.$maxDigits.'}\z/', $s);
    }

    public static function isValidPhoneNumber(string $telephone, int $minDigits = 9, int $maxDigits = 14): bool {
        if (preg_match('/^[+][0-9]/', $telephone)) { //is the first character + followed by a digit
            $count = 1;
            $telephone = str_replace(['+'], '', $telephone, $count); //remove +
        }

        //remove white space, dots, hyphens and brackets
        $telephone = str_replace([' ', '.', '-', '(', ')'], '', $telephone);

        //are we left with digits only?
        return self::isDigits($telephone, $minDigits, $maxDigits);
    }

	public static function filterSEO($judul, $kode)
    {
        // megubah karakter non huruf dengan strip
        $judul = preg_replace('~[^\\pL\d]+~u', '-', $judul);
        $judul = trim($judul, '-');
        $judul = iconv('utf-8', 'us-ascii//TRANSLIT', $judul);
        $judul = strtolower($judul);
        $judul = preg_replace('~[^-\w]+~', '', $judul);
        if (empty($judul))
        {
            return 'n-a';
        }

        return strtolower($judul."-".$kode);
    }

}
