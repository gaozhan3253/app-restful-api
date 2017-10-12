<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    //
    public function index()
    {
        Log::info('index.index.'.rand(0,9));
    }
}
