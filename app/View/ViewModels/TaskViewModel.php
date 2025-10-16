<?php

namespace App\View\ViewModels;

use Domain\Task\Models\Task;
use Spatie\ViewModels\ViewModel;

class TaskViewModel extends ViewModel
{
    public function __construct(private readonly ?Task $task = null)
    {
    }

    public function task(): Task
    {
        return $this->task ?? abort(404);
    }
}
