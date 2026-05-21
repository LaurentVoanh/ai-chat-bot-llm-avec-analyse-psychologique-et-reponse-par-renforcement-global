<?php
// ================================================
// NEXUS ULTIMA v7.0 - Configuration Centrale
// Portail Complet Multi-Pages - Design 2advanced Futuriste
// ================================================

session_start();
define('ROOT_PATH', __DIR__ . '/');
define('DB_FILE', ROOT_PATH . 'data/nexus.db');

// Clés API Mistral (rotation automatique)
$api_keys = [
    '5qagH8Rake',
    'o3rG1gRShytu', 
    'vEzgruXkF'
];

// Création du dossier data si inexistant
if (!is_dir(ROOT_PATH . 'data')) {
    mkdir(ROOT_PATH . 'data', 0755, true);
}

// Connexion SQLite
try {
    $pdo = new PDO('sqlite:' . DB_FILE);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Table utilisateurs
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE,
        password TEXT,
        mistral_key TEXT,
        avatar TEXT DEFAULT 'default',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        last_login DATETIME,
        total_interactions INTEGER DEFAULT 0,
        level INTEGER DEFAULT 1,
        experience INTEGER DEFAULT 0
    )");
    
    // Historique chat
    $pdo->exec("CREATE TABLE IF NOT EXISTS chat_history (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        section TEXT DEFAULT 'main',
        role TEXT,
        content TEXT,
        sentiment_score INTEGER DEFAULT 50,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Analyse psycho
    $pdo->exec("CREATE TABLE IF NOT EXISTS psycho_analysis (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        moral INTEGER DEFAULT 50,
        progression INTEGER DEFAULT 50,
        engagement INTEGER DEFAULT 50,
        coherence INTEGER DEFAULT 50,
        potentiel INTEGER DEFAULT 50,
        adaptation INTEGER DEFAULT 50,
        creativity INTEGER DEFAULT 50,
        focus INTEGER DEFAULT 50,
        resilience INTEGER DEFAULT 50,
        intuition INTEGER DEFAULT 50,
        summary TEXT,
        recommendations TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Mémoire de renforcement
    $pdo->exec("CREATE TABLE IF NOT EXISTS reinforcement_memory (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        success_score INTEGER DEFAULT 50,
        interaction_type TEXT,
        feedback_positive INTEGER DEFAULT 0,
        feedback_negative INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Projects/Goals
    $pdo->exec("CREATE TABLE IF NOT EXISTS projects (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        title TEXT,
        description TEXT,
        status TEXT DEFAULT 'active',
        progress INTEGER DEFAULT 0,
        priority TEXT DEFAULT 'medium',
        deadline DATETIME,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Notes/Knowledge Base
    $pdo->exec("CREATE TABLE IF NOT EXISTS notes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        title TEXT,
        content TEXT,
        tags TEXT,
        category TEXT DEFAULT 'general',
        is_favorite INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Activities Log
    $pdo->exec("CREATE TABLE IF NOT EXISTS activity_log (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        action TEXT,
        details TEXT,
        ip_address TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Notifications
    $pdo->exec("CREATE TABLE IF NOT EXISTS notifications (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        title TEXT,
        message TEXT,
        type TEXT DEFAULT 'info',
        is_read INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
} catch (Exception $e) {
    die("Erreur DB : " . $e->getMessage());
}

// Fonction utilitaire pour logs d'activité
function log_activity($pdo, $user_id, $action, $details = '') {
    $stmt = $pdo->prepare("INSERT INTO activity_log (user_id, action, details, ip_address) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $action, $details, $_SERVER['REMOTE_ADDR'] ?? 'unknown']);
}

// ====================== CALL MISTRAL AI ======================
function call_mistral($messages, $model = "mistral-large-2411", $custom_key = null) {
    global $api_keys;
    $keys = $custom_key ? [$custom_key] : $api_keys;
    
    $attempt = 0;
    while ($attempt < 10) {
        $attempt++;
        shuffle($keys);
        
        foreach ($keys as $key) {
            $data = [
                "model" => $model,
                "messages" => $messages,
                "temperature" => 0.78,
                "max_tokens" => 2000,
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
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_USERAGENT, 'NEXUS-ULTIMA/7.0');
            
            $response = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if ($code === 200) {
                $json = json_decode($response, true);
                return $json['choices'][0]['message']['content'] ?? 'Réponse quantique reçue.';
            }
            
            if ($code === 429) {
                usleep(800000);
                continue;
            }
            if (in_array($code, [500, 502, 503, 504])) {
                usleep(2000000);
                continue;
            }
        }
        sleep(min(5, $attempt * 2));
    }
    return "Erreur de connexion au réseau neural.";
}

// ====================== ANALYSE PSYCHO + RENFORCEMENT ======================
function trigger_psycho_analysis($pdo, $user_id, $user_key, $last_user_msg = "", $last_ai_reply = "") {
    $hist = $pdo->prepare("SELECT content FROM chat_history WHERE user_id = ? ORDER BY created_at DESC LIMIT 30");
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
  "creativity": 82,
  "focus": 79,
  "resilience": 84,
  "intuition": 86,
  "summary": "Résumé clair, motivant et précis en maximum 3 phrases.",
  "recommendations": "2-3 recommandations personnalisées sous forme de liste."
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
                (user_id, moral, progression, engagement, coherence, potentiel, adaptation, 
                 creativity, focus, resilience, intuition, summary, recommendations)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")
                ->execute([
                    $user_id,
                    (int)$json['moral'],
                    (int)$json['progression'],
                    (int)$json['engagement'],
                    (int)$json['coherence'],
                    (int)$json['potentiel'],
                    (int)($json['adaptation'] ?? 65),
                    (int)($json['creativity'] ?? 70),
                    (int)($json['focus'] ?? 70),
                    (int)($json['resilience'] ?? 70),
                    (int)($json['intuition'] ?? 70),
                    substr($json['summary'] ?? 'Évolution quantique en cours.', 0, 800),
                    substr($json['recommendations'] ?? 'Continuez votre exploration.', 0, 500)
                ]);

            $success_score = min(100, (int)(($json['engagement'] + $json['coherence'] + $json['adaptation']) / 3));
            $pdo->prepare("INSERT INTO reinforcement_memory (user_id, success_score, interaction_type) 
                          VALUES (?, ?, 'chat')")
                ->execute([$user_id, $success_score]);
            
            $pdo->prepare("UPDATE users SET total_interactions = total_interactions + 1, 
                          experience = experience + 10 WHERE id = ?")
                ->execute([$user_id]);
        }
    }
}

// ====================== AUTHENTIFICATION ======================
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
            $pdo->prepare("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ?")
                ->execute([$user['id']]);
            log_activity($pdo, $user['id'], 'login', 'Successful login');
        } else {
            $message = "Mot de passe incorrect.";
        }
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)")->execute([$email, $hash]);
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['email'] = $email;
        log_activity($pdo, $_SESSION['user_id'], 'register', 'New user registered');
    }
}

if (isset($_GET['logout'])) {
    log_activity($pdo, $_SESSION['user_id'] ?? 0, 'logout', 'User logged out');
    session_destroy();
    header("Location: index.php");
    exit;
}

$is_logged = isset($_SESSION['user_id']);
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
