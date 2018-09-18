<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Blade;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /*Blade::directive('concat', function($exp){
            list($name, $val) = explode(',', $exp);
            return "<?php 
            $name .= $val ?>";
        });
        
       <@foreach($article->categories as $category)
            @concat(help, '<a href ="#">'.$category->name.'</a>')
        @endforeach 
        {{ substr($help, 0, -1)}} 
        
        */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
