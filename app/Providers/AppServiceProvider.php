<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\EloquentUser;
use App\Repositories\Business\BusinessRepository;
use App\Repositories\Business\EloquentBusiness;
use App\Repositories\BusinessCategory\CategoryRepository;
use App\Repositories\BusinessCategory\EloquentCategory;


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
    public function boot()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(BusinessRepository::class, EloquentBusiness::class);
        $this->app->singleton(CategoryRepository::class, EloquentCategory::class);

        \URL::forceScheme('https');
    }
}
