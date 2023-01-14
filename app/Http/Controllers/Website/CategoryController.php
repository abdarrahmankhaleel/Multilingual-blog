<?php

namespace App\Http\Controllers\Website;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
public function index(Category $category)
{
      $category =$category->load('children');/// لما يكون عندك اوبجكت واحد انستنس واحد استخدم لود
      // اما لوعمد لستت اوبجكتس ساعيتها استخدم وث
        $posts = Post::where('category_id', $category->id)->get();
        return view('web.category', compact('category','posts'));
}
}
