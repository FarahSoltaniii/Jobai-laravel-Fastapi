<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobAI | Statistiques</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-950 text-white">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,rgba(6,182,212,0.18),transparent_26%),radial-gradient(circle_at_bottom_right,rgba(59,130,246,0.16),transparent_24%),linear-gradient(180deg,#020617_0%,#0f172a_55%,#111827_100%)]"></div>

    <nav class="border-b border-white/10 bg-slate-950/70 backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <a href="/" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 text-sm font-bold text-white">
                    JA
                </div>
                <div>
                    <p class="text-lg font-semibold text-white">JobAI</p>
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Salary Analytics</p>
                </div>
            </a>

            <div class="hidden items-center gap-8 text-sm font-medium text-slate-300 md:flex">
                <a href="/predict" class="transition hover:text-cyan-300">Prediction</a>
                <a href="/jobs" class="transition hover:text-cyan-300">Offres</a>
                <a href="/history" class="text-white">Statistiques</a>
                 
            </div>

            <a href="/admin/jobs/create" class="rounded-full border border-cyan-400/30 bg-cyan-400/10 px-5 py-2 text-sm font-semibold text-cyan-200 transition hover:bg-cyan-400/20">
                Publier une offre
            </a>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-6 py-12">
        <section class="grid gap-8 lg:grid-cols-[1fr_0.9fr] lg:items-start">
            <div>
                <span class="inline-flex rounded-full border border-cyan-400/20 bg-white/5 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-200">
                    Tableau de bord
                </span>
                <h1 class="mt-5 text-4xl font-black leading-tight text-white md:text-5xl">
                    Suivez les tendances salariales avec une lecture plus claire.
                </h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-300">
                    Cette vue synthese met en avant les moyennes par poste pour aider a comparer rapidement les profils les plus representes.
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <p class="text-sm text-slate-400">Postes analyses</p>
                    <p class="mt-2 text-3xl font-bold text-white">{{ count($labels) }}</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <p class="text-sm text-slate-400">Moyenne globale</p>
                    <p class="mt-2 text-3xl font-bold text-white">
                        {{ count($salaries) ? number_format(collect($salaries)->avg(), 0, ',', ' ') : 0 }} DT
                    </p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <p class="text-sm text-slate-400">Maximum observe</p>
                    <p class="mt-2 text-3xl font-bold text-white">
                        {{ count($salaries) ? number_format(collect($salaries)->max(), 0, ',', ' ') : 0 }} DT
                    </p>
                </div>
            </div>
        </section>

        <section class="mt-10 grid gap-8 xl:grid-cols-[1.2fr_0.8fr]">
            <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/30 backdrop-blur">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-cyan-200">Visualisation</p>
                        <h2 class="mt-2 text-2xl font-bold text-white">Moyenne des salaires par poste</h2>
                    </div>
                    <a href="/" class="rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">
                        Retour prediction
                    </a>
                </div>
                <div class="rounded-[1.5rem] bg-slate-950/50 p-4">
                    <canvas id="salaryChart" height="140"></canvas>
                </div>
            </div>

            <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 backdrop-blur">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-cyan-200">Classement</p>
                <h2 class="mt-2 text-2xl font-bold text-white">Postes les plus valorises</h2>

                <div class="mt-6 space-y-4">
                    @forelse($predictions->sortByDesc('avg_salary') as $prediction)
                        <div class="rounded-3xl border border-white/10 bg-slate-900/60 p-4">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-base font-semibold text-white">{{ $prediction->job_title }}</p>
                                    <p class="mt-1 text-sm text-slate-400">Moyenne observee sur les predictions</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-cyan-300">{{ number_format($prediction->avg_salary, 0, ',', ' ') }} DT</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-3xl border border-dashed border-white/15 bg-slate-900/40 p-6 text-sm text-slate-400">
                            Aucune prediction n'est encore disponible pour generer les statistiques.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <script>
        const labels = @json($labels);
        const data = @json($salaries);

        const ctx = document.getElementById('salaryChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Salaire moyen (DT)',
                    data: data,
                    backgroundColor: [
                        'rgba(34, 211, 238, 0.75)',
                        'rgba(59, 130, 246, 0.75)',
                        'rgba(16, 185, 129, 0.75)',
                        'rgba(14, 165, 233, 0.75)',
                        'rgba(99, 102, 241, 0.75)'
                    ],
                    borderRadius: 14,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    x: {
                        ticks: {
                            color: '#cbd5e1'
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        ticks: {
                            color: '#cbd5e1'
                        },
                        grid: {
                            color: 'rgba(148, 163, 184, 0.15)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#e2e8f0'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
