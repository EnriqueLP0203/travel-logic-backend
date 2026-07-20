<?php

namespace App\Providers;

use App\Models\HotelGroup;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.footer', function ($view) {
            $order = ['Playa', 'Ciudad', 'Fiesta', 'Descanso', 'Lujo', 'Aeropuerto'];

            $hotelGroups = HotelGroup::where('active', true)
                ->with(['translations' => fn ($q) => $q->where('language_code', 'es-MX')])
                ->get()
                ->sortBy(function ($group) use ($order) {
                    $name = $group->translations->first()?->name ?? '';
                    $index = array_search($name, $order, true);

                    return $index === false ? 999 : $index;
                })
                ->values();

            $view->with('footerHotelGroups', $hotelGroups);
        });
    }
}
