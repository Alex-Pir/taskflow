<?php

namespace Domain\Task\Actions;

use Domain\Task\DTOs\NewTaskDTO;
use Domain\Task\Events\TaskCreated;
use Domain\Task\Models\Status;
use Domain\Task\Models\Task;

class CreateTaskAction
{
    public function execute(NewTaskDTO $newTaskDTO): Task
    {
        $task = Task::query()->create([
            'title' => $newTaskDTO->title,
            'description' => $newTaskDTO->description,
            'status_id' => Status::query()
                ->where('code', Status::CREATED)
                ->firstOr(fn () => abort(400, 'Не удалось создать задачу. Не найден начальный статус'))
                ->id,
            'executor_id' => $newTaskDTO->executorId,
            'date_end' => $newTaskDTO->dateEnd,
            'project_id' => $newTaskDTO->projectId,
        ]);

        event(new TaskCreated($task));

        flash()->alert('Задача создана');

        return $task;
    }
}
