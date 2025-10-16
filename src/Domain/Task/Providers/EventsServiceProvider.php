<?php

namespace Domain\Task\Providers;

use Domain\Task\Models\Task;
use Domain\Task\Observers\TaskObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
class EventsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        Task::observe(TaskObserver::class);
    }
}
