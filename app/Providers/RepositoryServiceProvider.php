<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Institute\InstituteRepository;
use App\Interfaces\Institute\InstituteRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $repositories = [
        UserRepositoryInterface::class         =>          UserRepository::class,
        InstituteRepositoryInterface::class    =>          InstituteRepository::class,
        
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
