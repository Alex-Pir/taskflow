<?php

namespace App\Livewire\Task;

use App\Livewire\Task\Forms\UpdateTaskForm;
use Domain\Project\Models\Project;
use Domain\Task\Actions\UpdateTaskAction;
use Domain\Task\Models\Task;
use Domain\User\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class UpdateTask extends Component
{
    public Task $task;

    public UpdateTaskForm $form;

    public function mount(int $id): void
    {
        $this->task = Task::query()->findOrFail($id);
    }

    /**
     * @throws ValidationException
     */
    public function update(): Redirector|RedirectResponse
    {
        (new UpdateTaskAction())->execute($this->task, $this->form->getDTO());

        return redirect(route('task.list'));
    }

    public function render(): View
    {
        return view('livewire.task.update-task', [
            'task' => $this->task,
            'projects' => Project::query()->get(['id', 'title']),
            'executors' => User::query()->get(['id', 'name']),
        ]);
    }
}
