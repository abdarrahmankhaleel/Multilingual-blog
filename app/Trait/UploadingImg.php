<?php

namespace App\Http\Trit;
use Illuminate\Support\Str;
class UploadingImg
{
 public static function UploadImg($file)
    {

        $filename = Str::uuid() . $file->getClientOriginalName();
        $file->move(public_path('imgs'), $filename);
        $path = 'imgs/' . $filename;
        return $path;
    }
}

?>
