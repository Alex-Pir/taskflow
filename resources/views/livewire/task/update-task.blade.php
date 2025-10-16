<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('My Tasks') }}</h1>
        <form wire:submit="create">
            <x-input-label for="title" :value="__('Title')"/>
            <x-text-input wire:model="title" id="title" class="block mt-1 w-full" type="text" name="title" required
                          autofocus autocomplete="title" value="{{ $task->title }}"/>
            <x-input-error :messages="$errors->get('title')" class="mt-2"/>

            <x-input-label for="description" :value="__('Description')"/>
            <x-text-input wire:model="description" id="description" class="block mt-1 w-full" type="text" name="description" required
                          autofocus autocomplete="description" value="{{ $task->description }}"/>
            <x-input-error :messages="$errors->get('description')" class="mt-2"/>

            <x-input-label for="executorId" :value="__('Executor')"/>
            <select
                wire:model="executorId"
                name="executorId"
                id="executorId"
                class="block mt-1 w-full"
            >
                <option value="">Select an option</option>
                @foreach($executors as $executor)
                    <option value="{{ $executor->id }}" class="text-dark" @if($task->executor_id == $executor->id) selected @endif>{{ $executor->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('executorId')" class="mt-2"/>
            <input
                type="date"
                class="block mt-1 w-full"
                wire:model="dateEnd"
                value="{{ $task->date_end }}"
                placeholder="{{ __('Date End') }}"
            >
            <x-input-error :messages="$errors->get('dateEnd')" class="mt-2"/>

            <button type="submit">{{ __('Update Task') }}</button>
        </form>
    </div>
</div>
