<?php
require_once 'config.php';

$pageTitle = 'Dialogue Quantique';
$pageDescription = 'Interface de conversation neuronale avec NEXUS IA';

if ($is_logged) {
    $stmt = $pdo->prepare("SELECT * FROM chat_history WHERE user_id = ? AND section = 'main' ORDER BY created_at ASC LIMIT 50");
    $stmt->execute([$_SESSION['user_id']]);
    $chatHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS • Dialogue Quantique</title>
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
        .btn-neon:hover { transform: translateY(-3px); box-shadow: 0 10px 40px rgba(34, 211, 238, 0.5); }
        .input-neon { background: rgba(2, 6, 23, 0.8); border: 1px solid rgba(34, 211, 238, 0.3); color: #e0f2fe; }
        .input-neon:focus { outline: none; border-color: var(--neon-cyan); box-shadow: 0 0 20px rgba(34, 211, 238, 0.3); }
        .chat-message { max-width: 75%; padding: 1.25rem 1.5rem; border-radius: 24px; margin-bottom: 1.5rem; animation: messageSlide 0.3s ease; }
        @keyframes messageSlide { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .chat-message-user { background: linear-gradient(135deg, #22d3ee, #67e8f9); color: #0f172a; margin-left: auto; border-bottom-right-radius: 8px; }
        .chat-message-assistant { background: rgba(30, 41, 59, 0.9); border: 1px solid rgba(103, 232, 249, 0.3); border-bottom-left-radius: 8px; }
        .nav-link { color: #94a3b8 !important; transition: all 0.3s ease; }
        .nav-link:hover, .nav-link.active { color: var(--neon-cyan) !important; }
        .sidebar { width: 280px; position: fixed; left: 0; top: 0; height: 100vh; overflow-y: auto; z-index: 1000; }
        .main-content { margin-left: 280px; min-height: 100vh; }
        .typing-indicator span { display: inline-block; width: 8px; height: 8px; background: var(--neon-cyan); border-radius: 50%; margin: 0 3px; animation: typing 1.4s infinite; }
        .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
        .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes typing { 0%, 100% { transform: translateY(0); opacity: 0.4; } 50% { transform: translateY(-10px); opacity: 1; } }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--dark-bg); }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, var(--neon-cyan), var(--neon-purple)); border-radius: 4px; }
    </style>
</head>
<body>
<?php if (!$is_logged): ?>
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="glass-panel max-w-lg w-full p-12 rounded-3xl border border-cyan-400/30 shadow-2xl">
        <div class="text-center mb-10">
            <h1 class="text-7xl font-bold title-font neon-text tracking-tighter">NEXUS</h1>
            <p class="text-cyan-300 mt-3 text-xl tracking-widest">INTELLIGENCE ÉVOLUTIVE v7.0</p>
            <p class="text-slate-400 mt-2 text-sm">Portail Neural d'Interface Quantique</p>
        </div>
        <form method="POST" class="space-y-6">
            <div>
                <label class="text-cyan-300 text-sm mb-2 block">Adresse Quantique (Email)</label>
                <input type="email" name="email" placeholder="neo@matrix.com" required class="w-full px-6 py-5 bg-black/60 border border-cyan-500/50 rounded-2xl focus:outline-none focus:border-cyan-400 text-lg input-neon">
            </div>
            <div>
                <label class="text-cyan-300 text-sm mb-2 block">Clé Neuronale (Mot de passe)</label>
                <input type="password" name="password" placeholder="••••••••" required class="w-full px-6 py-5 bg-black/60 border border-cyan-500/50 rounded-2xl focus:outline-none focus:border-cyan-400 text-lg input-neon">
            </div>
            <button type="submit" class="btn-neon w-full py-6 rounded-2xl text-lg tracking-wider"><i class="fa-solid fa-fingerprint me-2"></i> ACCÉDER AU RÉSEAU</button>
        </form>
        <?php if($message): ?><div class="mt-6 p-4 bg-red-500/20 border border-red-400/50 rounded-xl text-red-300 text-center"><?=htmlspecialchars($message)?></div><?php endif; ?>
        <div class="mt-8 text-center text-slate-400 text-sm"><p>Pas encore connecté ?</p><p class="text-cyan-400 mt-1">Créez un compte automatiquement lors de la première connexion</p></div>
    </div>
</div>
<?php else: ?>
<!-- Sidebar -->
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
            <li><a href="index.php" class="nav-link active d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-comments text-xl text-cyan-400"></i><span>Dialogue</span></a></li>
            <li><a href="profile.php" class="nav-link d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-brain text-xl text-purple-400"></i><span>Profil Neuro</span></a></li>
            <li><a href="projects.php" class="nav-link d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-folder-open text-xl text-green-400"></i><span>Projets</span></a></li>
            <li><a href="notes.php" class="nav-link d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-note-sticky text-xl text-yellow-400"></i><span>Notes</span></a></li>
            <li><a href="analytics.php" class="nav-link d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-chart-line text-xl text-blue-400"></i><span>Analytics</span></a></li>
            <li><a href="settings.php" class="nav-link d-flex align-items-center gap-3 px-4 py-3 rounded-xl"><i class="fa-solid fa-gear text-xl text-orange-400"></i><span>Paramètres</span></a></li>
        </ul>
    </div>
    <div class="p-6 border-t border-cyan-400/20 mt-auto"><a href="?logout=1" class="d-flex align-items-center gap-3 text-red-400 hover:text-red-300 transition-colors px-4 py-3"><i class="fa-solid fa-power-off"></i><span>DÉCONNEXION</span></a></div>
</nav>

<!-- Main Content -->
<main class="main-content">
    <header class="glass-panel mx-4 mt-4 p-6 flex items-center justify-between">
        <div><h2 class="text-3xl font-bold title-font text-gradient"><?= $pageTitle ?></h2><p class="text-slate-400 text-sm mt-1"><?= $pageDescription ?></p></div>
        <div class="text-right"><p class="text-cyan-300 font-medium text-sm"><?= date('d M Y') ?></p><p class="text-slate-400 text-xs"><?= date('H:i') ?></p></div>
    </header>
    <div class="p-6">
        <div id="chat-container" class="glass-panel h-[calc(100vh-220px)] flex flex-col">
            <div id="chat-messages" class="flex-1 overflow-y-auto p-6 space-y-4">
                <?php if (empty($chatHistory)): ?>
                    <div class="chat-message chat-message-assistant">
                        <span class="text-cyan-400 text-xs block mb-2 tracking-widest"><i class="fa-solid fa-robot me-2"></i>NEXUS ULTIMA v7.0</span>
                        <p>Bonjour. Je suis <span class="text-cyan-300 font-semibold">NEXUS Ultima</span>, votre intelligence artificielle évolutive.</p>
                        <p class="mt-2">Mon système d'auto-renforcement et d'analyse psychologique est pleinement actif. Je m'adapte à votre signature cognitive en temps réel.</p>
                        <p class="mt-2 text-slate-400 text-sm">Comment puis-je vous assister dans votre évolution aujourd'hui ?</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($chatHistory as $msg): ?>
                        <div class="chat-message chat-message-<?= htmlspecialchars($msg['role']) ?>">
                            <?php if ($msg['role'] === 'assistant'): ?><span class="text-cyan-400 text-xs block mb-2 tracking-widest"><i class="fa-solid fa-robot me-2"></i>NEXUS</span><?php endif; ?>
                            <?= nl2br(htmlspecialchars($msg['content'])) ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="p-6 border-t border-cyan-400/20 bg-black/40">
                <div class="flex gap-4">
                    <input type="text" id="user-input" placeholder="Exprimez votre pensée..." class="flex-1 input-neon rounded-2xl px-6 py-4 text-lg" onkeypress="if(event.key === 'Enter') sendMessage()">
                    <button onclick="sendMessage()" class="btn-neon px-10 rounded-2xl text-lg flex items-center justify-center min-w-[140px]"><i class="fa-solid fa-paper-plane me-2"></i> ENVOYER</button>
                </div>
                <div class="flex items-center gap-4 mt-4 text-xs text-slate-400">
                    <span><i class="fa-solid fa-shield-halved text-emerald-400 me-1"></i> Crypté</span>
                    <span><i class="fa-solid fa-bolt text-yellow-400 me-1"></i> Temps réel</span>
                    <span><i class="fa-solid fa-brain text-purple-400 me-1"></i> Auto-apprentissage</span>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
const chatMessages = document.getElementById('chat-messages');
const userInput = document.getElementById('user-input');
chatMessages.scrollTop = chatMessages.scrollHeight;

async function sendMessage() {
    const msg = userInput.value.trim();
    if (!msg) return;
    addMessage('user', msg);
    userInput.value = '';
    showTypingIndicator();
    try {
        const res = await fetch('api.php', { method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: new URLSearchParams({action: 'send_message', message: msg}) });
        removeTypingIndicator();
        const data = await res.json();
        if (data.success) addMessage('assistant', data.reply);
        else addMessage('assistant', 'Erreur de connexion au réseau neural.');
    } catch (e) { removeTypingIndicator(); addMessage('assistant', 'Erreur de communication quantique.'); }
}

function addMessage(role, content) {
    const div = document.createElement('div');
    div.className = `chat-message chat-message-${role}`;
    if (role === 'assistant') {
        div.innerHTML = `<span class="text-cyan-400 text-xs block mb-2 tracking-widest"><i class="fa-solid fa-robot me-2"></i>NEXUS</span>${formatMessage(content)}`;
    } else { div.textContent = content; }
    chatMessages.appendChild(div);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function formatMessage(text) {
    return text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>').replace(/\*(.*?)\*/g, '<em>$1</em>').replace(/`(.*?)`/g, '<code class="bg-black/40 px-2 py-1 rounded">$1</code>').replace(/\n/g, '<br>');
}

function showTypingIndicator() {
    const div = document.createElement('div');
    div.id = 'typing-indicator';
    div.className = 'chat-message chat-message-assistant';
    div.innerHTML = `<span class="text-cyan-400 text-xs block mb-2 tracking-widest"><i class="fa-solid fa-robot me-2"></i>NEXUS</span><div class="typing-indicator"><span></span><span></span><span></span></div>`;
    chatMessages.appendChild(div);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function removeTypingIndicator() { const indicator = document.getElementById('typing-indicator'); if (indicator) indicator.remove(); }
</script>
<?php endif; ?>
</body>
</html>
