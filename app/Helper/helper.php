<?php
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

function imgUpload(UploadedFile $uploadedFile, string $title, string $path)
{
    $file = $uploadedFile;
    $fileName = Str::slug($title).'.'.$file->getClientOriginalExtension();
    $file->move(public_path($path), $fileName);

    return $path.$fileName;
}
