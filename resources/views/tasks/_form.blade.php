@csrf

<div class="space-y-6">
    <div>
        <label for="title" class="form-label">Titre</label>
        <input
            id="title"
            name="title"
            type="text"
            value="{{ old('title', $task->title ?? '') }}"
            class="form-input"
            maxlength="120"
            required
            autofocus
        >
        @error('title')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" rows="6" class="form-input">{{ old('description', $task->description ?? '') }}</textarea>
        @error('description')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div>
            <label for="status" class="form-label">Statut</label>
            <select id="status" name="status" class="form-input">
                @foreach ($statuses as $status)
                    <option value="{{ $status->value }}" @selected(old('status', ($task->status ?? \App\Enums\TaskStatus::Todo)->value) === $status->value)>
                        {{ $status->label() }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="priority" class="form-label">Priorite</label>
            <select id="priority" name="priority" class="form-input">
                @foreach ($priorities as $priority)
                    <option value="{{ $priority->value }}" @selected(old('priority', ($task->priority ?? \App\Enums\TaskPriority::Medium)->value) === $priority->value)>
                        {{ $priority->label() }}
                    </option>
                @endforeach
            </select>
            @error('priority')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="due_date" class="form-label">Date limite</label>
            <input id="due_date" name="due_date" type="date" value="{{ old('due_date', optional($task->due_date ?? null)->format('Y-m-d')) }}" class="form-input">
            @error('due_date')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<div class="mt-8 flex flex-wrap items-center gap-3">
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    <a href="{{ isset($task) ? route('tasks.show', $task) : route('tasks.index') }}" class="btn btn-secondary">Annuler</a>
</div>
