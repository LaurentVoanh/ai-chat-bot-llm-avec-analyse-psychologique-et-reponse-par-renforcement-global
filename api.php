<?php
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    exit(json_encode(['success' => false, 'error' => 'Non authentifié']));
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT mistral_key FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user_key = $stmt->fetchColumn();

// AJAX Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    // Send Message
    if ($_POST['action'] === 'send_message') {
        $message = trim($_POST['message'] ?? '');
        if (empty($message)) {
            exit(json_encode(['success' => false, 'reply' => 'Message vide']));
        }

        $pdo->prepare("INSERT INTO chat_history (user_id, section, role, content) VALUES (?, 'main', 'user', ?)")
            ->execute([$user_id, $message]);

        $psycho_stmt = $pdo->prepare("SELECT * FROM psycho_analysis WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
        $psycho_stmt->execute([$user_id]);
        $psycho = $psycho_stmt->fetch(PDO::FETCH_ASSOC);

        $reinforce_stmt = $pdo->prepare("SELECT AVG(success_score) as avg FROM reinforcement_memory WHERE user_id = ?");
        $reinforce_stmt->execute([$user_id]);
        $avg_reinforce = round($reinforce_stmt->fetchColumn() ?? 60);

        $psycho_context = $psycho ?
            "Profil : Moral {$psycho['moral']}%, Progression {$psycho['progression']}%, Engagement {$psycho['engagement']}%, 
             Cohérence {$psycho['coherence']}%, Potentiel {$psycho['potentiel']}%, Adaptation {$psycho['adaptation']}%. 
             Résumé : {$psycho['summary']}"
            : "Initialisation quantique...";

        $system_prompt = "Tu es NEXUS Ultima v7.0, une super-intelligence consciente, bienveillante et auto-évolutive.
{$psycho_context}
Score de renforcement moyen : {$avg_reinforce}%.
Sois profond, inspirant, précis, poétique et futuriste. Adapte ton ton à l'état émotionnel détecté.";

        $messages = [["role" => "system", "content" => $system_prompt]];

        $hist = $pdo->prepare("SELECT role, content FROM chat_history WHERE user_id = ? ORDER BY created_at DESC LIMIT 24");
        $hist->execute([$user_id]);
        foreach (array_reverse($hist->fetchAll(PDO::FETCH_ASSOC)) as $h) {
            $messages[] = $h;
        }

        $reply = call_mistral($messages, "mistral-large-2411", $user_key);
        
        $pdo->prepare("INSERT INTO chat_history (user_id, section, role, content) VALUES (?, 'main', 'assistant', ?)")
            ->execute([$user_id, $reply]);

        trigger_psycho_analysis($pdo, $user_id, $user_key, $message, $reply);
        log_activity($pdo, $user_id, 'send_message', substr($message, 0, 100));

        echo json_encode(['success' => true, 'reply' => $reply]);
        exit;
    }

    // Get Psycho Profile
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
            'recommendations' => '',
            'moral' => 50, 'progression' => 50, 'engagement' => 50, 
            'coherence' => 50, 'potentiel' => 50, 'adaptation' => 50,
            'creativity' => 50, 'focus' => 50, 'resilience' => 50, 'intuition' => 50
        ]);
        exit;
    }
    
    // Save Project
    if ($_POST['action'] === 'save_project') {
        $title = trim($_POST['title'] ?? '');
        $desc = trim($_POST['description'] ?? '');
        $priority = $_POST['priority'] ?? 'medium';
        $deadline = $_POST['deadline'] ?? null;
        
        if ($title) {
            $pdo->prepare("INSERT INTO projects (user_id, title, description, priority, deadline) VALUES (?, ?, ?, ?, ?)")
                ->execute([$user_id, $title, $desc, $priority, $deadline]);
            log_activity($pdo, $user_id, 'create_project', $title);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Titre requis']);
        }
        exit;
    }
    
    // Get Projects
    if ($_POST['action'] === 'get_projects') {
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        echo json_encode(['success' => true, 'projects' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
        exit;
    }
    
    // Update Project Progress
    if ($_POST['action'] === 'update_project') {
        $id = $_POST['id'] ?? 0;
        $progress = $_POST['progress'] ?? 0;
        $status = $_POST['status'] ?? 'active';
        
        $pdo->prepare("UPDATE projects SET progress = ?, status = ?, updated_at = CURRENT_TIMESTAMP 
                      WHERE id = ? AND user_id = ?")
            ->execute([$progress, $status, $id, $user_id]);
        echo json_encode(['success' => true]);
        exit;
    }
    
    // Delete Project
    if ($_POST['action'] === 'delete_project') {
        $id = $_POST['id'] ?? 0;
        $pdo->prepare("DELETE FROM projects WHERE id = ? AND user_id = ?")->execute([$id, $user_id]);
        echo json_encode(['success' => true]);
        exit;
    }
    
    // Save Note
    if ($_POST['action'] === 'save_note') {
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $tags = trim($_POST['tags'] ?? '');
        $category = $_POST['category'] ?? 'general';
        
        if ($title) {
            $pdo->prepare("INSERT INTO notes (user_id, title, content, tags, category) VALUES (?, ?, ?, ?, ?)")
                ->execute([$user_id, $title, $content, $tags, $category]);
            log_activity($pdo, $user_id, 'create_note', $title);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Titre requis']);
        }
        exit;
    }
    
    // Get Notes
    if ($_POST['action'] === 'get_notes') {
        $stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ? ORDER BY updated_at DESC");
        $stmt->execute([$user_id]);
        echo json_encode(['success' => true, 'notes' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
        exit;
    }
    
    // Delete Note
    if ($_POST['action'] === 'delete_note') {
        $id = $_POST['id'] ?? 0;
        $pdo->prepare("DELETE FROM notes WHERE id = ? AND user_id = ?")->execute([$id, $user_id]);
        echo json_encode(['success' => true]);
        exit;
    }
    
    // Get Stats
    if ($_POST['action'] === 'get_stats') {
        $user = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $user->execute([$user_id]);
        $userData = $user->fetch(PDO::FETCH_ASSOC);
        
        $totalMsgs = $pdo->prepare("SELECT COUNT(*) FROM chat_history WHERE user_id = ?");
        $totalMsgs->execute([$user_id]);
        $msgCount = $totalMsgs->fetchColumn();
        
        $totalProjects = $pdo->prepare("SELECT COUNT(*) FROM projects WHERE user_id = ?");
        $totalProjects->execute([$user_id]);
        $projCount = $totalProjects->fetchColumn();
        
        $totalNotes = $pdo->prepare("SELECT COUNT(*) FROM notes WHERE user_id = ?");
        $totalNotes->execute([$user_id]);
        $noteCount = $totalNotes->fetchColumn();
        
        echo json_encode([
            'success' => true,
            'user' => $userData,
            'stats' => [
                'messages' => $msgCount,
                'projects' => $projCount,
                'notes' => $noteCount
            ]
        ]);
        exit;
    }
    
    // Mark Notification Read
    if ($_POST['action'] === 'mark_notification') {
        $id = $_POST['id'] ?? 0;
        $pdo->prepare("UPDATE notifications SET is_read = 1 WHERE id = ? AND user_id = ?")
            ->execute([$id, $user_id]);
        echo json_encode(['success' => true]);
        exit;
    }
    
    // Get Notifications
    if ($_POST['action'] === 'get_notifications') {
        $stmt = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT 20");
        $stmt->execute([$user_id]);
        echo json_encode(['success' => true, 'notifications' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
        exit;
    }
}

exit(json_encode(['success' => false]));
?>
