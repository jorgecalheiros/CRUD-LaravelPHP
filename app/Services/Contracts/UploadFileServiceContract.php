<?php

namespace  App\Services\Contracts;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploadFileServiceContract
{
    public function run(UploadedFile $file, string $directory, string $name = null, string $disk = "local");
}
