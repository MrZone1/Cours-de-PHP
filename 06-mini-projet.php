<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>6. Mini-Projet – Barre de recherche de villes</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Styles spécifiques au mini-projet */
        .search-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: var(--card);
            border-radius: 10px;
            border: 1px solid var(--border);
        }

        .search-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-form {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 12px 16px;
            font-size: 16px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: var(--card);
            color: var(--text);
            font-family: inherit;
            transition: border-color 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(43, 124, 255, 0.1);
        }

        .search-input::placeholder {
            color: var(--muted);
        }

        .search-btn {
            width: 100%;
            padding: 12px 16px;
            font-size: 16px;
            font-weight: 600;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .search-btn:hover {
            opacity: 0.9;
        }

        .search-btn:active {
            opacity: 0.8;
        }

        .results-list {
            list-style: none;
            padding: 0;
            margin: 0;
            border: 1px solid var(--border);
            border-radius: 6px;
            overflow: hidden;
        }

        .results-list li {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            background: var(--card);
            color: var(--text);
            transition: background-color 0.15s ease, transform 0.15s ease;
            cursor: pointer;
        }

        .results-list li:last-child {
            border-bottom: none;
        }

        .results-list li:hover {
            background-color: rgba(43, 124, 255, 0.1);
            transform: scale(1.02);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin: 12px 0;
        }

        .alert-info {
            background: rgba(43, 124, 255, 0.1);
            border: 1px solid var(--accent);
            color: var(--text);
        }

        .no-results {
            text-align: center;
            padding: 20px;
            color: var(--muted);
        }
    </style>
</head>
<body>
    <button class="print-btn no-print" onclick="window.print()">🖨️ Imprimer / PDF</button>

    <div class="wrapper">
        <div class="container">
            <div class="topbar">
                <div>
                    <h1>6️⃣ Mini-Projet – Barre de recherche de villes</h1>
                    <p style="margin:6px 0 0 0; color:var(--muted)">Ton premier vrai projet PHP connecté à une base de données.</p>
                </div>

                <div class="theme-switch no-print">
                    <label for="themeToggle" style="font-size:0.95rem; color:var(--muted); margin-right:8px;">Thème</label>
                    <div id="themeToggle" class="toggle" role="button" tabindex="0" aria-pressed="false">
                        <div class="icons"><span></span><span></span></div>
                        <div class="knob">🌞</div>
                    </div>
                </div>
            </div>

            <div class="overview">
                Ce mini-projet affiche une barre de recherche permettant de trouver des villes françaises
                depuis une base de données MySQL (<code>villes_france_free</code>).
            </div>

            <h2>🎯 Objectif</h2>
            <p>Tu vas créer une page PHP qui :</p>
            <ul>
                <li>Se connecte à une base MySQL (via <code>db.php</code>)</li>
                <li>Récupère la saisie utilisateur (GET)</li>
                <li>Affiche les villes correspondantes avec leurs codes postaux</li>
                <li>Gère les cas "aucun résultat" proprement</li>
            </ul>

            <h2>⚙️ Le code complet</h2>
            <pre><code>&lt;?php
include 'db.php';
$search = $_GET['citySearch'] ?? '';

if (!empty($search)) {
    $stmt = $pdo-&gt;prepare("SELECT * FROM villes_france_free WHERE ville_nom_reel LIKE :search LIMIT 100");
    $stmt-&gt;execute(['search' =&gt; '%'.$search.'%']);
} else {
    $stmt = $pdo-&gt;prepare("SELECT * FROM villes_france_free LIMIT 0");
    $stmt-&gt;execute();
}
$cities = $stmt-&gt;fetchAll(PDO::FETCH_ASSOC);
?&gt;
</code></pre>

            <h2>💻 Le formulaire et résultats</h2>
            <pre><code>&lt;div class="search-container"&gt;
    &lt;h1 class="search-title"&gt;🏘️ Villes de France&lt;/h1&gt;
    
    &lt;form method="GET" action="" class="search-form"&gt;
        &lt;input type="text" name="citySearch" class="search-input"
               placeholder="Quelle ville cherchez-vous ?" 
               value="&lt;?= htmlspecialchars($search) ?&gt;"&gt;
        &lt;button type="submit" class="search-btn"&gt;Rechercher&lt;/button&gt;
    &lt;/form&gt;

    &lt;?php
    if (!empty($search) &amp;&amp; empty($cities)) {
        echo '&lt;div class="alert alert-info"&gt;Aucune ville trouvée pour &lt;strong&gt;' . htmlspecialchars($search) . '&lt;/strong&gt;&lt;/div&gt;';
    }

    if (!empty($cities)) {
        echo '&lt;ul class="results-list"&gt;';
        foreach ($cities as $city) {
            echo '&lt;li&gt;';
            echo htmlspecialchars($city['ville_nom_reel']) . ' - ' . htmlspecialchars($city['ville_code_postal']);
            echo '&lt;/li&gt;';
        }
        echo '&lt;/ul&gt;';
    }
    ?&gt;
&lt;/div&gt;
</code></pre>

            <h2>📁 Structure du projet</h2>
            <pre><code>cours-php/
│
├── db.php
├── 06-mini-projet.php
└── villes_france_free.sql (ta base importée)
</code></pre>

            <h2>📘 db.php (connexion à MySQL)</h2>
            <pre><code>&lt;?php
$dsn = 'mysql:host=localhost;dbname=ma_base;charset=utf8mb4';
$user = 'root';
$pass = '';
$options = [
    PDO::ATTR_ERRMODE =&gt; PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE =&gt; PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e-&gt;getMessage());
}
?&gt;
</code></pre>

            <h2>✅ Résultat attendu</h2>
            <p>Quand tu ouvres <code>06-mini-projet.php</code> dans ton navigateur via <code>http://localhost/cours-php/06-mini-projet.php</code> :</p>
            <ul>
                <li>Une barre de recherche s'affiche</li>
                <li>Tu tapes "Paris" → la liste des villes s'affiche</li>
                <li>Si aucune ville ne correspond → un message clair apparaît</li>
            </ul>

            <div class="overview">
                Prochaine étape : comprendre ce code en profondeur dans la page suivante –
                <strong>Explication détaillée du code</strong>.
            </div>

            <p><a href="05-bdd-pdo.php">⬅️ Étape précédente</a> | <a href="07-explication.php">Étape suivante : Explication du code ➡️</a></p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>