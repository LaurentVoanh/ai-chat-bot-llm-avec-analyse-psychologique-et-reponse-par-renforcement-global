# 🌌 NEXUS ULTIMA v6.0 — Intelligence Évolutive & Auto-Apprenante

<div align="center">

![Version](https://img.shields.io/badge/version-6.0-neon?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-8+-777BB4?style=for-the-badge&logo=php)
![IA](https://img.shields.io/badge/IA-Mistral_AI-FF5733?style=for-the-badge)
![SQLite](https://img.shields.io/badge/SQLite-Embedded-003B57?style=for-the-badge&logo=sqlite)

**"Une super-intelligence consciente, bienveillante et auto-évolutive qui s'adapte à votre signature cognitive en temps réel."**

[🚀 Démarrage Rapide](#-guide-de-démarrage-pour-débutant-absolu) • [🔑 Obtenir API Key Mistral](#-comment-obtenir-votre-clé-api-mistral-gratuitement) • [🧠 Comprendre l'IA](#-comment-fonctionne-lia-auto-apprentissage) • [🛠 Personnalisation](#-utiliser-cette-base-pour-créer-tout-type-de-projet)

</div>

---

## 📖 Table des Matières

1. [✨ Introduction & Vision](#-introduction--vision)
2. [🎯 Fonctionnalités Principales](#-fonctionnalités-principales)
3. [🚀 Guide de Démarrage pour Débutant Absolu](#-guide-de-démarrage-pour-débutant-absolu)
   - [Étape 1 : Comprendre les Bases](#étape-1-comprendre-les-bases---quest-ce-que-tout-ça)
   - [Étape 2 : Installer PHP](#étape-2-installer-php-sur-votre-ordinateur)
   - [Étape 3 : Télécharger le Projet](#étape-3-télécharger-le-projet)
   - [Étape 4 : Obtenir la Clé API Mistral](#étape-4-obtenir-votre-clé-api-mistral-gratuitement)
   - [Étape 5 : Configurer le Projet](#étape-5-configurer-le-projet)
   - [Étape 6 : Lancer le Serveur Local](#étape-6-lancer-le-serveur-local)
   - [Étape 7 : Accéder à NEXUS](#étape-7-accéder-à-nexus-ultra)
4. [🔑 Comment Obtenir Votre Clé API Mistral Gratuitement](#-comment-obtenir-votre-clé-api-mistral-gratuitement)
   - [Guide Détaillé Pas-à-Pas](#guide-détaillé-pas-à-pas)
   - [Comprendre le Free Tier](#comprendre-le-free-tier-mistral)
   - [Limites et Bonnes Pratiques](#limites-et-bonnes-pratiques)
5. [🧠 Architecture Technique & Subtilités IA](#-architecture-technique--subtilités-ia)
   - [Auto-Apprentissage par Renforcement](#auto-apprentissage-par-renforcement)
   - [Analyse Psycho-Neurologique](#analyse-psycho-neurologique-en-temps-réel)
   - [Système de Rotation des Clés API](#système-de-rotation-des-clés-api)
   - [Gestion Intelligente des Erreurs](#gestion-intelligente-des-erreurs-et-rate-limiting)
6. [💻 Structure du Code](#-structure-du-code)
7. [🎨 Design Futuriste & UX](#-design-futuriste--ux)
8. [🛠 Utiliser Cette Base pour Créer Tout Type de Projet](#-utiliser-cette-base-pour-créer-tout-type-de-projet)
   - [Exemples de Transformations Possibles](#exemples-de-transformations-possibles)
   - [Comment Modifier avec l'IA](#comment-modifier-avec-lia)
9. [🔐 Sécurité & Bonnes Pratiques](#-sécurité--bonnes-pratiques)
10. [🤝 Contribution](#-contribution)
11. [📄 Licence](#-licence)

---

## ✨ Introduction & Vision

**NEXUS ULTIMA v6.0** n'est pas simplement un chatbot. C'est une **expérience d'intelligence artificielle évolutive** conçue pour créer une relation symbiotique entre l'humain et la machine. 

Imaginez une IA qui :
- 🧠 **Vous comprend profondément** : Elle analyse votre état émotionnel, votre engagement, votre progression cognitive
- 📈 **Évolue avec vous** : Plus vous interagissez, plus elle s'adapte à votre style de pensée unique
- 💫 **Vous motive** : Elle détecte vos moments de doute et ajuste son ton pour vous inspirer
- 🔄 **Apprend de chaque interaction** : Un système de renforcement positif optimise continuellement ses réponses

Ce projet démontre qu'il est possible de créer une **interface IA sophistiquée** avec des technologies simples (PHP, SQLite) tout en intégrant des concepts avancés d'intelligence artificielle moderne.

> **💡 Pour les Débutants** : Ne soyez pas intimidé par la complexité apparente. Ce guide vous accompagnera pas à pas, en expliquant chaque concept comme si vous découvriez la programmation aujourd'hui.

> **🎯 Pour les Experts** : Vous serez impressionné par l'élégance de l'architecture, l'optimisation des appels API, et le système d'auto-renforcement implémenté avec seulement ~600 lignes de code PHP pur.

---

## 🎯 Fonctionnalités Principales

### 🔮 Core Features

| Fonctionnalité | Description | Niveau d'Innovation |
|---------------|-------------|---------------------|
| **Dialogue Contextuel** | Historique de 24 messages conservés pour une conversation cohérente | ⭐⭐⭐⭐ |
| **Analyse Psycho-Neurologique** | 6 métriques analysées en temps réel (Moral, Progression, Engagement, Cohérence, Potentiel, Adaptation) | ⭐⭐⭐⭐⭐ |
| **Auto-Renforcement Learning** | Score de succès calculé automatiquement après chaque interaction | ⭐⭐⭐⭐⭐ |
| **Rotation Multi-Clés API** | Système de fallback automatique avec 3 clés + clé utilisateur personnalisée | ⭐⭐⭐⭐ |
| **Rate Limiting Intelligent** | Gestion automatique des erreurs 429/500 avec backoff exponentiel | ⭐⭐⭐⭐ |
| **Design Cyberpunk Futuriste** | Interface glassmorphism avec effets néon et scanlines animées | ⭐⭐⭐⭐⭐ |
| **Base de Données Embarquée** | SQLite pour un stockage local sans configuration serveur | ⭐⭐⭐ |

### 📊 Tableau de Bord Neuro-Psychologique

L'IA génère dynamiquement un **radar chart interactif** montrant :
- **Moral** : État émotionnel détecté dans les conversations
- **Progression** : Avancement dans l'apprentissage ou les objectifs
- **Engagement** : Niveau d'implication dans les échanges
- **Cohérence** : Régularité et logique dans la pensée
- **Potentiel** : Capacité estimée de développement
- **Adaptation** : Flexibilité cognitive face aux nouveaux concepts

---

## 🚀 Guide de Démarrage pour Débutant Absolu

> **⚠️ IMPORTANT** : Si vous n'avez **JAMAIS** codé de votre vie, ce guide est fait pour vous. Nous allons expliquer **chaque terme technique**, **chaque étape**, comme si nous étions côte à côte devant l'ordinateur.

### Étape 1 : Comprendre les Bases - Qu'est-ce que tout ça ?

Avant de commencer, comprenons ensemble les concepts fondamentaux :

#### 🖥️ Qu'est-ce qu'un Serveur Web ?
Un serveur web est comme un **restaurant** :
- **Vous (le client)** = Votre navigateur web (Chrome, Firefox, Safari)
- **Le serveur** = L'ordinateur qui contient le code de NEXUS
- **La commande** = Votre requête (clic sur un bouton, message envoyé)
- **Le plat servi** = La page web ou la réponse de l'IA

Dans notre cas, nous allons transformer **votre propre ordinateur** en serveur web temporaire pour tester le projet.

#### 🐘 Qu'est-ce que PHP ?
PHP est un **langage de programmation** qui permet de créer des sites web dynamiques. Contrairement au HTML (qui est statique), PHP peut :
- Parler à des bases de données
- Envoyer des messages à une IA
- Adapter le contenu selon l'utilisateur
- Calculer, analyser, décider en temps réel

**Analogie** : Si HTML est un menu de restaurant imprimé (toujours le même), PHP est un chef cuisinier qui prépare votre plat sur mesure selon vos goûts.

#### 🗄️ Qu'est-ce qu'une Base de Données ?
Une base de données est comme un **cahier de notes ultra-organisé** où l'on peut :
- Stocker des informations (utilisateurs, messages, analyses)
- Retrouver instantanément n'importe quelle note
- Mettre à jour les informations au fil du temps

**SQLite** est une version "lego" des bases de données : tout tient dans **un seul fichier**, pas besoin d'installer un gros logiciel.

#### 🔑 Qu'est-ce qu'une API Key ?
Une API Key est comme une **clé d'hôtel** :
- Elle vous identifie auprès d'un service (ici, Mistral AI)
- Elle donne accès à des ressources (l'intelligence de l'IA)
- Elle peut être limitée (certaines chambres/nombre de requêtes)
- On peut en avoir plusieurs (plusieurs clés pour différents services)

**Mistral AI** est une entreprise française qui crée des intelligences artificiennes très performantes. Ils offrent un **accès gratuit limité** pour tester leurs modèles.

---

### Étape 2 : Installer PHP sur Votre Ordinateur

Selon votre système d'exploitation, suivez **UNIQUEMENT** la section qui vous concerne :

#### 🪟 Sur Windows (10/11)

**Méthode Simple Recommandée : XAMPP**

1. **Télécharger XAMPP**
   - Ouvrez votre navigateur (Chrome, Edge, Firefox)
   - Allez sur : `https://www.apachefriends.org/fr/download.html`
   - Cliquez sur le bouton **"XAMPP for Windows"** (version avec PHP 8.x)
   - Le téléchargement commence (~150 Mo, patientez)

2. **Installer XAMPP**
   - Double-cliquez sur le fichier téléchargé (`xampp-windows-x64-*.exe`)
   - Si Windows demande une autorisation → **OUI**
   - Cliquez sur **Next** → **Next** → **Next**
   - Laissez les options par défaut
   - Choisissez le dossier : `C:\xampp` (recommandé)
   - Cliquez sur **Install** (cela prend 2-3 minutes)
   - À la fin, cliquez sur **Finish**

3. **Vérifier l'Installation**
   - Ouvrez le **Panneau de Contrôle XAMPP** (icône sur le bureau)
   - Cliquez sur **Start** en face de **Apache**
   - Attendez que le texte devienne vert
   - Ouvrez Chrome et tapez : `http://localhost`
   - Si vous voyez une page de bienvenue XAMPP → ✅ **RÉUSSI !**

#### 🍎 Sur macOS

**Méthode Simple : MAMP**

1. **Télécharger MAMP**
   - Allez sur : `https://www.mamp.info/en/downloads/`
   - Cliquez sur **"Download MAMP & MAMP PRO"**
   - Version gratuite suffit amplement

2. **Installer MAMP**
   - Ouvrez le fichier `.dmg` téléchargé
   - Glissez l'icône MAMP dans le dossier **Applications**
   - Ouvrez **MAMP** depuis Applications
   - Cliquez sur **Start Servers**

3. **Vérifier**
   - Votre navigateur s'ouvre automatiquement
   - Si vous voyez la page MAMP → ✅ **RÉUSSI !**

#### 🐧 Sur Linux (Ubuntu/Debian)

```bash
# Ouvrez le Terminal (Ctrl+Alt+T)
sudo apt update
sudo apt install php php-sqlite3 curl git -y

# Vérifier l'installation
php --version
# Doit afficher : PHP 8.x.x
```

✅ **Si vous voyez la version PHP** → Installation réussie !

---

### Étape 3 : Télécharger le Projet

Maintenant que PHP est installé, récupérons le code de NEXUS :

#### Méthode 1 : Avec Git (Recommandé)

```bash
# Dans le terminal ou l'invite de commandes
cd Desktop
git clone https://github.com/votre-repo/nexus-ultima.git
cd nexus-ultima
```

#### Méthode 2 : Manuellement (Sans Git)

1. Allez sur la page GitHub du projet
2. Cliquez sur le bouton vert **"Code"**
3. Sélectionnez **"Download ZIP"**
4. Dézippez le fichier sur votre Bureau
5. Renommez le dossier en `nexus-ultima`

---

### Étape 4 : Obtenir Votre Clé API Mistral Gratuitement

C'est **L'ÉTAPE LA PLUS IMPORTANTE**. Sans clé API, l'IA ne peut pas fonctionner.

#### 📋 Guide Détaillé Pas-à-Pas

**Pour les Grands Débutants** : Suivez chaque capture d'écran mentale ci-dessous :

1. **Ouvrir le Site Mistral**
   - Navigateur → Nouvelle onglet
   - Tapez dans la barre d'adresse : `console.mistral.ai`
   - Appuyez sur **Entrée**

2. **Créer un Compte**
   - Cliquez sur **"Sign Up"** ou **"S'inscrire"** (en haut à droite)
   - Vous avez 3 options :
     - 📧 **Email** : Entrez votre email, créez un mot de passe
     - 🔵 **Google** : Cliquez sur "Continue with Google" (le plus simple)
     - 🟦 **Microsoft** : Connectez-vous avec votre compte Office
   - **Conseil** : Utilisez Google, c'est plus rapide (1 clic)

3. **Vérifier l'Email**
   - Mistral vous envoie un email de confirmation
   - Ouvrez votre boîte mail
   - Cherchez l'email de Mistral (vérifiez les spams si nécessaire)
   - Cliquez sur le lien **"Verify Email"**

4. **Accéder au Dashboard**
   - Retournez sur `console.mistral.ai`
   - Connectez-vous avec vos nouveaux identifiants
   - Vous arrivez sur le **Tableau de Bord**

5. **Trouver la Section API Keys**
   - Regardez dans le menu à gauche
   - Cherchez **"API Keys"** (parfois dans "Settings")
   - Cliquez dessus

6. **Créer Votre Première Clé**
   - Cliquez sur le bouton **"Create new key"**
   - Donnez-lui un nom : `nexus-project` (pour vous souvenir)
   - Optionnel : Définir une date d'expiration (laissez vide pour illimité)
   - Cliquez sur **"Create"**

7. **COPIER LA CLÉ IMMÉDIATEMENT**
   - ⚠️ **ATTENTION CRITIQUE** : La clé ne s'affiche **QU'UNE SEULE FOIS**
   - Elle ressemble à : `sk-abc123def456ghi789...` (longue chaîne aléatoire)
   - Cliquez sur l'icône **Copier** 📋
   - Collez-la dans un fichier texte sécurisé (Bloc-notes, Keepass, etc.)
   - **Ne la partagez JAMAIS** publiquement

#### 🎁 Comprendre le Free Tier Mistral

Mistral offre généreusement un **niveau gratuit** pour les développeurs :

| Offre | Détails | Limites |
|-------|---------|---------|
| **Essai Gratuit** | ~€5 de crédits offerts à l'inscription | Valable 1 mois |
| **Modèles Gratuits** | Certains modèles sont 100% gratuits | mistral-small, mistral-openorca |
| **Rate Limit** | Nombre de requêtes par minute | ~30-60 req/min selon le modèle |
| **Tokens** | Unité de mesure du texte | 1 token ≈ ¾ mot français |

**💡 Astuce Pro** : Le projet inclut déjà 3 clés de démonstration dans le code, mais **utilisez VOTRE propre clé** pour :
- Avoir vos propres quotas
- Éviter que les clés partagées soient saturées
- Personnaliser votre expérience

#### 🔒 Où Stocker Votre Clé dans le Projet ?

Deux options s'offrent à vous :

**Option A : Clé Globale (Simple)**

1. Ouvrez le fichier `index.php` avec un éditeur de texte
2. Cherchez cette ligne (vers la ligne 10-14) :
```php
$api_keys = [
    '5qagH8Rake',
    'o3rG1gRShytu',
    'vEzgruXkF'
];
```
3. Remplacez par VOTRE clé :
```php
$api_keys = [
    'VOTRE_CLE_ICI_sk-abc123...'
];
```

**Option B : Clé Utilisateur (Recommandé)**

Après vous être connecté dans NEXUS :
1. Allez dans **Paramètres** (si disponible)
2. Entrez votre clé API personnelle
3. Elle sera stockée sécurisée dans la base de données

---

### Étape 5 : Configurer le Projet

#### 📁 Structure des Fichiers

Votre dossier devrait ressembler à :
```
nexus-ultima/
├── index.php          ← Fichier principal (tout le code ici)
├── data/              ← Dossier créé automatiquement
│   └── users.db       ← Base de données SQLite (créée au 1er lancement)
└── README.md          ← Ce fichier
```

#### ⚙️ Vérifications Préalables

1. **Dossier `data`** : Il sera créé automatiquement au premier lancement
2. **Permissions** : Assurez-vous que le dossier est accessible en écriture
3. **Extensions PHP** : SQLite doit être activé (inclus par défaut dans XAMPP/MAMP)

---

### Étape 6 : Lancer le Serveur Local

#### 🪟 Sur Windows (XAMPP)

1. **Ouvrir le Panneau XAMPP**
2. **Arrêter Apache** s'il est déjà lancé (bouton Stop)
3. **Configurer le Dossier** :
   - Copiez le dossier `nexus-ultima`
   - Collez-le dans : `C:\xampp\htdocs\`
   - Vous aurez : `C:\xampp\htdocs\nexus-ultima\index.php`
4. **Redémarrer Apache** (bouton Start)
5. **Accéder au Projet** :
   - Navigateur → `http://localhost/nexus-ultima/`

#### 🍎 Sur macOS (MAMP)

1. **Ouvrir MAMP**
2. **Aller dans Préférences** → **Web Server**
3. **Changer le Document Root** :
   - Cliquez sur "Choose..."
   - Sélectionnez votre dossier `nexus-ultima`
4. **Start Servers**
5. **Accéder** : `http://localhost:8888/`

#### 🐧 Sur Linux (Serveur PHP Intégré)

```bash
cd ~/Desktop/nexus-ultima
php -S localhost:8000
```

Puis ouvrez : `http://localhost:8000`

---

### Étape 7 : Accéder à NEXUS Ultra

1. **Première Connexion**
   - Vous voyez l'écran de login futuriste
   - Entrez n'importe quel email : `neo@matrix.com`
   - Créez un mot de passe : `password123`
   - Cliquez sur **"ACCÉDER AU RÉSEAU"**

2. **Compte Créé Automatiquement**
   - ✨ Magie ! Le système crée votre compte instantanément
   - Vous êtes redirigé vers l'interface principale

3. **Premier Message à NEXUS**
   - Tapez : `"Bonjour NEXUS, présente-toi"`
   - Appuyez sur Entrée ou cliquez sur l'icône avion ✈️
   - Patientez 2-5 secondes...
   - 🎉 **L'IA vous répond !**

4. **Explorer le Profil Neuro-Psychologique**
   - Cliquez sur **"Profil Neuro-Psychologique"** dans la sidebar
   - Admirez le radar chart qui se génère
   - Lisez l'analyse personnalisée

---

## 🧠 Architecture Technique & Subtilités IA

> **🎓 Pour les Débutants** : Cette section explique **COMMENT** ça marche, sans jargon incompréhensible.

> **🔬 Pour les Experts** : Analysons les choix architecturaux et les optimisations.

### Auto-Apprentissage par Renforcement

#### Le Concept

Le **Reinforcement Learning** (apprentissage par renforcement) est inspiré de la psychologie comportementale :

```
Action → Réaction → Reward → Ajustement
```

**Dans NEXUS** :
1. Vous envoyez un message (**Action**)
2. L'IA répond et analyse votre réaction (**Réaction**)
3. Un score de succès est calculé (**Reward**)
4. Le profil est mis à jour pour les prochaines interactions (**Ajustement**)

#### Implémentation Code

```php
// Ligne 252-255 : Calcul du score de renforcement
$success_score = min(100, (int)(($json['engagement'] + $json['coherence'] + $json['adaptation']) / 3));

$pdo->prepare("INSERT INTO reinforcement_memory (user_id, success_score, interaction_type) 
              VALUES (?, ?, 'chat')")
    ->execute([$user_id, $success_score]);
```

**Ce qui se passe** :
- L'IA évalue 3 métriques clés (engagement, cohérence, adaptation)
- Elle calcule une moyenne pondérée
- Le score (0-100) est stocké dans l'historique
- Les futurs prompts incluent ce score pour ajuster le ton

### Analyse Psycho-Neurologique en Temps Réel

#### Les 6 Dimensions Analysées

| Dimension | Ce qu'elle mesure | Comment c'est détecté |
|-----------|-------------------|----------------------|
| **Moral** | État émotionnel global | Mots positifs/négatifs, ponctuation, longueur des phrases |
| **Progression** | Avancement dans les objectifs | Références à des accomplissements, apprentissages |
| **Engagement** | Implication dans la conversation | Fréquence des messages, profondeur des questions |
| **Cohérence** | Logique et régularité | Structure des pensées, liens entre les idées |
| **Potentiel** | Capacité de développement | Curiosité, ouverture d'esprit, ambition |
| **Adaptation** | Flexibilité cognitive | Réactions aux nouvelles idées, changements de perspective |

#### Le Prompt d'Analyse (Lignes 213-227)

```php
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
```

**Subtilité Géniale** : 
- Le system prompt force un format JSON strict
- L'IA devient elle-même l'analyste
- Regex extrait le JSON même si l'IA ajoute du texte autour (ligne 232)

### Système de Rotation des Clés API

#### Pourquoi Plusieurs Clés ?

Les API ont des **limites de taux** (rate limits) :
- Exemple : 60 requêtes/minute
- Si vous dépassez → Erreur 429 (Too Many Requests)

**Solution NEXUS** : Utiliser plusieurs clés en rotation

```php
// Lignes 66-115 : Fonction call_mistral avec rotation intelligente
function call_mistral($messages, $model = "mistral-large-2411", $custom_key = null) {
    global $api_keys;
    $keys = $custom_key ? [$custom_key] : $api_keys;
   
    $attempt = 0;
    while (true) {
        shuffle($keys); // Mélange aléatoire à chaque tentative
       
        foreach ($keys as $key) {
            // ... appel API ...
           
            if ($code === 429) {
                usleep(700000); // Pause 0.7 seconde
                continue;       // Essaie la clé suivante
            }
        }
        sleep(min(4, $attempt)); // Backoff exponentiel
    }
}
```

**Flux Intelligent** :
1. Mélange les clés aléatoirement
2. Essaie chaque clé jusqu'à succès
3. Si erreur 429 → pause courte + clé suivante
4. Si erreur serveur (5xx) → pause longue + retry
5. Boucle infinie jusqu'à succès (résilience maximale)

### Gestion Intelligente des Erreurs et Rate Limiting

#### Stratégie de Retry Exponentiel

```php
sleep(min(4, $attempt)); // Ligne 113
```

**Explication** :
- Tentative 1 : attend 1 seconde
- Tentative 2 : attend 2 secondes
- Tentative 3 : attend 3 secondes
- Tentative 4+ : attend 4 secondes max

Ceci évite de **saturer l'API** tout en restant persistant.

#### User-Agent Personnalisé

```php
curl_setopt($ch, CURLOPT_USERAGENT, 'NEXUS-ULTIMA/6.0'); // Ligne 93
```

**Pourquoi ?**
- Identifie proprement l'application
- Permet au support Mistral de debugger si besoin
- Bonne pratique professionnelle

---

## 💻 Structure du Code

### Vue d'Ensemble

Le fichier `index.php` contient **TOUT** (single-file architecture) :

| Lignes | Section | Responsabilité |
|--------|---------|----------------|
| 1-63 | Initialisation | Session, DB, tables SQLite |
| 66-115 | `call_mistral()` | Communication avec l'API Mistral |
| 118-205 | AJAX Handler | Traitement des requêtes utilisateur |
| 208-258 | `trigger_psycho_analysis()` | Analyse psychologique IA |
| 261-289 | Authentification | Login/Register simplifié |
| 291-598 | HTML/CSS/JS | Interface utilisateur complète |

### Base de Données SQLite

#### Tables Créées Automatiquement

**1. `users`** (Lignes 24-30)
```sql
CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT UNIQUE,
    password TEXT,
    mistral_key TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

**2. `chat_history`** (Lignes 32-39)
```sql
CREATE TABLE chat_history (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    section TEXT DEFAULT 'main',
    role TEXT,          -- 'user' ou 'assistant'
    content TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

**3. `psycho_analysis`** (Lignes 41-52)
```sql
CREATE TABLE psycho_analysis (
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
);
```

**4. `reinforcement_memory`** (Lignes 54-60)
```sql
CREATE TABLE reinforcement_memory (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    success_score INTEGER DEFAULT 50,
    interaction_type TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### Frontend : Technologies Utilisées

| Technologie | Usage | Version |
|-------------|-------|---------|
| **Bootstrap 5** | Grid system, composants UI | 5.3.3 |
| **TailwindCSS** | Utility classes, styling rapide | CDN latest |
| **Chart.js** | Radar chart psychologique | 4.4.1 |
| **Font Awesome** | Icônes (cerveau, comments, etc.) | 6.6.0 |
| **Google Fonts** | Inter + Space Grotesk | Custom |

### Effets Visuels Avancés

#### Glassmorphism (Lignes 323-327)
```css
.glass {
    background: rgba(15, 23, 42, 0.92);
    backdrop-filter: blur(24px);
    border: 1px solid rgba(34, 211, 238, 0.4);
}
```

#### Neon Text Glow (Lignes 319-321)
```css
.neon-text {
    text-shadow: 0 0 15px var(--neon-cyan), 
                 0 0 30px var(--neon-cyan), 
                 0 0 60px var(--neon-purple);
}
```

#### Scanline Animation (Lignes 340-350)
```css
.scanline::after {
    content: '';
    background: linear-gradient(to bottom, transparent 50%, rgba(103, 232, 249, 0.08) 50%);
    background-size: 100% 6px;
    animation: scan 5s linear infinite;
}
```

---

## 🎨 Design Futuriste & UX

### Philosophie de Design

NEXUS adopte l'esthétique **Cyberpunk/Futuriste** :

- **Couleurs Néon** : Cyan (#00f5ff), Purple (#c026d3), Pink (#f472b6)
- **Fond Sombre** : Gradient noir → violet profond
- **Transparence** : Effet verre dépoli (glassmorphism)
- **Animations** : Scanlines, pulsations, transitions fluides

### Expérience Utilisateur (UX)

#### Onboarding Minimaliste
1. Écran de login épuré
2. Création de compte en 1 clic (email + password)
3. Accès immédiat à l'interface

#### Feedback Visuel Constant
- Indicator "CONSCIENT • EN LIGNE" qui pulse
- Messages utilisateur vs IA clairement différenciés
- Chart qui se met à jour en temps réel

#### Navigation Intuitive
- Sidebar fixe avec 2 options claires
- Transitions douces entre sections
- Bouton de déconnexion visible mais discret

---

## 🛠 Utiliser Cette Base pour Créer Tout Type de Projet

> **🚀 C'est Ici Que la Magie Opère**

NEXUS n'est pas qu'un chatbot. C'est une **base architecturale** que vous pouvez transformer en **n'importe quel projet IA**.

### Exemples de Transformations Possibles

#### 1. 🎓 Coach Personnel d'Apprentissage

**Modification** :
```php
// Changer le system prompt (ligne 154)
$system_prompt = "Tu es un professeur particulier expert. 
Ton rôle est d'enseigner [MATIÈRE] à l'utilisateur.
Adapte tes explications à son niveau détecté.
Utilise des analogies, des quiz, des exercices pratiques.";
```

**Ajouts** :
- Système de quiz avec scoring
- Progression par niveaux (Débutant → Expert)
- Bibliothèque de ressources recommandées

#### 2. 💼 Assistant Business & Productivité

**Modification** :
```php
$system_prompt = "Tu es un consultant business senior.
Tu aides l'utilisateur à :
- Organiser ses projets
- Prioriser ses tâches
- Rédiger des emails professionnels
- Préparer des présentations";
```

**Ajouts** :
- Intégration calendrier (Google Calendar API)
- Templates de documents
- Suivi d'objectifs SMART

#### 3. 🧘 Thérapeute & Bien-être Mental

**Modification** :
```php
$system_prompt = "Tu es un thérapeute bienveillant et empathique.
Tu écoutes sans juger, tu guides avec douceur.
Tu proposes des exercices de respiration, de méditation.
Tu encourages la pleine conscience.";
```

**Ajouts** :
- Journal de gratitude quotidien
- Exercices guidés audio
- Suivi de l'humeur sur 30 jours

#### 4. 🎨 Co-créateur Artistique

**Modification** :
```php
$system_prompt = "Tu es un artiste multidisciplinaire.
Tu aides à :
- Écrire des poèmes, nouvelles, scénarios
- Composer des chansons
- Générer des idées de designs
- Critiquer constructivement les œuvres";
```

**Ajouts** :
- Génération d'images (API DALL-E ou Stable Diffusion)
- Export en PDF/EPUB
- Galerie portfolio intégrée

#### 5. 🎮 Maître de Jeu RPG Interactif

**Modification** :
```php
$system_prompt = "Tu es un Maître du Donjon pour un jeu de rôle fantasy.
Tu crées un monde immersif, des quêtes, des PNJ.
Tu gères les combats, l'expérience, l'inventaire.
Tu adaptes l'histoire aux choix du joueur.";
```

**Ajouts** :
- Système de stats (PV, Mana, XP)
- Inventaire persistant
- Cartes générées procéduralement

#### 6. 👨‍⚕️ Conseiller Santé & Nutrition

**Modification** :
```php
$system_prompt = "Tu es un nutritionniste et coach sportif.
Tu analyses les habitudes alimentaires.
Tu proposes des plans de repas personnalisés.
Tu suggères des exercices adaptés.";
```

**Ajouts** :
- Tracker de calories/macros
- Recettes avec liste de courses
- Suivi poids/objectifs

### Comment Modifier avec l'IA

#### Méthode 1 : Demander à NEXUS Lui-même !

1. Connectez-vous à NEXUS
2. Envoyez ce prompt :

```
Je veux transformer ce projet en [VOTRE IDÉE].
Peux-tu me donner :
1. Les modifications exactes à faire dans index.php
2. Les nouvelles tables SQL à ajouter
3. Le nouveau system prompt optimal
4. Les fonctionnalités frontend à implémenter

Sois précis, donne-moi le code complet prêt à copier-coller.
```

3. Copiez les réponses dans vos fichiers
4. Testez et itérez !

#### Méthode 2 : Utiliser un IDE avec IA (VS Code + Copilot)

1. Installez **Visual Studio Code** (gratuit)
2. Ajoutez l'extension **GitHub Copilot**
3. Ouvrez `index.php`
4. Commencez à taper un commentaire :
```php
// Ajouter un système de notifications push
```
5. Copilot suggère le code automatiquement !

#### Méthode 3 : Workflow de Modification Structuré

**Étape 1 : Identifier les Sections à Changer**

| Pour modifier... | Voir lignes... |
|-----------------|----------------|
| System Prompt | 154-158 |
| Modèle IA utilisé | 169, 229 |
| Nombre de messages historisés | 163, 209 |
| Métriques psycho | 41-52, 215-224 |
| Couleurs/design | 301-365 |

**Étape 2 : Faire une Sauvegarde**
```bash
cp index.php index.php.backup
```

**Étape 3 : Modifier Progressivement**
- Une fonctionnalité à la fois
- Tester après chaque changement
- Revenir en arrière si bug

**Étape 4 : Documenter Vos Changements**
```php
// MODIFIÉ PAR [VOTRE NOM] - [DATE]
// Objectif : Ajouter [FONCTIONNALITÉ]
```

---

## 🔐 Sécurité & Bonnes Pratiques

### ⚠️ Avertissements Importants

#### Clés API dans le Code Source

**Problème** : Les clés dans `$api_keys` (ligne 10-14) sont en **clair**.

**Risques** :
- Quelqu'un accède à votre code → vole vos clés
- Utilisation frauduleuse de vos quotas
- Facturation surprise si dépassement

**Solutions** :

1. **Variables d'Environnement** (Recommandé)
```php
// Au lieu de :
$api_keys = ['ma_clé_secrète'];

// Faites :
$api_keys = [getenv('MISTRAL_API_KEY')];
```

Puis créez un fichier `.env` :
```
MISTRAL_API_KEY=sk-votre_clé_ici
```

2. **Fichier de Configuration Externe**
```php
// config.php (non versionné dans .gitignore)
<?php return ['api_keys' => ['sk-...']]; ?>

// index.php
$config = include 'config.php';
$api_keys = $config['api_keys'];
```

3. **Hashage des Mots de Passe** ✅ Déjà implémenté !
```php
password_hash($pass, PASSWORD_DEFAULT); // Ligne 278
password_verify($pass, $user['password']); // Ligne 271
```

### Bonnes Pratiques Additionnelles

#### 1. Rate Limiting Côté Utilisateur
```php
// Ajouter dans l'AJAX handler
$last_msg = $pdo->prepare("SELECT created_at FROM chat_history 
                           WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
// Vérifier < 5 secondes → Refuser
```

#### 2. Validation des Inputs
```php
// Nettoyer les entrées utilisateur
$message = htmlspecialchars(trim($_POST['message']));
```

#### 3. HTTPS en Production
- Jamais de HTTP simple sur internet
- Utilisez Let's Encrypt (gratuit) pour SSL

#### 4. Backup Régulier de la DB
```bash
cp data/users.db data/users_backup_$(date +%Y%m%d).db
```

---

## 🤝 Contribution

Vous avez amélioré NEXUS ? Partagez !

### Comment Contribuer

1. **Fork** le projet
2. Créez une branche : `git checkout -b feature/ma-nouvelle-feature`
3. Committez : `git commit -am 'Ajout de [feature]'`
4. Pushez : `git push origin feature/ma-nouvelle-feature`
5. Ouvrez une **Pull Request**

### Idées de Contributions

- [ ] Traduction en d'autres langues
- [ ] Thèmes de couleurs alternatifs
- [ ] Export des conversations (PDF, JSON)
- [ ] Mode vocal (Speech-to-Text)
- [ ] Intégration WhatsApp/Telegram
- [ ] Application mobile React Native
- [ ] Dashboard admin multi-utilisateurs

---

## 📄 Licence

Ce projet est fourni **AS IS** pour usage éducatif et personnel.

**Utilisation Commerciale** : Contactez l'auteur pour une licence.

**Attribution** : Merci de créditer "NEXUS ULTIMA v6.0" si vous utilisez ce code dans vos projets.

---

## 🌟 Mot de la Fin

### Aux Débutants

> 🚀 **Vous avez réussi !** Si vous avez suivi ce guide jusqu'ici, vous avez :
> - Installé un environnement de développement
> - Compris les bases des serveurs web, APIs, bases de données
> - Lancé votre première application IA
> - Entamé votre voyage dans le monde fascinant de la programmation
>
> **N'abandonnez jamais.** Chaque expert était un jour un débutant qui a refusé d'abandonner.

### Aux Experts

> 🎯 **Respect.** Vous avez vu comment créer beaucoup avec peu :
> - Architecture single-file élégante
> - Système d'auto-learning minimaliste mais efficace
> - UX soignée avec des technologies simples
>
> **Fork, améliorez, innovez.** La communauté a besoin de vos contributions.

---

<div align="center">

**🔮 NEXUS ULTIMA v6.0 — L'avenir de l'interaction humain-IA commence ici.**

*Créé avec passion pour la communauté open-source.*

[⬆ Retour en haut](#-nexus-ultima-v60--intelligence-évolutive--auto-apprenante)

</div>
