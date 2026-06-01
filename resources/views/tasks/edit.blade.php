@extends('layouts.app')

@section('title', 'Modifier la tache | TaskPilot IA')

@section('content')
    <section class="mb-8">
        <p class="eyebrow">Mise a jour</p>
        <h1 class="page-title">Modifier la tache</h1>
        <p class="page-subtitle">{{ $task->title }}</p>
    </section>

    <section class="panel">
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @method('PUT')
            @include('tasks._form', ['submitLabel' => 'Enregistrer'])
        </form>
    </section>
@endsection
