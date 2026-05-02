<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobAI | Publier une offre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,rgba(14,165,233,0.12),transparent_25%),radial-gradient(circle_at_bottom_right,rgba(16,185,129,0.12),transparent_25%),linear-gradient(180deg,#f8fafc_0%,#eef2ff_100%)]"></div>

    <nav class="border-b border-slate-200/80 bg-white/85 backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <a href="/" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 text-sm font-bold text-white shadow-lg shadow-cyan-500/20">
                    JA
                </div>
                <div>
                    <p class="text-lg font-semibold text-slate-900">JobAI</p>
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Publication</p>
                </div>
            </a>

            <div class="hidden items-center gap-8 text-sm font-medium text-slate-600 md:flex">
                <a href="/" class="transition hover:text-cyan-700">Prediction</a>
                <a href="/jobs" class="transition hover:text-cyan-700">Offres</a>
                <a href="/history" class="transition hover:text-cyan-700">Statistiques</a>
            </div>

            <a href="/jobs" class="rounded-full bg-slate-950 px-5 py-2 text-sm font-semibold text-white transition hover:bg-cyan-700">
                Retour aux offres
            </a>
        </div>
    </nav>

    <main class="mx-auto grid min-h-[calc(100vh-77px)] max-w-7xl gap-10 px-6 py-10 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
        <section>
            <span class="inline-flex rounded-full border border-cyan-200 bg-cyan-50 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-700">
                Interface recruteur
            </span>
            <h1 class="mt-6 text-4xl font-black leading-tight text-slate-950 md:text-5xl">
                Creez une offre d'emploi claire, professionnelle et engageante.
            </h1>
            <p class="mt-5 max-w-xl text-lg leading-8 text-slate-600">
                Cette page permet d'ajouter rapidement une annonce avec les informations essentielles pour rendre la publication visible et credible.
            </p>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl border border-white bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Diffusion rapide</p>
                    <p class="mt-2 text-2xl font-bold text-slate-950">Formulaire simplifie</p>
                </div>
                <div class="rounded-3xl border border-white bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Lisibilite</p>
                    <p class="mt-2 text-2xl font-bold text-slate-950">Structure coherente</p>
                </div>
            </div>
        </section>

        <section class="relative">
            <div class="absolute inset-0 rounded-[2rem] bg-gradient-to-br from-cyan-400/15 to-emerald-400/15 blur-2xl"></div>
            <div class="relative rounded-[2rem] border border-white/80 bg-white p-8 shadow-xl shadow-slate-200/60">
                <div class="mb-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-cyan-700">Nouvelle annonce</p>
                    <h2 class="mt-2 text-3xl font-bold text-slate-950">Ajouter une offre d'emploi</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Renseignez les informations ci-dessous pour publier une annonce compatible avec le nouveau design.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-4 text-sm text-red-700">
                        <p class="font-semibold">Veuillez corriger les champs suivants :</p>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="/admin/jobs/store" class="space-y-4">
                    @csrf

                    <div>
                        <label for="title" class="mb-2 block text-sm font-semibold text-slate-700">Poste</label>
                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Ex: Data Analyst"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100"
                            required
                        >
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label for="company" class="mb-2 block text-sm font-semibold text-slate-700">Societe</label>
                            <input
                                id="company"
                                type="text"
                                name="company"
                                value="{{ old('company') }}"
                                placeholder="Nom de l'entreprise"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100"
                                required
                            >
                        </div>

                        <div>
                            <label for="city" class="mb-2 block text-sm font-semibold text-slate-700">Ville</label>
                            <input
                                id="city"
                                type="text"
                                name="city"
                                value="{{ old('city') }}"
                                placeholder="Ex: Tunis"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100"
                                required
                            >
                        </div>
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email RH</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="rh@entreprise.com"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100"
                            required
                        >
                    </div>

                    <div>
                        <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">Description du poste</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="6"
                            placeholder="Missions, profil recherche, environnement, avantages..."
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100"
                            required
                        >{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="w-full rounded-2xl bg-slate-950 px-6 py-4 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        Enregistrer l'offre
                    </button>
                </form>

                <div class="mt-6 flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-4 text-sm text-slate-600">
                    <span>Besoin de verifier le rendu final ?</span>
                    <a href="/jobs" class="font-semibold text-cyan-700 transition hover:text-cyan-900">
                        Voir les offres publiees
                    </a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
