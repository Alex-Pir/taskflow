<?php

namespace Domain\Task\Providers;

use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(EventsServiceProvider::class);
    }
}
