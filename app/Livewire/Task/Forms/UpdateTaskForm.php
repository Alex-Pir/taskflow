<?php

namespace App\Livewire\Task\Forms;

use Domain\Task\DTOs\ExistTaskDTO;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateTaskForm extends Form
{
    #[Validate('nullable|exists:projects,id')]
    public int $projectId;

    #[Validate('nullable|string')]
    public string $title;

    #[Validate('nullable|string')]
    public string $description;

    #[Validate('nullable|exists:users,id')]
    public int $executorId;

    #[Validate('nullable|date_format:Y-m-d')]
    public string $dateEnd;

    /**
     * @throws ValidationException
     */
    public function getDTO(): ExistTaskDTO
    {
        return ExistTaskDTO::make($this->validate());
    }
}
