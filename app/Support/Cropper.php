<?php


namespace LaraDev\Suporte;


use CoffeeCode\Cropper\Cropper as Crop;

class Cropper
{
    public static function thumb(string $uri, int $width, int $heigth)
    {
        $cropper = new Crop('../public/storage/cache');
        $pathTumb = $cropper->make(config('filesystems.disks.public.root') . '/' . $uri, $width, $heigth);
        $file = '/cache/' . collect(explode('/', $pathTumb))->last();

        return $file;
    }

    public static function flush(?string $path)
    {
        $cropper = new Crop('../public/storage/cache');

        if(!empty($path)){
            $cropper->flush($path);
        }else{
            $cropper->flush();
        }
    }
}
