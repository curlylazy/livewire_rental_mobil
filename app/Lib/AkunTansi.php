<?php

namespace App\Lib;

use App\Models\JurnalDetailModel;
use App\Models\JurnalModel;
use App\Models\PesanDTModel;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AkunTansi
{
    public static function addJurnal($tipejurnal, $tanggal, $kodetransaksi, $keterangan, $jurnalDetail)
    {
        // *** hapus jurnal transaksi sebelumnya
        self::deleteJurnal($kodetransaksi);

        $dataJurnal = JurnalModel::create([
            "tipejurnal" => $tipejurnal,
            "tanggal" => $tanggal,
            "kodeuser" => Auth::user()->kodeuser,
            "kodetransaksi" => $kodetransaksi,
            "keterangan" => $keterangan,
        ]);

        foreach($jurnalDetail as $data)
        {
            JurnalDetailModel::create([
                "kodejurnal" => $dataJurnal->kodejurnal,
                "kodeakun" => $data->kodeakun,
                "jumlah" => $data->jumlah,
                "posisi" => $data->posisi,
            ]);
        }

        LogSys::add("Create Jurnal $tipejurnal", $kodetransaksi);

        return $dataJurnal->kodejurnal;
    }

    public static function deleteJurnal($kodetransaksi)
    {
        $dataJurnal = JurnalModel::searchByKodeTransaksi($kodetransaksi)->first();
        if($dataJurnal) {
            $kodejurnal = $dataJurnal->kodejurnal;
            JurnalModel::find($kodejurnal)->delete();
            JurnalDetailModel::searchByKodeJurnal($kodejurnal)->delete();
        }
    }

}
