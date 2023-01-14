<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()/// دي اول حاجة هتتنفذ
    {
        Paginator::usebootstrap();
        $cat = new Category();
         $setting=Setting::CheckSettengs();
            $categories=Category::with('children')->where('parent',0)->orWhere('parent',null)->get();
            $last5posts=Post::with('getCategoryOfPost','getUserOfPost')->orderBy('id')->limit(5)->get();
         View()->share([
            'setting'=>$setting,
            'categories'=>$categories,
            'last5posts'=>$last5posts,
            'cat'=>$cat,
        
        ]);
    }
}
