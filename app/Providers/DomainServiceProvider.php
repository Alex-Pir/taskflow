<?php

namespace App\Providers;

use Domain\Task\Providers\TaskServiceProvider;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(TaskServiceProvider::class);
    }
}
