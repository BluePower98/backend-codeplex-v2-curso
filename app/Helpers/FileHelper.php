<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class FileHelper
{

    /**
     * Aplicar formato al nombre de un fichero antes de aplicar "move upload"
     *
     * @param string $fileName
     * @return array|string|null
     */
    public static function sanitizerFileName(string $fileName): array|string|null
    {
        $fileName = preg_replace('/.[^.]*$/', '', $fileName);
        return preg_replace("/[^a-zA-Z0-9]+/", "", $fileName);
    }

    /**
     * Obtener url base64 de un fichero.
     *
     * @param string $pathFile
     * @param string $mime
     * @return string
     */
    public static function getDataURI(string $pathFile, string $mime = ''): string
    {
        return 'data:'.(function_exists('mime_content_type') ? mime_content_type($pathFile) : $mime).';base64,'.base64_encode(file_get_contents($pathFile));
    }

    /**
     * @param string $url
     * @return void
     */
    public static function removeByUrl(string $url): void
    {
        if (File::exists($url)) {
            $files = File::allFiles($url);

            foreach ($files as $path) {
                File::delete($url . basename($path));
            }
        }
    }
}
