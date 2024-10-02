<?php 

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageService 
{
    public function createImage(UploadedFile $image): String
    {   
        $fileName = uniqid() . '_' . $image->getClientOriginalName();

        $path = $image->storeAs('images', $fileName, 'public');

        return asset('storage/' . $path);
    }
}