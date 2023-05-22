<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait LocalStorageImage
{
    public function setImage($data, $input, $disk, $folder)
    {
        if ($data->hasFile($input)) {
            $image = $data->file($input);
            return $image->store($folder, $disk);
        }
    }

    public function updateImage($data, $input, $image, $disk, $folder)
    {
        if ($data->hasFile($input)) {
            Storage::disk($disk)->delete($image);
            $image = $data->file($input);
            return $image->store($folder, $disk);
        }
    }

    public function deleteImage($model, $disk)
    {
        if ($model->image != null) {
            Storage::disk($disk)->delete($model->image);
        }
    }
}




