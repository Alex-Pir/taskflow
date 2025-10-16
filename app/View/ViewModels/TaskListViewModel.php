<?php

namespace App\View\ViewModels;

use Domain\Task\Models\Task;
use Domain\User\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class TaskListViewModel extends ViewModel
{
    /**
     * @return LengthAwarePaginator<int, Task>
     */
    public function tasks(): LengthAwarePaginator
    {
        return Task::query()
            ->with(['owner', 'executor', 'status'])
            ->paginate(10);
    }

    /**
     * @return Collection<int, User>
     */
    public function executors(): Collection
    {
        return User::query()->get(['id', 'name']);
    }
}
