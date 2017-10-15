<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SystemController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    //
    public function upload(Request $request)
    {
        $path = Storage::putFile('/upload', $request->file('filename'));
        return $path;
    }
}
