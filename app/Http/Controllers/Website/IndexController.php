<?php

namespace App\Http\Controllers\Website;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $catsAndItsPosts = Category::with([
            'posts' => function ($q) {
                $q->latest()->limit(2);
        }])->get();
        return view('web.index',compact('catsAndItsPosts'));
    }
}
