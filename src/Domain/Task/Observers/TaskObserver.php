<?php

namespace Domain\Task\Observers;

use Domain\Task\Models\Task;

class TaskObserver
{
    public function creating(Task $task): void
    {
        $userId = auth()->user()?->getAuthIdentifier();

        if (is_int($userId)) {
            $task->owner_id = $userId;
        }
    }
}
