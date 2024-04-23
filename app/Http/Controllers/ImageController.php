<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $req) {
        $image = $req->file('file');

        $fileName = Str::uuid() . "." . $image->extension();

        $fileServer = Image::make($image);
        $fileServer->fit(1000, 1000);

        $filePath = public_path('uploads') . '/' . $fileName;

        $fileServer->save($filePath);

        return response()->json(['image' => $fileName]);
    }
}
