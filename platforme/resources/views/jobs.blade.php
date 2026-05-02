<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobAI | Offres d'emploi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,rgba(14,165,233,0.14),transparent_24%),radial-gradient(circle_at_top_right,rgba(59,130,246,0.12),transparent_26%),linear-gradient(180deg,#f8fafc_0%,#eef2ff_100%)]">
        <nav class="border-b border-slate-200/80 bg-white/85 backdrop-blur-xl">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
                <a href="/" class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 text-sm font-bold text-white shadow-lg shadow-cyan-500/20">
                        JA
                    </div>
                    <div>
                        <p class="text-lg font-semibold text-slate-900">JobAI</p>
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Opportunites</p>
                    </div>
                </a>

                <div class="hidden items-center gap-8 text-sm font-medium text-slate-600 md:flex">
                    <a href="/predict" class="transition hover:text-cyan-700">Prediction</a>
                    <a href="/jobs" class="text-slate-950">Offres</a>
                    <a href="/history" class="transition hover:text-cyan-700">Statistiques</a>
                </div>

                <a href="/admin/jobs/create" class="rounded-full bg-slate-950 px-5 py-2 text-sm font-semibold text-white transition hover:bg-cyan-700">
                    Publier une offre
                </a>
            </div>
        </nav>

        <header class="mx-auto max-w-7xl px-6 pb-8 pt-12">
            <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr] lg:items-end">
                <div>
                    <span class="inline-flex rounded-full border border-cyan-200 bg-cyan-50 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-700">
                        Recrutement tech
                    </span>
                    <h1 class="mt-5 max-w-3xl text-4xl font-black leading-tight text-slate-950 md:text-5xl">
                        Des offres plus lisibles, plus credibles et plus attractives pour les candidats.
                    </h1>
                    <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600">
                        Parcourez les opportunites recentes, comparez les informations essentielles d'un coup d'oeil et contactez les recruteurs rapidement.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-3 lg:grid-cols-1">
                    <div class="rounded-3xl border border-white bg-white p-5 shadow-sm">
                        <p class="text-sm font-medium text-slate-500">Offres publiees</p>
                        <p class="mt-2 text-3xl font-bold text-slate-950">{{ $jobs->count() }}</p>
                    </div>
                    <div class="rounded-3xl border border-white bg-white p-5 shadow-sm">
                        <p class="text-sm font-medium text-slate-500">Villes couvertes</p>
                        <p class="mt-2 text-3xl font-bold text-slate-950">{{ $jobs->pluck('city')->filter()->unique()->count() }}</p>
                    </div>
                    <div class="rounded-3xl border border-white bg-white p-5 shadow-sm">
                        <p class="text-sm font-medium text-slate-500">Mise a jour</p>
                        <p class="mt-2 text-lg font-bold text-slate-950">
                            {{ $jobs->isNotEmpty() ? $jobs->first()->created_at->diffForHumans() : 'Aucune offre' }}
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 pb-16">
            @if($jobs->isEmpty())
                <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white/80 p-12 text-center shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Aucune offre disponible</p>
                    <h2 class="mt-4 text-3xl font-bold text-slate-950">La plateforme attend ses prochaines opportunites.</h2>
                    <p class="mx-auto mt-4 max-w-xl text-slate-600">
                        Publiez la premiere annonce pour lancer un espace d'emploi plus professionnel et inspirez confiance des la premiere visite.
                    </p>
                    <a href="/admin/jobs/create" class="mt-8 inline-flex rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        Ajouter une offre
                    </a>
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($jobs as $job)
                        <article class="group flex h-full flex-col rounded-[2rem] border border-white/70 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-200">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-950 text-lg font-bold text-white">
                                        {{ strtoupper(substr($job->company, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-cyan-700">Entreprise</p>
                                        <h2 class="mt-1 text-xl font-bold text-slate-950">{{ $job->title }}</h2>
                                        <p class="mt-1 text-sm text-slate-500">{{ $job->company }}</p>
                                    </div>
                                </div>
                                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    Disponible
                                </span>
                            </div>

                            <div class="mt-6 flex flex-wrap gap-2">
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">{{ $job->city }}</span>
                                <span class="rounded-full bg-cyan-50 px-3 py-1 text-xs font-semibold text-cyan-700">Contact direct</span>
                                <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">Recrutement ouvert</span>
                            </div>

                            <p class="mt-6 flex-1 text-sm leading-7 text-slate-600">
                                {{ Str::limit($job->description, 140) }}
                            </p>

                            <div class="mt-6 rounded-2xl bg-slate-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Coordonnees</p>
                                <a href="mailto:{{ $job->email }}" class="mt-2 block text-sm font-semibold text-slate-900 transition hover:text-cyan-700">
                                    {{ $job->email }}
                                </a>
                                <p class="mt-2 text-xs text-slate-500">
                                    Publication {{ $job->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <div class="mt-6 flex items-center justify-between">
                                <a href="mailto:{{ $job->email }}" class="inline-flex rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition group-hover:bg-cyan-700">
                                    Postuler maintenant
                                </a>
                                <span class="text-sm font-medium text-slate-400">{{ $job->city }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </main>
    </div>
</body>
</html>
