<?php

namespace Database\Factories;

use Domain\Project\Models\Project;
use Domain\Task\Models\Status;
use Domain\Task\Models\Task;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::factory()->create()->value('id'),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status_id' => Status::query()->inRandomOrder()->value('id'),
            'date_end' => $this->faker->date(),
            'owner_id' => User::factory()->create()->value('id'),
            'executor_id' => User::factory()->create()->value('id'),
        ];
    }
}
