@extends('layouts.app')

@section('title', 'Tableau des taches | TaskPilot IA')

@section('content')
    <section class="mb-8 grid gap-6 lg:grid-cols-[1fr_360px] lg:items-end">
        <div>
            <p class="eyebrow">Tableau de bord</p>
            <h1 class="page-title">Taches de l'equipe</h1>
            <p class="page-subtitle">Suivez le travail prioritaire et preparez la demonstration MVP.</p>
        </div>

        <form method="GET" action="{{ route('tasks.index') }}" class="grid gap-3 rounded-md border border-stone-200 bg-stone-100 p-4 sm:grid-cols-2">
            <div>
                <label for="status" class="form-label">Statut</label>
                <select id="status" name="status" class="form-input">
                    <option value="">Tous</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="priority" class="form-label">Priorite</label>
                <select id="priority" name="priority" class="form-input">
                    <option value="">Toutes</option>
                    @foreach ($priorities as $priority)
                        <option value="{{ $priority->value }}" @selected(request('priority') === $priority->value)>{{ $priority->label() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2 sm:col-span-2">
                <button class="btn btn-secondary" type="submit">Filtrer</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-ghost">Reinitialiser</a>
            </div>
        </form>
    </section>

    <section class="mb-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <div class="metric">
            <span class="metric-label">Total</span>
            <strong class="metric-value">{{ $stats['total'] }}</strong>
        </div>
        <div class="metric">
            <span class="metric-label">A faire</span>
            <strong class="metric-value">{{ $stats['todo'] }}</strong>
        </div>
        <div class="metric">
            <span class="metric-label">En cours</span>
            <strong class="metric-value">{{ $stats['progress'] }}</strong>
        </div>
        <div class="metric">
            <span class="metric-label">Terminees</span>
            <strong class="metric-value">{{ $stats['done'] }}</strong>
        </div>
    </section>

    <section class="overflow-hidden rounded-md border border-stone-200 bg-stone-100">
        @forelse ($tasks as $task)
            <article class="grid gap-4 border-b border-stone-200 px-4 py-5 last:border-b-0 md:grid-cols-[1fr_220px] md:items-center">
                <div class="min-w-0">
                    <div class="mb-2 flex flex-wrap items-center gap-2">
                        <span class="{{ $task->status->badgeClass() }}">{{ $task->status->label() }}</span>
                        <span class="{{ $task->priority->badgeClass() }}">{{ $task->priority->label() }}</span>
                        @if ($task->isLate())
                            <span class="badge badge-danger">En retard</span>
                        @endif
                    </div>
                    <h2 class="truncate text-base font-semibold text-stone-950">
                        <a href="{{ route('tasks.show', $task) }}" class="hover:text-emerald-800">{{ $task->title }}</a>
                    </h2>
                    <p class="mt-1 line-clamp-2 text-sm leading-6 text-stone-600">
                        {{ $task->description ?: 'Aucune description.' }}
                    </p>
                </div>

                <div class="flex flex-col gap-3 md:items-end">
                    <span class="text-sm text-stone-600">
                        {{ $task->due_date ? 'Limite: '.$task->due_date->format('d/m/Y') : 'Sans date limite' }}
                    </span>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-secondary">Voir</a>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-ghost">Modifier</a>
                    </div>
                </div>
            </article>
        @empty
            <div class="px-6 py-14 text-center">
                <p class="mx-auto max-w-lg text-sm leading-6 text-stone-600">
                    Aucune tache pour le moment. Creez la premiere tache pour lancer la demo du MVP.
                </p>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary mt-5">Creer une tache</a>
            </div>
        @endforelse
    </section>

    <div class="mt-6">
        {{ $tasks->links() }}
    </div>
@endsection
