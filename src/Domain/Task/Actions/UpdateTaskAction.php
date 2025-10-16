<?php

namespace Domain\Task\Actions;

use Domain\Task\DTOs\ExistTaskDTO;
use Domain\Task\Models\Task;

class UpdateTaskAction
{
    public function execute(Task $task, ExistTaskDTO $existTaskDTO): Task
    {
        $task->fill(array_filter($existTaskDTO->toArray()))->save();

        flash()->alert('Задача обновлена');

        return $task;
    }
}
