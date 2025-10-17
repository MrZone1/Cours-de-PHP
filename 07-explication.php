<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>7. Explication du code de la barre de recherche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="print-btn no-print" onclick="window.print()">🖨️ Imprimer / PDF</button>

    <div class="wrapper">
        <div class="container">
            <div class="topbar">
                <div>
                    <h1>7️⃣ Explication du code — Barre de recherche de villes</h1>
                    <p style="margin:6px 0 0 0; color:var(--muted)">Décortiquons ensemble comment fonctionne ton mini-projet PHP/MySQL.</p>
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
                Tu as construit une mini-application PHP capable d’interroger une base de données et d’afficher des résultats.  
                Voyons étape par étape comment tout cela fonctionne.
            </div>

            <h2>1️⃣ Inclusion et connexion</h2>
            <pre><code>&lt;?php
include 'db.php';
$search = $_GET['citySearch'] ?? '';
?&gt;
</code></pre>
            <ul>
                <li><code>include 'db.php'</code> → importe le fichier de connexion à la base via PDO.</li>
                <li><code>$_GET['citySearch'] ?? ''</code> → récupère la valeur du champ de recherche, ou une chaîne vide si l’utilisateur n’a rien tapé.</li>
            </ul>

            <h2>2️⃣ Préparation de la requête SQL</h2>
            <pre><code>&lt;?php
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
            <ul>
                <li>Si l’utilisateur a saisi quelque chose, on cherche les villes dont le nom contient ce texte.</li>
                <li><code>LIKE :search</code> permet de faire une recherche partielle (ex. "par" → "Paris", "Parthenay").</li>
                <li><code>prepare()</code> + <code>execute()</code> = sécurité contre les injections SQL.</li>
                <li><code>fetchAll()</code> récupère les lignes de résultat sous forme de tableau associatif.</li>
            </ul>

            <h2>3️⃣ Affichage du formulaire</h2>
            <pre><code>&lt;form method="GET" action=""&gt;
    &lt;input type="text" name="citySearch" 
           value="&lt;?= htmlspecialchars($search) ?&gt;" 
           placeholder="Quelle ville cherchez-vous ?" 
           class="form-control form-control-lg mb-3"&gt;
    &lt;button type="submit" class="btn btn-primary w-100"&gt;Rechercher&lt;/button&gt;
&lt;/form&gt;
</code></pre>
            <ul>
                <li><code>method="GET"</code> → les données sont visibles dans l’URL (ex. ?citySearch=Paris).</li>
                <li><code>htmlspecialchars()</code> empêche l’injection de code HTML dans la recherche.</li>
                <li>Le bouton déclenche la même page avec le paramètre saisi.</li>
            </ul>

            <h2>4️⃣ Affichage des résultats</h2>
            <pre><code>&lt;?php
if (!empty($search) &amp;&amp; empty($cities)) {
    echo '&lt;div class="alert alert-info"&gt;Aucune ville trouvée pour &lt;strong&gt;' . htmlspecialchars($search) . '&lt;/strong&gt;&lt;/div&gt;';
}

if (!empty($cities)) {
    echo '&lt;div class="list-group"&gt;';
    foreach ($cities as $city) {
        echo '&lt;a href="#" class="list-group-item list-group-item-action"&gt;';
        echo htmlspecialchars($city['ville_nom_reel']) . ' - ' . htmlspecialchars($city['ville_code_postal']);
        echo '&lt;/a&gt;';
    }
    echo '&lt;/div&gt;';
}
?&gt;
</code></pre>
            <ul>
                <li>Si la recherche n’a donné aucun résultat → message d’information.</li>
                <li>Sinon, chaque ville est affichée dans une carte cliquable.</li>
                <li>Tout le contenu est protégé avec <code>htmlspecialchars()</code> pour éviter le HTML injecté.</li>
            </ul>

            <h2>5️⃣ Fonctionnement global</h2>
            <p>Voici le cycle complet :</p>
            <ol>
                <li>L’utilisateur ouvre la page → la base est prête, mais aucun résultat n’est affiché.</li>
                <li>Il saisit un nom → la page s’auto-recharge avec le paramètre <code>?citySearch=...</code>.</li>
                <li>PHP lit ce paramètre, exécute la requête SQL correspondante, et affiche les résultats.</li>
                <li>Chaque recherche relance donc le script avec un nouveau jeu de résultats.</li>
            </ol>

            <h2>6️⃣ Visualisation du flux</h2>
            <pre><code>Utilisateur → (formulaire GET) → PHP
    ↓
Lecture de $_GET['citySearch']
    ↓
Exécution SQL (SELECT * FROM villes WHERE LIKE %texte%)
    ↓
Résultats envoyés à PHP
    ↓
HTML généré et affiché au navigateur
</code></pre>

            <h2>📚 À retenir</h2>
            <ul>
                <li><strong>PDO</strong> = sécurité + compatibilité multi-bases.</li>
                <li><strong>prepare()</strong> protège les données en entrée.</li>
                <li><strong>htmlspecialchars()</strong> protège les données en sortie.</li>
                <li>Un simple <strong>GET</strong> permet d’obtenir un mini-moteur de recherche.</li>
                <li>Le code est réutilisable pour n’importe quelle recherche de base de données.</li>
            </ul>

            <div class="overview">
                🎉 Félicitations ! Tu as terminé ton mini-site PHP.  
                Tu sais maintenant manipuler les variables, formulaires, conditions, boucles, PDO et tu as créé un vrai petit moteur de recherche.
            </div>

            <p><a href="06-mini-projet.php">⬅️ Étape précédente</a> | <a href="index.html">Retour à l’accueil 🏠</a></p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
