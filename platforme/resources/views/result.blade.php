<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobAI | Resultat de prediction</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-white">
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute left-0 top-0 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl"></div>
        <div class="absolute right-0 top-24 h-96 w-96 rounded-full bg-cyan-500/20 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.06),transparent_35%),linear-gradient(135deg,#020617_0%,#0f172a_50%,#111827_100%)]"></div>
    </div>

    <nav class="border-b border-white/10 bg-slate-950/70 backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <a href="/" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 text-sm font-bold text-white">
                    JA
                </div>
                <div>
                    <p class="text-lg font-semibold text-white">JobAI</p>
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Prediction Result</p>
                </div>
            </a>

            <div class="hidden items-center gap-8 text-sm font-medium text-slate-300 md:flex">
                <a href="/" class="transition hover:text-cyan-300">Prediction</a>
                <a href="/jobs" class="transition hover:text-cyan-300">Offres</a>
                <a href="/history" class="transition hover:text-cyan-300">Statistiques</a>
            </div>

            <a href="/admin/jobs/create" class="rounded-full border border-cyan-400/30 bg-cyan-400/10 px-5 py-2 text-sm font-semibold text-cyan-200 transition hover:bg-cyan-400/20">
                Publier une offre
            </a>
        </div>
    </nav>

    <main class="mx-auto flex min-h-[calc(100vh-77px)] max-w-7xl items-center px-6 py-12">
        <div class="grid w-full gap-8 lg:grid-cols-[0.95fr_1.05fr]">
            <section class="flex flex-col justify-center">
                <span class="inline-flex w-fit rounded-full border border-emerald-400/20 bg-white/5 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-emerald-200">
                    Prediction terminee
                </span>
                <h1 class="mt-6 text-4xl font-black leading-tight text-white md:text-5xl">
                    Votre estimation salariale est prete.
                </h1>
                <p class="mt-5 max-w-xl text-lg leading-8 text-slate-300">
                    Le resultat ci-contre synthétise la prediction generee a partir de votre experience, du poste vise, de la ville et de la competence principale.
                </p>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                        <p class="text-sm text-slate-400">Statut</p>
                        <p class="mt-2 text-2xl font-bold text-white">Analyse complete</p>
                    </div>
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                        <p class="text-sm text-slate-400">Type</p>
                        <p class="mt-2 text-2xl font-bold text-white">Salaire estime</p>
                    </div>
                </div>
            </section>

            <section class="relative">
                <div class="absolute inset-0 rounded-[2rem] bg-gradient-to-br from-emerald-400/20 to-cyan-500/20 blur-2xl"></div>
                <div class="relative rounded-[2rem] border border-white/10 bg-white/95 p-8 text-slate-900 shadow-2xl shadow-slate-950/30">
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-emerald-700">Resultat</p>
                    <h2 class="mt-2 text-3xl font-bold text-slate-950">Estimation du salaire</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Valeur indicative issue du modele de prediction configure dans l'application.
                    </p>

                    <div class="mt-8 rounded-[2rem] bg-gradient-to-br from-emerald-50 via-white to-cyan-50 p-8 text-center ring-1 ring-emerald-100">
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Salaire estime</p>
                        <p class="mt-4 text-5xl font-black text-slate-950 md:text-6xl">
                            {{ number_format($salary, 0, ',', ' ') }}
                            <span class="text-2xl font-bold text-emerald-700 md:text-3xl">DT</span>
                        </p>
                        <p class="mt-4 text-sm text-slate-500">
                            Base sur votre experience, votre diplome, votre poste et vos competences.
                        </p>
                    </div>

                    <div class="mt-8 grid gap-3 sm:grid-cols-2">
                        <a href="/predict" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                            Nouvelle prediction
                        </a>
                        <a href="/history" class="inline-flex items-center justify-center rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-cyan-300 hover:bg-cyan-50 hover:text-cyan-800">
                            Voir les statistiques
                        </a>
                    </div>

                    <div class="mt-6 rounded-2xl bg-slate-50 px-4 py-4 text-sm text-slate-600">
                        Pour comparer ce resultat avec les autres profils, consultez le tableau de bord statistique ou les offres disponibles.
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
