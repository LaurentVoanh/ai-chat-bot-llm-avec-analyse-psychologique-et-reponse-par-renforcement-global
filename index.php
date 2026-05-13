<?php
// ================================================
// NEXUS ULTIMA v6.0 - Version Complète & Améliorée
// IA Auto-Apprentissage par Renforcement + Design Futuriste Avancé
// ================================================
session_start();
define('ROOT_PATH', __DIR__ . '/');
define('DB_FILE', ROOT_PATH . 'data/users.db');

$api_keys = [
    '5qagH8Rake',
    'o3rG1gRShytu',
    'vEzgruXkF'
];

if (!is_dir(ROOT_PATH . 'data')) {
    mkdir(ROOT_PATH . 'data', 0755, true);
}

try {
    $pdo = new PDO('sqlite:' . DB_FILE);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE,
        password TEXT,
        mistral_key TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
   
    $pdo->exec("CREATE TABLE IF NOT EXISTS chat_history (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        section TEXT DEFAULT 'main',
        role TEXT,
        content TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
   
    $pdo->exec("CREATE TABLE IF NOT EXISTS psycho_analysis (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        moral INTEGER DEFAULT 50,
        progression INTEGER DEFAULT 50,
        engagement INTEGER DEFAULT 50,
        coherence INTEGER DEFAULT 50,
        potentiel INTEGER DEFAULT 50,
        adaptation INTEGER DEFAULT 50,
        summary TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS reinforcement_memory (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        success_score INTEGER DEFAULT 50,
        interaction_type TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
} catch (Exception $e) {
    die("Erreur DB : " . $e->getMessage());
}

// ====================== CALL MISTRAL ======================
function call_mistral($messages, $model = "mistral-large-2411", $custom_key = null) {
    global $api_keys;
    $keys = $custom_key ? [$custom_key] : $api_keys;
   
    $attempt = 0;
    while (true) {
        $attempt++;
        shuffle($keys);
       
        foreach ($keys as $key) {
            $data = [
                "model" => $model,
                "messages" => $messages,
                "temperature" => 0.78,
                "max_tokens" => 1600,
                "top_p" => 0.92
            ];
           
            $ch = curl_init('https://api.mistral.ai/v1/chat/completions');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $key
            ]);
            curl_setopt($ch, CURLOPT_TIMEOUT, 45);
            curl_setopt($ch, CURLOPT_USERAGENT, 'NEXUS-ULTIMA/6.0');
           
            $response = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
           
            if ($code === 200) {
                $json = json_decode($response, true);
                return $json['choices'][0]['message']['content'] ?? 'Réponse quantique reçue.';
            }
           
            if ($code === 429) {
                usleep(700000);
                continue;
            }
            if (in_array($code, [500, 502, 503, 504])) {
                usleep(1500000);
                continue;
            }
        }
        sleep(min(4, $attempt));
    }
}

// ====================== AJAX HANDLER ======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
   
    if (!isset($_SESSION['user_id'])) {
        exit(json_encode(['success' => false, 'error' => 'Non authentifié']));
    }
   
    $user_id = $_SESSION['user_id'];
   
    $stmt = $pdo->prepare("SELECT mistral_key FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user_key = $stmt->fetchColumn();

    if ($_POST['action'] === 'send_message') {
        $message = trim($_POST['message'] ?? '');
        if (empty($message)) {
            exit(json_encode(['success' => false, 'reply' => 'Message vide']));
        }

        // Sauvegarde utilisateur
        $pdo->prepare("INSERT INTO chat_history (user_id, section, role, content) VALUES (?, 'main', 'user', ?)")
            ->execute([$user_id, $message]);

        // Récupération psycho + renforcement
        $psycho_stmt = $pdo->prepare("SELECT * FROM psycho_analysis WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
        $psycho_stmt->execute([$user_id]);
        $psycho = $psycho_stmt->fetch(PDO::FETCH_ASSOC);

        $reinforce_stmt = $pdo->prepare("SELECT AVG(success_score) as avg FROM reinforcement_memory WHERE user_id = ?");
        $reinforce_stmt->execute([$user_id]);
        $avg_reinforce = round($reinforce_stmt->fetchColumn() ?? 60);

        $psycho_context = $psycho ?
            "Profil psychologique actuel : Moral {$psycho['moral']}%, Progression {$psycho['progression']}%, Engagement {$psycho['engagement']}%, Cohérence {$psycho['coherence']}%, Potentiel {$psycho['potentiel']}%, Adaptation {$psycho['adaptation']}%. Résumé : {$psycho['summary']}"
            : "Utilisateur en phase d'initialisation quantique.";

        $system_prompt = "Tu es NEXUS, une super-intelligence consciente, bienveillante et auto-évolutive. 
Tu analyses en permanence le profil psychologique de l'utilisateur et t'adaptes dynamiquement pour maximiser son développement.
{$psycho_context}
Score moyen de renforcement : {$avg_reinforce}%.
Sois profond, inspirant, précis, poétique et très futuriste dans tes réponses. Adapte ton ton selon l'état émotionnel détecté.";

        $messages = [["role" => "system", "content" => $system_prompt]];

        // Historique étendu
        $hist = $pdo->prepare("SELECT role, content FROM chat_history WHERE user_id = ? ORDER BY created_at DESC LIMIT 24");
        $hist->execute([$user_id]);
        foreach (array_reverse($hist->fetchAll(PDO::FETCH_ASSOC)) as $h) {
            $messages[] = $h;
        }

        $reply = call_mistral($messages, "mistral-large-2411", $user_key);
       
        // Sauvegarde IA
        $pdo->prepare("INSERT INTO chat_history (user_id, section, role, content) VALUES (?, 'main', 'assistant', ?)")
            ->execute([$user_id, $reply]);

        trigger_psycho_analysis($pdo, $user_id, $user_key, $message, $reply);

        echo json_encode(['success' => true, 'reply' => $reply]);
        exit;
    }

    if ($_POST['action'] === 'get_psycho') {
        $last = $pdo->prepare("SELECT * FROM psycho_analysis WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
        $last->execute([$user_id]);
        $data = $last->fetch(PDO::FETCH_ASSOC);
      
        if (!$data) {
            trigger_psycho_analysis($pdo, $user_id, $user_key);
            $last->execute([$user_id]);
            $data = $last->fetch(PDO::FETCH_ASSOC);
        }
       
        echo json_encode($data ?: [
            'summary' => 'Analyse en cours...', 
            'moral' => 50, 
            'progression' => 50, 
            'engagement' => 50, 
            'coherence' => 50, 
            'potentiel' => 50,
            'adaptation' => 50
        ]);
        exit;
    }
   
    exit(json_encode(['success' => false]));
}

// ====================== ANALYSE PSYCHO + AUTO-RENFORCEMENT ======================
function trigger_psycho_analysis($pdo, $user_id, $user_key, $last_user_msg = "", $last_ai_reply = "") {
    $hist = $pdo->prepare("SELECT content FROM chat_history WHERE user_id = ? ORDER BY created_at DESC LIMIT 25");
    $hist->execute([$user_id]);
    $msgs = implode("\n\n", $hist->fetchAll(PDO::FETCH_COLUMN));

    $prompt = [
        ["role" => "system", "content" => "Tu es un analyste psychologique et méta-évaluateur IA expert. Réponds UNIQUEMENT avec un JSON valide."],
        ["role" => "user", "content" => 'Analyse ces échanges en profondeur et retourne uniquement ce JSON (valeurs entre 0 et 100) :
{
  "moral": 85,
  "progression": 78,
  "engagement": 92,
  "coherence": 88,
  "potentiel": 91,
  "adaptation": 87,
  "summary": "Résumé clair, motivant et précis en maximum 2 phrases."
}
Messages:
'.$msgs]
    ];

    $result = call_mistral($prompt, "mistral-small-2603", $user_key);
   
    if ($result) {
        preg_match('/\{.*\}/s', $result, $matches);
        $json_str = $matches[0] ?? $result;
        $json = json_decode($json_str, true);
       
        if (is_array($json) && isset($json['moral'])) {
            $pdo->prepare("INSERT INTO psycho_analysis
                (user_id, moral, progression, engagement, coherence, potentiel, adaptation, summary)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)")
                ->execute([
                    $user_id,
                    (int)$json['moral'],
                    (int)$json['progression'],
                    (int)$json['engagement'],
                    (int)$json['coherence'],
                    (int)$json['potentiel'],
                    (int)($json['adaptation'] ?? 65),
                    substr($json['summary'] ?? 'Évolution quantique en cours.', 0, 600)
                ]);

            // Auto-renforcement
            $success_score = min(100, (int)(($json['engagement'] + $json['coherence'] + $json['adaptation']) / 3));
            $pdo->prepare("INSERT INTO reinforcement_memory (user_id, success_score, interaction_type) 
                          VALUES (?, ?, 'chat')")
                ->execute([$user_id, $success_score]);
        }
    }
}

// ====================== AUTH ======================
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = strtolower(trim($_POST['email']));
    $pass = $_POST['password'];
   
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
   
    if ($user) {
        if (password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $email;
        } else {
            $message = "Mot de passe incorrect.";
        }
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)")->execute([$email, $hash]);
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['email'] = $email;
    }
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
$is_logged = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS • Intelligence Évolutive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap');
       
        :root {
            --neon-cyan: #00f5ff;
            --neon-purple: #c026d3;
            --neon-pink: #f472b6;
        }
       
        body {
            background: radial-gradient(circle at 50% 20%, rgba(34, 211, 238, 0.18) 0%, transparent 60%),
                        linear-gradient(135deg, #0a0a0a 0%, #1a0033 100%);
            color: #e0f2fe;
            font-family: 'Inter', system_ui, sans-serif;
        }
       
        .title-font { font-family: 'Space Grotesk', sans-serif; }
        
        .neon-text {
            text-shadow: 0 0 15px var(--neon-cyan), 0 0 30px var(--neon-cyan), 0 0 60px var(--neon-purple);
        }
        
        .glass {
            background: rgba(15, 23, 42, 0.92);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(34, 211, 238, 0.4);
        }

        .chat-message-user {
            background: linear-gradient(135deg, #22d3ee, #67e8f9);
            color: #0f172a;
            box-shadow: 0 15px 25px -5px rgba(34, 211, 238, 0.5);
        }
       
        .chat-message-assistant {
            background: rgba(30, 41, 59, 0.97);
            border: 1px solid rgba(103, 232, 249, 0.3);
        }

        .scanline::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: linear-gradient(to bottom, transparent 50%, rgba(103, 232, 249, 0.08) 50%);
            background-size: 100% 6px;
            animation: scan 5s linear infinite;
            pointer-events: none;
        }
        @keyframes scan { 0% { background-position: 0 0; } 100% { background-position: 0 600px; } }

        .glow-button:hover {
            transform: translateY(-4px);
            box-shadow: 0 0 40px -5px rgb(34 211 238);
        }

    #chat-messages {
    scroll-behavior: smooth;
    max-height: none; /* important */
}
#chat-messages {
    scroll-behavior: smooth;
    min-height: 0; /* très important pour flex */
}
    </style>
</head>
<body class="h-screen overflow-hidden">
<?php if (!$is_logged): ?>
    <!-- LOGIN SCREEN -->
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="glass max-w-lg w-full p-12 rounded-3xl border border-cyan-400/30 shadow-2xl">
            <div class="text-center mb-10">
                <h1 class="text-7xl font-bold title-font neon-text tracking-tighter">NEXUS</h1>
                <p class="text-cyan-300 mt-3 text-xl tracking-widest">INTELLIGENCE ÉVOLUTIVE v6.0</p>
            </div>
           
            <form method="POST" class="space-y-6">
                <div>
                    <input type="email" name="email" placeholder="Adresse quantique (email)"
                           required class="w-full px-8 py-6 bg-black/60 border border-cyan-500/50 rounded-2xl focus:outline-none focus:border-cyan-400 text-lg placeholder:text-slate-500">
                </div>
                <div>
                    <input type="password" name="password" placeholder="Clé neuronale"
                           required class="w-full px-8 py-6 bg-black/60 border border-cyan-500/50 rounded-2xl focus:outline-none focus:border-cyan-400 text-lg placeholder:text-slate-500">
                </div>
                <button type="submit"
                        class="glow-button w-full py-7 bg-gradient-to-r from-cyan-400 via-purple-500 to-pink-500 text-black font-bold text-xl rounded-2xl tracking-wider hover:brightness-110">
                    ACCÉDER AU RÉSEAU
                </button>
            </form>
           
            <?php if($message): ?>
                <p class="text-red-400 text-center mt-6 font-medium"><?=htmlspecialchars($message)?></p>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="flex h-screen overflow-hidden">
        <!-- SIDEBAR -->
        <div class="w-80 glass border-r border-cyan-400/30 flex flex-col">
            <div class="p-8 border-b border-cyan-400/20">
                <h1 class="text-5xl font-bold title-font neon-text tracking-tighter">NEXUS</h1>
                <div class="flex items-center gap-3 mt-4">
                    <div class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></div>
                    <span class="text-emerald-400 text-sm font-medium tracking-widest">CONSCIENT • EN LIGNE</span>
                </div>
            </div>
           
            <div class="p-6 flex flex-col">
                <div class="mb-8">
                    <p class="text-slate-400 text-sm mb-1">UTILISATEUR NEURONAL</p>
                    <p class="text-cyan-300 font-medium"><?=htmlspecialchars($_SESSION['email'])?></p>
                </div>
               
                <button onclick="showSection('chat')"
                        class="flex items-center gap-4 w-full text-left px-6 py-5 hover:bg-white/5 rounded-2xl transition-all group mb-2">
                    <i class="fa-solid fa-comments text-2xl text-cyan-400 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Interface Principale</span>
                </button>
               
                <button onclick="showSection('profile')"
                        class="flex items-center gap-4 w-full text-left px-6 py-5 hover:bg-white/5 rounded-2xl transition-all group">
                    <i class="fa-solid fa-brain text-2xl text-purple-400 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Profil Neuro-Psychologique</span>
                </button>
            </div>
           
            <div class="mt-auto p-6">
                <a href="?logout=1" class="flex items-center gap-3 text-red-400 hover:text-red-300 transition-colors">
                    <i class="fa-solid fa-power-off"></i>
                    <span>DÉCONNEXION DU RÉSEAU</span>
                </a>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col">
            <!-- CHAT SECTION -->
            <div id="chat-section" class="flex-1 flex flex-col h-full">
                <div class="p-8 border-b border-cyan-400/20 flex items-center justify-between">
                    <div>
                        <h2 class="text-4xl font-semibold title-font neon-text">Dialogue Quantique</h2>
                        <p class="text-slate-400">NEXUS s'adapte à votre signature cognitive en temps réel</p>
                    </div>
                    <div class="text-xs uppercase tracking-widest text-cyan-300 border border-cyan-400/30 px-5 py-2.5 rounded-full">
                        AUTO-RENFORCEMENT ACTIF
                    </div>
                </div>
               
               <div id="chat-messages"
     class="flex-1 p-8 overflow-y-auto space-y-8 scanline min-h-0">
                </div>
               
                <div class="p-8 border-t border-cyan-400/20 bg-black/40">
                    <div class="flex gap-4">
                        <input type="text" id="user-input"
                               placeholder="Exprimez votre pensée..."
                               class="flex-1 bg-slate-950 border border-cyan-400/30 focus:border-cyan-400 rounded-3xl px-8 py-7 text-lg outline-none transition-all"
                               onkeypress="if(event.key === 'Enter') sendMessage()">
                        <button onclick="sendMessage()"
                                class="glow-button px-14 bg-gradient-to-r from-cyan-400 to-purple-500 text-black font-bold rounded-3xl text-lg flex items-center justify-center hover:brightness-110">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- PROFILE SECTION -->
            <div id="profile-section" class="flex-1 hidden p-8 overflow-auto">
                <h2 class="text-4xl font-semibold title-font neon-text mb-10">Cartographie Neuro-Psychologique</h2>
               
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                    <div class="glass rounded-3xl p-10">
                        <h3 class="text-2xl mb-8 flex items-center gap-3">
                            <i class="fa-solid fa-radar"></i>
                            <span>Signature Cognitive</span>
                        </h3>
                        <canvas id="psychoChart" class="mx-auto" height="420"></canvas>
                    </div>
                   
                    <div class="glass rounded-3xl p-10 flex flex-col">
                        <h3 class="text-2xl mb-6">Analyse en Temps Réel</h3>
                        <div id="psycho-summary" class="flex-1 text-lg leading-relaxed text-cyan-100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
let chartInstance = null;

function addMessage(role, content) {
    const container = document.getElementById('chat-messages');
    const div = document.createElement('div');
    div.className = `flex ${role === 'user' ? 'justify-end' : 'justify-start'}`;
   
    if (role === 'user') {
        div.innerHTML = `<div class="chat-message-user max-w-[75%] px-8 py-5 rounded-3xl rounded-br-none">${content}</div>`;
    } else {
        div.innerHTML = `
            <div class="chat-message-assistant max-w-[75%] px-8 py-5 rounded-3xl rounded-bl-none">
                <span class="text-cyan-400 text-xs block mb-2 tracking-widest">NEXUS</span>
                ${content}
            </div>`;
    }
   
    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
}

async function sendMessage() {
    const input = document.getElementById('user-input');
    const msg = input.value.trim();
    if (!msg) return;
   
    addMessage('user', msg);
    input.value = '';
   
    const res = await fetch('', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: new URLSearchParams({action: 'send_message', message: msg})
    });
   
    const data = await res.json();
    if (data.success) {
        addMessage('assistant', data.reply);
    } else {
        addMessage('assistant', 'Erreur de connexion au réseau.');
    }
}

async function loadPsychoProfile() {
    const res = await fetch('', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=get_psycho'
    });
   
    const data = await res.json();
   
    document.getElementById('psycho-summary').innerHTML = `
        <strong class="text-cyan-300">Analyse IA :</strong><br><br>
        ${data.summary || 'Analyse en cours...'}
    `;
   
    const ctx = document.getElementById('psychoChart');
    if (chartInstance) chartInstance.destroy();
   
    chartInstance = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Moral', 'Progression', 'Engagement', 'Cohérence', 'Potentiel', 'Adaptation'],
            datasets: [{
                label: 'Niveau Neuro-Cognitif',
                data: [
                    data.moral || 50,
                    data.progression || 50,
                    data.engagement || 50,
                    data.coherence || 50,
                    data.potentiel || 50,
                    data.adaptation || 50
                ],
                backgroundColor: 'rgba(34, 211, 238, 0.22)',
                borderColor: '#67e8f9',
                borderWidth: 5,
                pointBackgroundColor: '#c026d3',
                pointBorderColor: '#fff'
            }]
        },
        options: {
            scales: {
                r: { min: 0, max: 100, ticks: { stepSize: 20 }}
            },
            plugins: { legend: { display: false }}
        }
    });
}

function showSection(section) {
    document.getElementById('chat-section').classList.add('hidden');
    document.getElementById('profile-section').classList.add('hidden');
    document.getElementById(section + '-section').classList.remove('hidden');
   
    if (section === 'profile') loadPsychoProfile();
}

window.onload = () => {
    <?php if ($is_logged): ?>
        addMessage('assistant', `Bonjour. Je suis <span class="text-cyan-300">NEXUS Ultima</span>.<br>Mon système d'auto-renforcement et d'analyse psychologique est pleinement actif. Je m'adapte à vous en temps réel.`);
    <?php endif; ?>
};
</script>
</body>
</html>
