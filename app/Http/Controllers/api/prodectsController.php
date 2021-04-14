<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Prodect;
use Illuminate\Http\Request;

class prodectsController extends Controller
{
    public function index()
    {
        $prodects = Prodect::all();
        return $prodects;
    }
    public function productwithslug($slug)
    {
        $prodect = Prodect::where('slug',$slug)->get();
        return $prodect;
    }
}
