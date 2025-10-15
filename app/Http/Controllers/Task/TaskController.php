<?php

namespace App\Http\Controllers\Task;

use App\Http\Requests\Task\CreateTaskRequest;
use App\View\ViewModels\TaskListViewModel;
use App\View\ViewModels\TaskViewModel;
use Domain\Task\Models\Task;
use Spatie\ViewModels\ViewModel;

class TaskController
{
    public function list(): ViewModel
    {
        return (new TaskListViewModel())->view('tasks.index');
    }

    public function show(int $id): ViewModel
    {
        return (new TaskViewModel(
            Task::query()->findOrFail($id))
        )->view('tasks.show');
    }
}
