<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Exception;

class UploadService
{

    public function upload($file): array
    {
        $upload = Storage::putFile("attachments", $file);
        if (!$upload) {
            throw new Exception("Falha ao armazenar arquivo");
        }
        return [
            'hash' => $file->hashName(),
            'path' => 'attachments'
        ];
    }

    public function download($path)
    {
        if (!Storage::exists($path)) {
            throw new Exception("Arquivo não encontrado");
        }
        return Storage::download($path);
    }
}
