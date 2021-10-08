<?php

namespace App\Services\Implementations;

use App\Services\Contracts\UploadFileServiceContract;
use Exception;
use Illuminate\Support\Facades\Storage;
use Log;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileService implements UploadFileServiceContract
{
    public function run(UploadedFile $file, string $directory, ?string $name = null, string $disk = "local")
    {
        try {
            $fileName = $name;
            $fileExtension = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();

            if (!$name) {
                $fileName = uniqid(str_replace('.' . $fileExtension, '', $fileOriginalName));
                $fileName .= ".$fileExtension";
            }

            $filePath = "$directory/$fileName";
            $fileContent = file_get_contents($file);

            if (!Storage::disk($disk)->put($filePath, $fileContent)) {
                throw new Exception("Não foi possivel salvar a imagem");
            }

            return $filePath;
        } catch (\Throwable $th) {
            Log::error('UploadFileService@run --- ' . $th->getMessage() . PHP_EOL . $th->getTraceAsString());
            return false;
        }
    }
}
