<section class="panel">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <p class="eyebrow">Assistant IA</p>
            <h2 class="section-title mt-2">Suggestion sauvegardee</h2>
        </div>
        <form method="POST" action="{{ route('tasks.ai-suggestion.store', $task) }}">
            @csrf
            <button type="submit" class="btn btn-primary">Generer une suggestion</button>
        </form>
    </div>

    @if ($latestSuggestion)
        <div class="mt-6 space-y-5">
            <div>
                <span class="{{ $latestSuggestion->suggested_priority->badgeClass() }}">
                    Priorite conseillee: {{ $latestSuggestion->suggested_priority->label() }}
                </span>
                <span class="ml-2 text-sm text-stone-600">
                    {{ $latestSuggestion->estimated_minutes }} min estimees, via {{ $latestSuggestion->provider }}
                </span>
            </div>

            <p class="text-sm leading-7 text-stone-700">{{ $latestSuggestion->summary }}</p>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <h3 class="text-sm font-semibold text-stone-950">Sous-taches</h3>
                    <ul class="mt-3 space-y-2 text-sm leading-6 text-stone-700">
                        @foreach ($latestSuggestion->subtasks as $subtask)
                            <li class="rounded-md border border-stone-200 bg-stone-50 px-3 py-2">{{ $subtask }}</li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-stone-950">Risques</h3>
                    <ul class="mt-3 space-y-2 text-sm leading-6 text-stone-700">
                        @foreach ($latestSuggestion->risks as $risk)
                            <li class="rounded-md border border-stone-200 bg-stone-50 px-3 py-2">{{ $risk }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @else
        <p class="mt-5 text-sm leading-6 text-stone-600">
            Aucune suggestion IA pour cette tache. Generez une recommandation pour enrichir la demo.
        </p>
    @endif
</section>
