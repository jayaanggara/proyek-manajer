<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;
use Illuminate\Support\Facades\Storage;

class myImage
{
    public function saveImage(UploadedFile $photo, $title , $folder='', $assetFolder = 'images')
    {
        $fileName = \Str::slug($title).'-'.date('ymd-his').'.' . $photo->guessClientExtension();
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . $assetFolder;
        if ($folder != '') {
            $destinationPath .= DIRECTORY_SEPARATOR . $folder;
        }
        $photo->move($destinationPath, $fileName);
        return $fileName;
    }

    public function saveDocuments(UploadedFile $docs, $title , $folder='')
    {
        // $fileName = \Str::slug($title).'-'.date('ymd-his').'.' . $docs->guessClientExtension();
        $fileName = Storage::disk('public')->put('documents/'.$folder, $docs);
        return $fileName;
    }

    public function deleteImage($filename , $folder='', $assetFolder = 'images')
    {
        $path = public_path() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . $assetFolder;
        if ($folder != '') {
            $path .= DIRECTORY_SEPARATOR . $folder;
        }
        $path .= DIRECTORY_SEPARATOR .$filename;
        return File::delete($path);
    }
}