<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\GoodsRepositoryEloquent;
use App\Repositories\OrderInfoRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        if($this->app->environment('local')) {
//            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
//        }
		$this->app->singleton('goodsRepositoryEloquent', function ($app) {
            return new GoodsRepositoryEloquent($app);
        });
        $this->app->singleton('orderInfoRepositoryEloquent', function ($app) {
            return new OrderInfoRepositoryEloquent($app);
        });
        $this->app->singleton('userRepositoryEloquent', function ($app) {
            return new UserRepositoryEloquent($app);
        });
    }
}
