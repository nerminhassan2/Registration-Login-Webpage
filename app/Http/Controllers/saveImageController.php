<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class saveImageController extends Controller
{
    public function saveImage($username, $tempName)
    {
        if ($tempName) {
            $filename = $username . ".png";
            $destination = public_path('/picture');
            $tempName->move($destination, $filename);
        }
    }
}
