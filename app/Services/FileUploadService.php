<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function uploadEventImage(UploadedFile $file): string
    {
        return Storage::putFile('events/images', $file);
    }
}
