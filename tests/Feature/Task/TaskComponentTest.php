<?php

use App\Livewire\Task\CreateTask;
use Database\Factories\UserFactory;
use Domain\Task\Models\Task;
use Domain\User\Models\User;
use Livewire\Livewire;
use Tests\Feature\Task\Factory\CreateTaskRequestFactory;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

uses()->group('task');

test('Task created success', function () {
    /** @var User $user */
    $user = UserFactory::new()->create();

    $taskCreateRequestData = CreateTaskRequestFactory::new()->make();

   $component = Livewire::actingAs($user)
       ->test(CreateTask::class);

   foreach ($taskCreateRequestData as $field => $value) {
       $component->set($field, $value);
   }

   $component->call('create')
       ->assertStatus(200)
       ->assertRedirect(route('task.list'));

    assertDatabaseHas(
        Task::class,
        array_merge([
            'title' => $taskCreateRequestData['form.title'],
            'description' => $taskCreateRequestData['form.description'],
            'executor_id' => $taskCreateRequestData['form.executorId'],
            'date_end' => $taskCreateRequestData['form.dateEnd'],
        ], ['owner_id' => $user->getAuthIdentifier()])
    );
});

test('Task not created, validation error', function () {
    /** @var User $user */
    $user = UserFactory::new()->create();

    $taskCreateRequestData = CreateTaskRequestFactory::new()->make(['form.executorId' => 0]);

    $component = Livewire::actingAs($user)
        ->test(CreateTask::class);

    foreach ($taskCreateRequestData as $field => $value) {
        $component->set($field, $value);
    }

    $component->call('create')
        ->assertHasErrors(['form.executorId']);

    assertDatabaseMissing(
        Task::class,
        array_merge([
            'title' => $taskCreateRequestData['form.title'],
            'description' => $taskCreateRequestData['form.description'],
            'executor_id' => $taskCreateRequestData['form.executorId'],
            'date_end' => $taskCreateRequestData['form.dateEnd'],
        ], ['owner_id' => $user->getAuthIdentifier()])
    );
});
