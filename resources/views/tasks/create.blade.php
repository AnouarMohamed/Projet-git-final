@extends('layouts.app')

@section('title', 'Nouvelle tache | TaskPilot IA')

@section('content')
    <section class="mb-8">
        <p class="eyebrow">MVP</p>
        <h1 class="page-title">Nouvelle tache</h1>
        <p class="page-subtitle">Centralisez le travail a faire avec un statut, une priorite et une date limite.</p>
    </section>

    <section class="panel">
        <form method="POST" action="{{ route('tasks.store') }}">
            @include('tasks._form', ['submitLabel' => 'Creer la tache'])
        </form>
    </section>
@endsection
