<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Model::shouldBeStrict(!app()->environment('production'));

        if (app()->environment('production')) {
            DB::listen(function ($query) {
                if ($query->time > 100) {
                    logger()
                        ->debug(
                            'query longer than 1s:' . $query->sql, $query->sql
                        );
                }
            });

            app(Kernel::class)->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4),
                fn () => logger()->debug('whenRequestLifecycleIsLongerThan:' . request()->url())
            );
        }
    }
}
