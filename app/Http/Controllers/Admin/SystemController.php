<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SystemController extends Controller
{
    //
    public function upload(Request $request)
    {
        $path = Storage::putFile('/upload', $request->file('file_name'));
        return $path;
    }
}
