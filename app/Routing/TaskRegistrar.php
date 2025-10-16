<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class TaskRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', 'auth'])->group(function () {
            Route::get('/tasks', [TaskController::class, 'list'])
                ->name('task.list');
            Route::get('/tasks/{id}', [TaskController::class, 'show'])
                ->name('task.show');
        });
    }
}
