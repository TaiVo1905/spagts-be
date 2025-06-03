<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\RepositoryInterface;
use App\Services\Contracts\ServiceInterface;
use App\Repositories\Api\UserRepository;
use App\Services\Api\UserService;
use App\Models\User;
use App\Services\Clouds\CloudinaryService;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Contracts\RepositoryInterface::class,
            \App\Repositories\BaseRepository::class
        );

        $this->app->bind(
            \App\Services\Api\Contracts\ServiceInterface::class,
            \App\Services\BaseService::class
        );

        // Bind cụ thể User
        $this->app->bind(
            \App\Repositories\Api\UserRepository::class,
            function ($app) {
                return new \App\Repositories\Api\UserRepository(new \App\Models\User());
            }
        );

        $this->app->bind(
            \App\Services\Api\UserService::class,
            function ($app) {
                return new \App\Services\Api\UserService(
                    $app->make(\App\Repositories\Api\UserRepository::class),
                    $app->make(CloudinaryService::class)
                );
            }
        );
    }
}
