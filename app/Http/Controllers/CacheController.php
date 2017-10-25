<?php

namespace App\Http\Controllers;

use App\Cache;
use Illuminate\Http\Request;

class CacheController extends Controller
{
    public function index(Cache $cache)
    {
        $data = $cache->showInfo();
        return view('weather.show', compact('data'));
    }
}
