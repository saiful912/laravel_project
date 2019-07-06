<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if (Schema::hasTable('categories')) {


            $categories = Category::all();

//        problem korte ace
//        $categories = Category::select(['name','slug'])->where('category_id', null)->get();
            View::share('categories', $categories);
        }
    }
}
