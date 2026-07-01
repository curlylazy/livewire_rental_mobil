<?php

namespace App\Lib;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LogSys
{
    public static function add($judul, $kode, $keterangan = "", $tipe = "info")
    {
        if($tipe == "info") {
            Log::info($judul, ['kode' => $kode, 'user' => Auth::user()->kodeuser, 'date' => Carbon::now(), 'keterangan' => $keterangan]);
        }

        elseif($tipe == "error") {
            Log::error($judul, ['kode' => $kode, 'user' => Auth::user()->kodeuser, 'date' => Carbon::now(), 'keterangan' => $keterangan]);
        }
    }

}
