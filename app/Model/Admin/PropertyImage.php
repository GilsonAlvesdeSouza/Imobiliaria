<?php

namespace LaraDev\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use LaraDev\Suporte\Cropper;

class PropertyImage extends Model
{
    protected $fillable = [
        'property',
        'path',
        'cover',
    ];

    public function getUrlCroppedAttribute()
    {
        return Storage::url(Cropper::thumb($this->path, 1366,768));
    }
}
