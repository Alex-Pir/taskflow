@extends('layouts.app')

@section('title', __('Tasks'))

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:task.create-task />
                </div>
            </div>
            <!-- Список задач -->
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">{{ __('Tasks List') }}</h5>
                </div>
                <div class="card-body p-0">
                    @if($tasks->isEmpty())
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-tasks fa-3x mb-3"></i>
                            <p>{{ __('No tasks found.') }}</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('End Date') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>
                                            <a href="{{ route('task.show', $task) }}"><strong>{{ Str::limit(e($task->title), 50) }}</strong></a>
                                            <br>
                                            <small class="text-muted">
                                                {{ Str::limit(strip_tags($task->description), 80) }}
                                            </small>
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = [
                                                    'pending' => 'warning',
                                                    'in_progress' => 'info',
                                                    'completed' => 'success'
                                                ][$task->status->code] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $statusClass }}">
                                                {{ __($task->status->name) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($task->date_end)
                                                {{ $task->date_end->format('d.m.Y') }}
                                                @if($task->date_end->isPast() && $task->status !== 'completed')
                                                    <span class="text-danger ms-2"><i class="fas fa-exclamation-triangle"></i></span>
                                                @endif
                                            @else
                                                <em>{{ __('No date') }}</em>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Пагинация -->
                        <div class="card-footer bg-white">
                            {{ $tasks->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
