<?php

namespace App\Services;

use App\Models\Attachment;

class AttachmentService
{
    private Attachment $model;
    public function __construct()
    {
        $this->model = new Attachment();
    }

    public function create($hash, $path)
    {
        return $this->model->create([
            'title' => $hash,
            'path' => $path,
        ]);
    }
}
