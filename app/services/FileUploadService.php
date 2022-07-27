<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileUploadService
{

    public static function uploadFile($file) {
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . "." . $extension;
        $path = date('Ymd');
        $fullpath = $path . '/' . $filename;
        Storage::disk('file')->putFileAs($path, $file, $filename, 'public');
        return Storage::disk('file') ->url($fullpath);
    }
}
