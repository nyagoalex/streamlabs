<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

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
        Builder::macro('whereLike', function ($attribute, string $searchTerm) {
            $searchTerm = Str::replace(' ', '%', $searchTerm);
            $this->where(function (Builder $query) use ($attribute, $searchTerm) {
                foreach (Arr::wrap($attribute) as $attribute) {
                    $query->orWhere($attribute, 'LIKE', "%$searchTerm%");
                }
            });

            return $this;
        });
    }
}
