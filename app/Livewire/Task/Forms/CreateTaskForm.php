<?php

namespace App\Livewire\Task\Forms;

use Domain\Task\DTOs\NewTaskDTO;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateTaskForm extends Form
{
    #[Validate('required|exists:projects,id')]
    public int $projectId;

    #[Validate('required|string|max:255')]
    public string $title;

    #[Validate('required|string')]
    public string $description;

    #[Validate('required|exists:users,id')]
    public int $executorId;

    #[Validate('nullable|date_format:Y-m-d')]
    public string $dateEnd;

    /**
     * @throws ValidationException
     */
    public function getDTO(): NewTaskDTO
    {
        return NewTaskDTO::make($this->validate());
    }
}
