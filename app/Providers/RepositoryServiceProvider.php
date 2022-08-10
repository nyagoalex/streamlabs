<?php

namespace App\Providers;

use App\Repository\BulkFileRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\BulkFileRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\ExpenseRepository;
use App\Repository\Eloquent\StatRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\ExpenseRepositoryInterface;
use App\Repository\StatRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(StatRepositoryInterface::class, StatRepository::class);
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
