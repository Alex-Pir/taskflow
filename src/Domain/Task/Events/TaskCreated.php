<?php

namespace Domain\Task\Events;

use Domain\Task\Models\Task;
use Illuminate\Queue\SerializesModels;

class TaskCreated
{
    use SerializesModels;

    public function __construct(private readonly Task $task)
    {
    }

    public function getTask(): Task
    {
        return $this->task;
    }
}
