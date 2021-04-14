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
    public function home_products()
    {
        $prodect = Prodect::where('show_in_home',1)->get();
        return $prodect;
    }
}
