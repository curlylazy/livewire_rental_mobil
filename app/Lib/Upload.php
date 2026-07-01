<?php

namespace App\Lib;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

class Upload
{
	public static function image($file, $oldFile = "", $withThumb = false)
    {
        // *** jika oldfile ada, maka hapus file yang lama
        // cek terlebih dahulu, apakah ada
        if(!empty($oldFile)) {
            self::deleteImage($oldFile);
        }

        // *** upload file
        $date = now()->format('Y_m_d_his'); // 20260221
        $random = Str::random(8);
        $extension = $file->getClientOriginalExtension();
        $name = "{$date}_{$random}.{$extension}";

        // *** upload thumbnail
        if ($withThumb) {
            $manager = new ImageManager(new Driver());
            $image = $manager->decode($file->getPathname())->scale(width: 500);
            $encoded = $image->encodeUsingFormat(Format::JPEG);
            Storage::put("image/thumb/$name", $encoded->toString());
        }

        $file->storeAs(path: 'image', name: $name);

        return $name;
    }

    public static function deleteImage(string $file)
    {
        if(!empty($file))
        {
            // *** gambar utama
            if (Storage::exists("image/$file")) {
                Storage::delete("image/$file");
            }

            // *** gambar thumb
            if (Storage::exists("image/thumb/$file")) {
                Storage::delete("image/thumb/$file");
            }
        }
    }
}
