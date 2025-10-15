<?php

namespace Domain\Task\DTOs;

use Carbon\CarbonInterface;
use Illuminate\Contracts\Support\Arrayable;

/**
 * @implements Arrayable<string, mixed>
 */
readonly class ExistTaskDTO implements Arrayable
{
    use FeasibleTask;

    private const DATE_FORMAT = 'Y-m-d';

    public function __construct(
        public ?int $projectId,
        public ?string $title,
        public ?string $description,
        public ?int $statusId,
        public ?int $executorId,
        public ?CarbonInterface $dateEnd
    ) {
    }

    public function toArray(): array
    {
        return [
            'project_id' => $this->projectId,
            'name' => $this->title,
            'description' => $this->description,
            'status_id' => $this->statusId,
            'executor_id' => $this->executorId,
            'date_end' => $this->dateEnd,
        ];
    }
}
