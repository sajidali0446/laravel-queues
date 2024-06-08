<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {

        $this->configureRateLimiting();

        $this->mapWebRoutes();


        $this->mapApiRoutes();

    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function ( Request $request ) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::namespace($this->namespace . '\API\V1')
             ->group(base_path('routes/api/api.php'));
    }


}
