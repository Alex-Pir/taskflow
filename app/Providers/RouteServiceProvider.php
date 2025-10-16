<?php

namespace App\Providers;

use App\Contracts\RouteRegistrar;
use App\Routing\TaskRegistrar;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string[]
     */
    private array $registrars = [
        TaskRegistrar::class,
    ];

    private const PER_MINUTE_GLOBAL_LIMIT = 500;
    private const PER_MINUTE_AUTH_LIMIT = 20;
    private const PER_MINUTE_API_LIMIT = 60;

    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function (Registrar $router) {
            $this->mapRoutes($router);
        });
    }

    private function configureRateLimiting(): void
    {
        RateLimiter::for('global', fn (Request $request) => Limit::perMinute(self::PER_MINUTE_GLOBAL_LIMIT)
            ->by($request->user()?->id ?: $request->ip())
            ->response(fn (Request $request, array $headers) => response(
                'Take it easy',
                Response::HTTP_TOO_MANY_REQUESTS
            ))
        );

        RateLimiter::for('auth', fn (Request $request) => Limit::perMinute(self::PER_MINUTE_AUTH_LIMIT)
            ->by($request->ip())
        );

        RateLimiter::for('api', fn (Request $request) => Limit::perMinute(self::PER_MINUTE_API_LIMIT)
            ->by($request->ip())
        );
    }

    private function mapRoutes(Registrar $router): void
    {
        foreach ($this->registrars as $registrar) {
            if (!class_exists($registrar) && !is_subclass_of($registrar, RouteRegistrar::class)) {
                throw new RuntimeException(
                    'Cannot map routes \'%s\', it is not a valid routes class'
                );
            }

            /** @var RouteRegistrar $routeRegistrar */
            $routeRegistrar = new $registrar();

            $routeRegistrar->map($router);
        }
    }
}
