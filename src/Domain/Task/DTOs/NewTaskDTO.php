<?php

namespace Domain\Task\DTOs;

use Carbon\CarbonInterface;

final readonly class NewTaskDTO
{
    use FeasibleTask;

    private const DATE_FORMAT = 'Y-m-d';

    public function __construct(
        public int $projectId,
        public string $title,
        public string $description,
        public int $executorId,
        public ?CarbonInterface $dateEnd
    ) {
    }
}
