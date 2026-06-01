@extends('layouts.app')

@section('title', $task->title.' | TaskPilot IA')

@section('content')
    <section class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="eyebrow">Detail</p>
            <h1 class="page-title">{{ $task->title }}</h1>
            <div class="mt-3 flex flex-wrap items-center gap-2">
                <span class="{{ $task->status->badgeClass() }}">{{ $task->status->label() }}</span>
                <span class="{{ $task->priority->badgeClass() }}">{{ $task->priority->label() }}</span>
                @if ($task->isLate())
                    <span class="badge badge-danger">En retard</span>
                @endif
            </div>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Modifier</a>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </section>

    <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <div class="space-y-6">
            <section class="panel">
                <h2 class="section-title">Description</h2>
                <p class="mt-4 whitespace-pre-line text-sm leading-7 text-stone-700">{{ $task->description ?: 'Aucune description fournie.' }}</p>
            </section>

            @include('tasks._suggestion')
        </div>

        <aside class="panel">
            <h2 class="section-title">Informations</h2>
            <dl class="mt-4 space-y-4 text-sm">
                <div>
                    <dt class="text-stone-500">Date limite</dt>
                    <dd class="mt-1 font-medium text-stone-900">{{ $task->due_date?->format('d/m/Y') ?? 'Non definie' }}</dd>
                </div>
                <div>
                    <dt class="text-stone-500">Creee le</dt>
                    <dd class="mt-1 font-medium text-stone-900">{{ $task->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-stone-500">Derniere mise a jour</dt>
                    <dd class="mt-1 font-medium text-stone-900">{{ $task->updated_at->format('d/m/Y H:i') }}</dd>
                </div>
            </dl>

            <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="mt-6" onsubmit="return confirm('Supprimer cette tache ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-full">Supprimer</button>
            </form>
        </aside>
    </div>
@endsection
