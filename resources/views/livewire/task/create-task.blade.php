<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('My Tasks') }}</h1>
        <form wire:submit="create" class="mt-6 space-y-6">
            <x-input-label for="title" :value="__('Title')"/>
            <x-text-input wire:model="form.title" id="title" class="block mt-1 w-full" type="text" name="title" required
                          autofocus autocomplete="title"/>
            <x-input-error :messages="$errors->get('form.title')" class="mt-2"/>

            <x-input-label for="description" :value="__('Description')"/>
            <x-text-input wire:model="form.description" id="description" class="block mt-1 w-full" type="text" name="description" required
                          autofocus autocomplete="description"/>
            <x-input-error :messages="$errors->get('form.description')" class="mt-2"/>

            <x-input-label for="executorId" :value="__('Executor')"/>
            <select
                wire:model="form.executorId"
                name="executorId"
                id="executorId"
                class="block mt-1 w-full"
            >
                <option value="">Select an option</option>
                @foreach($executors as $executor)
                    <option value="{{ $executor->id }}" class="text-dark">{{ $executor->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('form.executorId')" class="mt-2"/>

            <x-input-label for="projectId" :value="__('Project')"/>
            <select
                wire:model="form.projectId"
                name="projectId"
                id="projectId"
                class="block mt-1 w-full"
            >
                <option value="">Select an option</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" class="text-dark">{{ $project->title }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('form.projectId')" class="mt-2"/>

            <x-input-label for="dateEnd" :value="__('Date End')"/>
            <input
                type="date"
                class="block mt-1 w-full"
                wire:model="form.dateEnd"
                name="dateEnd"
                id="dateEnd"
                value="{{ old('dateEnd') }}"
                placeholder="{{ __('Date End') }}"
            >
            <x-input-error :messages="$errors->get('dateEnd')" class="mt-2"/>

            <button type="submit">{{ __('Create Task') }}</button>
        </form>
    </div>
</div>
