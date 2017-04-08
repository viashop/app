<?php

namespace Vialoja\Providers;

use Illuminate\Support\ServiceProvider;
use Vialoja\Repositories\Control\PermissionRepository;
use Vialoja\Repositories\Control\PermissionRepositoryEloquent;
use Vialoja\Repositories\Control\RoleRepository;
use Vialoja\Repositories\Control\RoleRepositoryEloquent;

class VialojaControlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            RoleRepository::class, RoleRepositoryEloquent::class
        );

        $this->app->bind(
            PermissionRepository::class, PermissionRepositoryEloquent::class
        );
    }
}
