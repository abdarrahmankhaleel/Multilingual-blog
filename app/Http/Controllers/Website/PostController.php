<?php

namespace App\Http\Controllers\Website;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function show(Post $post)
    {
       
        return view('web.post',compact('post'));     
    }
}
