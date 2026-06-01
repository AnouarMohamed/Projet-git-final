<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'TaskPilot IA')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-stone-50 text-stone-950 antialiased">
        <div class="min-h-screen">
            <header class="border-b border-stone-200 bg-stone-100/90">
                <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-5 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                    <a href="{{ route('tasks.index') }}" class="group flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-md bg-emerald-700 text-sm font-bold text-stone-50 shadow-sm">TP</span>
                        <span>
                            <span class="block text-base font-semibold tracking-normal text-stone-950">TaskPilot IA</span>
                            <span class="block text-sm text-stone-600">Pilotage simple des priorites et livrables</span>
                        </span>
                    </a>

                    <nav class="flex flex-wrap items-center gap-2 text-sm font-medium">
                        <a href="{{ route('tasks.index') }}" class="nav-link {{ request()->routeIs('tasks.index') ? 'nav-link-active' : '' }}">Tableau</a>
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Nouvelle tache</a>
                    </nav>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                @if (session('status'))
                    <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </body>
</html>
