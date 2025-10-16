<?php

namespace Tests\Feature\Task\Factory;

use Domain\Project\Models\Project;
use Domain\User\Models\User;
use Tests\Support\BaseApiFactory;

class CreateTaskRequestFactory extends BaseApiFactory
{
    public function definition(): array
    {
        return [
            'form.projectId' => Project::factory()->create()->value('id'),
            'form.title' => $this->faker->sentence(),
            'form.description' => $this->faker->paragraph(),
            'form.executorId' => User::factory()->create()->value('id'),
            'form.dateEnd' => $this->faker->date(),
        ];
    }

    public function make(array $extra = []): array
    {
        return $this->makeArray($extra);
    }
}
