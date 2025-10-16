<?php

namespace App\Livewire\Task;

use App\Livewire\Task\Forms\CreateTaskForm;
use Domain\Project\Models\Project;
use Domain\Task\Actions\CreateTaskAction;
use Domain\User\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreateTask extends Component
{
    public CreateTaskForm $form;

    /**
     * @throws ValidationException
     */
    public function create(): Redirector|RedirectResponse
    {
        (new CreateTaskAction())->execute(
            $this->form->getDTO()
        );

        return redirect(route('task.list'));
    }

    public function render(): View
    {
        return view('livewire.task.create-task')->with([
            'projects' => Project::query()->get(['id', 'title']),
            'executors' => User::query()->get(['id', 'name'])
        ]);
    }
}
