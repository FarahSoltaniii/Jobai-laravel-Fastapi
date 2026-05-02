<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobAI | Prediction de salaire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute left-0 top-0 h-80 w-80 rounded-full bg-cyan-500/20 blur-3xl"></div>
        <div class="absolute right-0 top-24 h-96 w-96 rounded-full bg-blue-600/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-emerald-500/10 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.06),transparent_35%),linear-gradient(135deg,#020617_0%,#0f172a_50%,#111827_100%)]"></div>
    </div>

    <nav class="border-b border-white/10 bg-slate-950/70 backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <a href="/" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 text-lg font-bold text-white shadow-lg shadow-cyan-500/20">
                    JA
                </div>
                <div>
                    <p class="text-lg font-semibold tracking-wide text-white">JobAI</p>
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Career Intelligence</p>
                </div>
            </a>

            <div class="hidden items-center gap-8 text-sm font-medium text-slate-300 md:flex">
                <a href="/" class="text-white transition hover:text-cyan-300">Accueil</a>
                <a href="/jobs" class="transition hover:text-cyan-300">Offres</a>
                <a href="/history" class="transition hover:text-cyan-300">Statistiques</a>
            </div>

            <a href="/admin/jobs/create" class="rounded-full border border-cyan-400/30 bg-cyan-400/10 px-5 py-2 text-sm font-semibold text-cyan-200 transition hover:border-cyan-300 hover:bg-cyan-400/20">
                Publier une offre
            </a>
        </div>
    </nav>

    <main class="mx-auto grid min-h-[calc(100vh-77px)] max-w-7xl gap-10 px-6 py-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center lg:py-16">
        <section class="max-w-2xl">
            <span class="inline-flex rounded-full border border-cyan-400/20 bg-white/5 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-cyan-200">
                Plateforme de prediction
            </span>

            <h1 class="mt-6 text-4xl font-black leading-tight text-white md:text-6xl">
                Estimez un salaire plus vite, avec une interface digne d'un produit pro.
            </h1>

            <p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">
                Analysez un profil, estimez une remuneration et consultez les tendances du marche tech a travers une experience moderne, lisible et rassurante.
            </p>

            <div class="mt-8 flex flex-wrap gap-4">
                <a href="/jobs" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-100">
                    Explorer les offres
                </a>
                <a href="/history" class="rounded-full border border-white/15 px-6 py-3 text-sm font-semibold text-white transition hover:border-white/30 hover:bg-white/5">
                    Voir les statistiques
                </a>
            </div>

            <div class="mt-10 grid gap-4 sm:grid-cols-3">
                <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <p class="text-3xl font-bold text-white">+500</p>
                    <p class="mt-2 text-sm text-slate-300">Simulations rapides pour orienter les candidats.</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <p class="text-3xl font-bold text-white">3 sec</p>
                    <p class="mt-2 text-sm text-slate-300">Temps moyen pour obtenir une estimation claire.</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <p class="text-3xl font-bold text-white">Data</p>
                    <p class="mt-2 text-sm text-slate-300">Approche orientee profils, villes et competences.</p>
                </div>
            </div>
        </section>

        <section class="relative">
            <div class="absolute inset-0 rounded-[2rem] bg-gradient-to-br from-cyan-400/20 to-blue-600/20 blur-2xl"></div>
            <div class="relative rounded-[2rem] border border-white/10 bg-white/95 p-8 text-slate-900 shadow-2xl shadow-slate-950/30">
                <div class="mb-8 flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-cyan-700">Simulation salary</p>
                        <h2 class="mt-2 text-3xl font-bold text-slate-900">Prediction de salaire</h2>
                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            Renseignez quelques informations pour obtenir une estimation adaptee au poste et au niveau d'experience.
                        </p>
                    </div>
                    <div class="rounded-2xl bg-slate-100 px-4 py-3 text-right">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Insight</p>
                        <p class="mt-1 text-lg font-bold text-slate-900">Marche tech</p>
                    </div>
                </div>

                <form method="POST" action="/predict" class="space-y-4">
                    @csrf

                    @if ($errors->any())
                        <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div>
                        <label for="experience_years" class="mb-2 block text-sm font-semibold text-slate-700">Annees d'experience</label>
                        <input
                            id="experience_years"
                            type="number"
                            step="0.1"
                            name="experience_years"
                            placeholder="Ex: 3.5"
                            value="{{ old('experience_years') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100"
                            required
                        >
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label for="degree" class="mb-2 block text-sm font-semibold text-slate-700">Diplome</label>
                            <select id="degree" name="degree" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100" required>
                                <option value="">Choisir un diplome</option>
                                <option value="Bachelor" @selected(old('degree') === 'Bachelor')>Bachelor</option>
                                <option value="Master" @selected(old('degree') === 'Master')>Master</option>
                                <option value="PhD" @selected(old('degree') === 'PhD')>PhD</option>
                            </select>
                        </div>

                        <div>
                            <label for="city" class="mb-2 block text-sm font-semibold text-slate-700">Ville</label>
                            <select id="city" name="city" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100" required>
                                <option value="">Choisir une ville</option>
                                <option value="Tunis" @selected(old('city') === 'Tunis')>Tunis</option>
                                <option value="Sfax" @selected(old('city') === 'Sfax')>Sfax</option>
                                <option value="Sousse" @selected(old('city') === 'Sousse')>Sousse</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="job_title" class="mb-2 block text-sm font-semibold text-slate-700">Poste cible</label>
                        <select id="job_title" name="job_title" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100" required>
                            <option value="">Choisir un poste</option>
                            <option value="Data Analyst" @selected(old('job_title') === 'Data Analyst')>Data Analyst</option>
                            <option value="Data Scientist" @selected(old('job_title') === 'Data Scientist')>Data Scientist</option>
                            <option value="Web Developer" @selected(old('job_title') === 'Web Developer')>Web Developer</option>
                            <option value="Backend Developer" @selected(old('job_title') === 'Backend Developer')>Backend Developer</option>
                            <option value="Frontend Developer" @selected(old('job_title') === 'Frontend Developer')>Frontend Developer</option>
                            <option value="ML Engineer" @selected(old('job_title') === 'ML Engineer')>ML Engineer</option>
                            <option value="AI Engineer" @selected(old('job_title') === 'AI Engineer')>AI Engineer</option>
                            <option value="Data Engineer" @selected(old('job_title') === 'Data Engineer')>Data Engineer</option>
                            <option value="DevOps Engineer" @selected(old('job_title') === 'DevOps Engineer')>DevOps Engineer</option>
                            <option value="System Admin" @selected(old('job_title') === 'System Admin')>System Admin</option>
                            <option value="QA Engineer" @selected(old('job_title') === 'QA Engineer')>QA Engineer</option>
                            <option value="Business Analyst" @selected(old('job_title') === 'Business Analyst')>Business Analyst</option>
                            <option value="Project Manager" @selected(old('job_title') === 'Project Manager')>Project Manager</option>
                            <option value="Mobile Developer" @selected(old('job_title') === 'Mobile Developer')>Mobile Developer</option>
                            <option value="Support Engineer" @selected(old('job_title') === 'Support Engineer')>Support Engineer</option>
                            <option value="Research Scientist" @selected(old('job_title') === 'Research Scientist')>Research Scientist</option>
                        </select>
                    </div>

                    <div>
                        <label for="skill" class="mb-2 block text-sm font-semibold text-slate-700">Competence principale</label>
                        <select id="skill" name="skill" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100" required>
                            <option value="">Choisir une competence</option>
                            <option value="Python" @selected(old('skill') === 'Python')>Python</option>
                            <option value="SQL" @selected(old('skill') === 'SQL')>SQL</option>
                            <option value="Excel" @selected(old('skill') === 'Excel')>Excel</option>
                            <option value="Machine Learning" @selected(old('skill') === 'Machine Learning')>Machine Learning</option>
                            <option value="Deep Learning" @selected(old('skill') === 'Deep Learning')>Deep Learning</option>
                            <option value="JavaScript" @selected(old('skill') === 'JavaScript')>JavaScript</option>
                            <option value="React" @selected(old('skill') === 'React')>React</option>
                            <option value="Django" @selected(old('skill') === 'Django')>Django</option>
                            <option value="Docker" @selected(old('skill') === 'Docker')>Docker</option>
                            <option value="Kubernetes" @selected(old('skill') === 'Kubernetes')>Kubernetes</option>
                            <option value="Linux" @selected(old('skill') === 'Linux')>Linux</option>
                            <option value="Cloud" @selected(old('skill') === 'Cloud')>Cloud</option>
                            <option value="Testing" @selected(old('skill') === 'Testing')>Testing</option>
                            <option value="Automation" @selected(old('skill') === 'Automation')>Automation</option>
                            <option value="Power BI" @selected(old('skill') === 'Power BI')>Power BI</option>
                            <option value="Management" @selected(old('skill') === 'Management')>Management</option>
                            <option value="Flutter" @selected(old('skill') === 'Flutter')>Flutter</option>
                            <option value="Spark" @selected(old('skill') === 'Spark')>Spark</option>
                            <option value="AI" @selected(old('skill') === 'AI')>AI</option>
                            <option value="Networking" @selected(old('skill') === 'Networking')>Networking</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full rounded-2xl bg-slate-950 px-6 py-4 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        Lancer la prediction
                    </button>
                </form>

                <div class="mt-6 flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-4 text-sm text-slate-600">
                    <span>Besoin d'une vue plus globale du marche ?</span>
                    <a href="/history" class="font-semibold text-cyan-700 transition hover:text-cyan-900">
                        Consulter l'historique
                    </a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
