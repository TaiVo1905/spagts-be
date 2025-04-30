<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\RepositoryInterface;
use App\Services\V1\Contracts\ServiceInterface;
use App\Repositories\Api\V1\UserRepository;
use App\Services\Api\V1\UserService;
use App\Models\User;

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
            \App\Repositories\Api\V1\UserRepository::class,
            function ($app) {
                return new \App\Repositories\Api\V1\UserRepository(new \App\Models\User());
            }
        );

        $this->app->bind(
            \App\Services\Api\V1\UserService::class,
            function ($app) {
                return new \App\Services\Api\V1\UserService(
                    $app->make(\App\Repositories\Api\V1\UserRepository::class)
                );
            }
        );
    }
}
