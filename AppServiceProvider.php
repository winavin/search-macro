<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

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
        // Search Macro
        Builder::macro('search', function ($attributes, string $searchTerm)
        {
            $searchTerm = str_replace(' ', '%', $searchTerm);
            if (is_array($attributes))
            {
                $this->where(function (Builder $query) use ($attributes, $searchTerm)
                {
                    foreach ($attributes as $attribute)
                    {
                        $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                    }
                });
            } else
            {
                $this->where(function (Builder $query) use ($attributes, $searchTerm)
                {
                    $query->orWhere($attributes, 'LIKE', "%{$searchTerm}%");
                });
            }
            return $this;
        });
    }
}
