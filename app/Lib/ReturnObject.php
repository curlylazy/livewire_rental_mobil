<?php

namespace App\Lib;

class ReturnObject
{
	public static function return($issucces, $message = "", $kode = "")
	{
        $status = new \stdClass();
        $status->issucces = $issucces;
        $status->message = $message;
        $status->kode = $kode;

        return $status;
	}

}
