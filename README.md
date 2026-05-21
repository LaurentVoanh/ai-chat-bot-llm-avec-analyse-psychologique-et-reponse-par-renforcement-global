# NEXUS ULTIMA v7.0 - Portail d'Intelligence Artificielle Évolutive

## 🚀 Présentation

NEXUS Ultima est un portail web complet et fonctionnel offrant une interface de conversation avec une IA avancée (via Mistral AI), couplée à un système d'analyse neuro-psychologique en temps réel et d'auto-renforcement adaptatif.

## ✨ Fonctionnalités

### 1. **Dialogue Quantique** (index.php)
- Interface de chat temps réel avec NEXUS IA
- Historique des conversations persistant
- Indicateur de frappe animé
- Formatage basique (gras, italique, code)

### 2. **Profil Neuro-Psychologique** (profile.php)
- Radar chart cognitif (10 dimensions)
- Analyse IA en temps réel
- Statistiques détaillées : Moral, Progression, Engagement, Cohérence, Potentiel, Adaptation, Créativité, Focus, Résilience, Intuition
- Recommandations personnalisées

### 3. **Gestion de Projets** (projects.php)
- Création, modification, suppression de projets
- Suivi de progression (%)
- Priorités (Faible, Moyenne, Élevée)
- Dates d'échéance

### 4. **Base de Notes** (notes.php)
- Prise de notes structurée
- Tags et catégories
- Recherche et organisation

### 5. **Analytics** (analytics.php)
- Tableau de bord statistique
- Graphiques Chart.js (pie, bar)
- Suivi d'activité global

### 6. **Paramètres** (settings.php)
- Informations profil
- Export des données JSON
- Informations système

## 🎨 Design

- **Style futuriste 2advanced** inspiré
- Effets neon cyan/purple
- Glass morphism panels
- Animations fluides
- Responsive design
- Scrollbars customisées
- Particules animées en background

## 🛠️ Technologies

- **Backend**: PHP 8+ avec PDO SQLite
- **Frontend**: HTML5, CSS3, JavaScript ES6+
- **CSS Frameworks**: Bootstrap 5.3, Tailwind CSS (CDN)
- **Charts**: Chart.js 4.4
- **Icons**: Font Awesome 6.6
- **Fonts**: Inter, Orbitron (Google Fonts)
- **IA**: Mistral AI API (mistral-large-2411, mistral-small-2603)

## 📁 Structure

```
/workspace/
├── config.php      # Configuration & DB & Auth & API Mistral
├── api.php         # Endpoint AJAX pour toutes les opérations
├── index.php       # Page de login + Chat principal
├── profile.php     # Profil neuro-psychologique
├── projects.php    # Gestion de projets
├── notes.php       # Base de notes
├── analytics.php   # Tableau de bord
├── settings.php    # Paramètres utilisateur
├── data/           # Base de données SQLite (nexus.db)
└── README.md       # Ce fichier
```

## 🔧 Installation

1. Copiez tous les fichiers dans votre dossier web
2. Assurez-vous que le dossier `data/` est accessible en écriture
3. Ouvrez `index.php` dans votre navigateur
4. Connectez-vous avec un email/mot de passe (création auto à la première connexion)

## 🔑 API Keys

Les clés API Mistral sont configurées dans `config.php` avec rotation automatique en cas de rate-limit.

## 🧠 Intelligence Artificielle

NEXUS utilise :
- **mistral-large-2411** pour les conversations principales
- **mistral-small-2603** pour l'analyse psychologique rapide
- Système de prompt contextuel incluant le profil utilisateur
- Auto-renforcement basé sur les interactions réussies

## 📊 Base de Données SQLite

Tables créées automatiquement :
- `users` : Utilisateurs et statistiques
- `chat_history` : Historique des conversations
- `psycho_analysis` : Analyses psychologiques
- `reinforcement_memory` : Mémoire de renforcement
- `projects` : Projets utilisateurs
- `notes` : Notes et connaissances
- `activity_log` : Journal d'activité
- `notifications` : Notifications système

## 🎯 Points Forts

✅ **100% fonctionnel** - Pas de pages vierges ou liens morts
✅ **Design pro** - Style futuriste cohérent sur toutes les pages
✅ **Complet** - Toutes les fonctions du CRUD implémentées
✅ **Responsive** - Adapté mobile/desktop
✅ **Sécurisé** - Password hash, sessions PHP, protection XSS
✅ **Auto-suffisant** - SQLite intégré, pas de configuration externe requise

## 📝 Licence

Projet open-source à but éducatif et démonstratif.

---

**NEXUS Ultima v7.0** - *Intelligence Évolutive au Service de Votre Progression*
