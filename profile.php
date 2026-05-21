<?php
require_once 'config.php';

$pageTitle = 'Profil Neuro-Psychologique';
$pageDescription = 'Cartographie cognitive et analyse en temps réel';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS • Profil Neuro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --neon-cyan: #00f5ff; --neon-purple: #c026d3; --dark-bg: #0a0a0f; }
        body { background: radial-gradient(circle at 50% 20%, rgba(34, 211, 238, 0.15) 0%, transparent 60%), linear-gradient(135deg, #0a0a0f 0%, #1a0a2e 100%); color: #e0f2fe; font-family: 'Inter', sans-serif; min-height: 100vh; }
        .title-font { font-family: 'Orbitron', sans-serif; }
        .neon-text { text-shadow: 0 0 15px var(--neon-cyan), 0 0 30px var(--neon-cyan); }
        .glass-panel { background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(24px); border: 1px solid rgba(34, 211, 238, 0.3); border-radius: 24px; }
        .btn-neon { background: linear-gradient(135deg, var(--neon-cyan), var(--neon-purple)); color: #000; font-weight: 700; border: none; transition: all 0.3s ease; }
        .nav-link { color: #94a3b8 !important; transition: all 0.3s ease; }
        .nav-link:hover, .nav-link.active { color: var(--neon-cyan) !important; }
        .sidebar { width: 280px; position: fixed; left: 0; top: 0; height: 100vh; overflow-y: auto; z-index: 1000; }
        .main-content { margin-left: 280px; min-height: 100vh; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--dark-bg); }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, var(--neon-cyan), var(--neon-purple)); border-radius: 4px; }
        .stat-card { background: linear-gradient(135deg, rgba(34, 211, 238, 0.1), rgba(192, 38, 211, 0.1)); border: 1px solid rgba(34, 211, 238, 0.2); border-radius: 20px; padding: 1.5rem; transition: all 0.3s ease; }
        .stat-card:hover { transform: scale(1.05); border-color: var(--neon-cyan); box-shadow: 0 0 40px rgba(34, 211, 238, 0.3); }
        .progress-neon { background: rgba(30, 41, 59, 0.8); border-radius: 12px; overflow: hidden; height: 12px; }
        .progress-bar-neon { background: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple)); transition: width 1s ease; position: relative; }
        .progress-bar-neon::after { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent); animation: shimmer 2s infinite; }
        @keyframes shimmer { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }
        .text-gradient { background: linear-gradient(135deg, var(--neon-cyan), var(--neon-purple), var(--neon-pink)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    </style>
</head>
<body>
<?php if (!$is_logged): header("Location: index.php"); exit; endif; ?>

<nav class="sidebar glass-panel border-r border-cyan-400/30">
    <div class="p-8 border-b border-cyan-400/20">
        <h1 class="text-5xl font-bold title-font neon-text tracking-tighter">NEXUS</h1>
        <div class="flex items-center gap-3 mt-4"><div class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></div><span class="text-emerald-400 text-xs font-medium tracking-widest">EN LIGNE</span></div>
    </div>
    <div class="p-6 border-b border-cyan-400/20">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-cyan-400 to-purple-500 flex items-center justify-center text-black font-bold text-lg"><?= strtoupper(substr($_SESSION['email'], 0, 1)) ?></div>
            <div><p class="text-cyan-300 font-medium text-sm"><?= htmlspecialchars($_SESSION['email']) ?></p><p class="text-slate-400 text-xs">Utilisateur Neural</p></div>
        </div>
    </div>
    <div class="p-4">
        <ul class="space-y-1">
            <li><a href="index.php" class="nav-link d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-comments text-xl text-cyan-400"></i><span>Dialogue</span></a></li>
            <li><a href="profile.php" class="nav-link active d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-brain text-xl text-purple-400"></i><span>Profil Neuro</span></a></li>
            <li><a href="projects.php" class="nav-link d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-folder-open text-xl text-green-400"></i><span>Projets</span></a></li>
            <li><a href="notes.php" class="nav-link d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-note-sticky text-xl text-yellow-400"></i><span>Notes</span></a></li>
            <li><a href="analytics.php" class="nav-link d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-chart-line text-xl text-blue-400"></i><span>Analytics</span></a></li>
            <li><a href="settings.php" class="nav-link d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-gear text-xl text-orange-400"></i><span>Paramètres</span></a></li>
        </ul>
    </div>
    <div class="p-6 border-t border-cyan-400/20 mt-auto"><a href="?logout=1" class="d-flex align-items-center gap-3 text-red-400 hover:text-red-300 transition-colors px-4 py-3"><i class="fa-solid fa-power-off"></i><span>DÉCONNEXION</span></a></div>
</nav>

<main class="main-content">
    <header class="glass-panel mx-4 mt-4 p-6 flex items-center justify-between">
        <div><h2 class="text-3xl font-bold title-font text-gradient"><?= $pageTitle ?></h2><p class="text-slate-400 text-sm mt-1"><?= $pageDescription ?></p></div>
        <button onclick="loadPsychoProfile()" class="btn-neon px-6 py-3 rounded-xl"><i class="fa-solid fa-rotate me-2"></i> Rafraîchir</button>
    </header>
    
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Radar Chart -->
            <div class="glass-panel p-8">
                <h3 class="text-2xl font-bold title-font mb-6 flex items-center gap-3"><i class="fa-solid fa-radar text-purple-400"></i> Signature Cognitive</h3>
                <canvas id="psychoChart" class="mx-auto" height="400"></canvas>
            </div>
            
            <!-- Analysis Summary -->
            <div class="glass-panel p-8">
                <h3 class="text-2xl font-bold title-font mb-6 flex items-center gap-3"><i class="fa-solid fa-microscope text-cyan-400"></i> Analyse en Temps Réel</h3>
                <div id="psycho-summary" class="text-lg leading-relaxed text-cyan-100 space-y-4"></div>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mt-6">
            <div class="stat-card text-center">
                <div class="text-4xl font-bold text-cyan-400 mb-2" id="stat-moral">-</div>
                <div class="text-slate-400 text-sm">MORAL</div>
                <div class="progress-neon mt-3"><div class="progress-bar-neon" id="bar-moral" style="width: 0%"></div></div>
            </div>
            <div class="stat-card text-center">
                <div class="text-4xl font-bold text-purple-400 mb-2" id="stat-progression">-</div>
                <div class="text-slate-400 text-sm">PROGRESSION</div>
                <div class="progress-neon mt-3"><div class="progress-bar-neon" id="bar-progression" style="width: 0%"></div></div>
            </div>
            <div class="stat-card text-center">
                <div class="text-4xl font-bold text-green-400 mb-2" id="stat-engagement">-</div>
                <div class="text-slate-400 text-sm">ENGAGEMENT</div>
                <div class="progress-neon mt-3"><div class="progress-bar-neon" id="bar-engagement" style="width: 0%"></div></div>
            </div>
            <div class="stat-card text-center">
                <div class="text-4xl font-bold text-blue-400 mb-2" id="stat-coherence">-</div>
                <div class="text-slate-400 text-sm">COHÉRENCE</div>
                <div class="progress-neon mt-3"><div class="progress-bar-neon" id="bar-coherence" style="width: 0%"></div></div>
            </div>
            <div class="stat-card text-center">
                <div class="text-4xl font-bold text-pink-400 mb-2" id="stat-potentiel">-</div>
                <div class="text-slate-400 text-sm">POTENTIEL</div>
                <div class="progress-neon mt-3"><div class="progress-bar-neon" id="bar-potentiel" style="width: 0%"></div></div>
            </div>
        </div>
        
        <!-- Additional Metrics -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mt-6">
            <div class="stat-card text-center">
                <div class="text-4xl font-bold text-yellow-400 mb-2" id="stat-creativity">-</div>
                <div class="text-slate-400 text-sm">CRÉATIVITÉ</div>
            </div>
            <div class="stat-card text-center">
                <div class="text-4xl font-bold text-indigo-400 mb-2" id="stat-focus">-</div>
                <div class="text-slate-400 text-sm">FOCUS</div>
            </div>
            <div class="stat-card text-center">
                <div class="text-4xl font-bold text-red-400 mb-2" id="stat-resilience">-</div>
                <div class="text-slate-400 text-sm">RÉSILIENCE</div>
            </div>
            <div class="stat-card text-center">
                <div class="text-4xl font-bold text-teal-400 mb-2" id="stat-intuition">-</div>
                <div class="text-slate-400 text-sm">INTUITION</div>
            </div>
            <div class="stat-card text-center">
                <div class="text-4xl font-bold text-orange-400 mb-2" id="stat-adaptation">-</div>
                <div class="text-slate-400 text-sm">ADAPTATION</div>
            </div>
        </div>
    </div>
</main>

<script>
let chartInstance = null;

async function loadPsychoProfile() {
    try {
        const res = await fetch('api.php', { method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: 'action=get_psycho' });
        const data = await res.json();
        
        // Update summary
        document.getElementById('psycho-summary').innerHTML = `
            <div class="glass-panel p-6 rounded-xl border border-cyan-400/30">
                <p class="text-cyan-300 font-semibold mb-3"><i class="fa-solid fa-quote-left me-2"></i>Analyse IA :</p>
                <p>${data.summary || 'Analyse en cours...'}</p>
            </div>
            ${data.recommendations ? `<div class="glass-panel p-6 rounded-xl border border-purple-400/30 mt-4"><p class="text-purple-300 font-semibold mb-3"><i class="fa-solid fa-lightbulb me-2"></i>Recommandations :</p><p>${data.recommendations}</p></div>` : ''}
        `;
        
        // Update stats
        updateStat('moral', data.moral || 50);
        updateStat('progression', data.progression || 50);
        updateStat('engagement', data.engagement || 50);
        updateStat('coherence', data.coherence || 50);
        updateStat('potentiel', data.potentiel || 50);
        updateStat('creativity', data.creativity || 50);
        updateStat('focus', data.focus || 50);
        updateStat('resilience', data.resilience || 50);
        updateStat('intuition', data.intuition || 50);
        updateStat('adaptation', data.adaptation || 50);
        
        // Update radar chart
        const ctx = document.getElementById('psychoChart');
        if (chartInstance) chartInstance.destroy();
        
        chartInstance = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Moral', 'Progression', 'Engagement', 'Cohérence', 'Potentiel', 'Adaptation', 'Créativité', 'Focus', 'Résilience', 'Intuition'],
                datasets: [{
                    label: 'Niveau Neuro-Cognitif',
                    data: [data.moral||50, data.progression||50, data.engagement||50, data.coherence||50, data.potentiel||50, data.adaptation||50, data.creativity||50, data.focus||50, data.resilience||50, data.intuition||50],
                    backgroundColor: 'rgba(34, 211, 238, 0.2)',
                    borderColor: '#22d3ee',
                    borderWidth: 3,
                    pointBackgroundColor: '#c026d3',
                    pointBorderColor: '#fff',
                    pointRadius: 6
                }]
            },
            options: {
                scales: {
                    r: { 
                        min: 0, max: 100, 
                        ticks: { stepSize: 20, color: '#94a3b8' },
                        grid: { color: 'rgba(34, 211, 238, 0.2)' },
                        angleLines: { color: 'rgba(34, 211, 238, 0.2)' },
                        pointLabels: { color: '#e0f2fe', font: { size: 12 } }
                    }
                },
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.95)',
                        titleColor: '#22d3ee',
                        bodyColor: '#e0f2fe',
                        borderColor: 'rgba(34, 211, 238, 0.3)',
                        borderWidth: 1
                    }
                }
            }
        });
    } catch(e) { console.error('Error:', e); }
}

function updateStat(name, value) {
    document.getElementById('stat-' + name).textContent = value + '%';
    const bar = document.getElementById('bar-' + name);
    if (bar) bar.style.width = value + '%';
}

document.addEventListener('DOMContentLoaded', loadPsychoProfile);
</script>
</body>
</html>
