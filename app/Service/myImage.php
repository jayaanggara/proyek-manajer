<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class myImage
{
    public function saveImage(UploadedFile $photo, $title , $folder='')
    {
        $fileName = \Str::slug($title).'-'.date('ymd-his').'.' . $photo->guessClientExtension();
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images';
        if ($folder != '') {
            $destinationPath .= DIRECTORY_SEPARATOR . $folder;
        }
        $photo->move($destinationPath, $fileName);
        return $fileName;
    }

    public function deleteImage($filename , $folder='')
    {
        $path = public_path() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images';
        if ($folder != '') {
            $path .= DIRECTORY_SEPARATOR . $folder;
        }
        $path .= DIRECTORY_SEPARATOR .$filename;
        return File::delete($path);
    }
}