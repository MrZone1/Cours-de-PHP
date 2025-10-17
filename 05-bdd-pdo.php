<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>5. Connexion à une base de données (PDO)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="print-btn no-print" onclick="window.print()">🖨️ Imprimer / PDF</button>

    <div class="wrapper">
        <div class="container">
            <div class="topbar">
                <div>
                    <h1>5️⃣ Connexion à une base de données (PDO)</h1>
                    <p style="margin:6px 0 0 0; color:var(--muted)">Apprends à te connecter à MySQL et interagir avec des données via PHP.</p>
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
                PHP peut se connecter à une base de données (comme <strong>MySQL</strong>) pour stocker, lire et modifier des informations.  
                L’extension <strong>PDO</strong> (PHP Data Objects) est la méthode la plus moderne et sécurisée pour le faire.
            </div>

            <h2>🔌 1. Exemple de connexion basique</h2>
            <pre><code>&lt;?php
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base = "cours_php";

try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$base;charset=utf8", $utilisateur, $motdepasse);
    $pdo-&gt;setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Connexion réussie à la base $base";
} catch (PDOException $e) {
    echo "❌ Erreur : " . $e-&gt;getMessage();
}
?&gt;
</code></pre>

            <p>💡 Cette structure est à utiliser dans tous tes futurs projets PHP.</p>

            <h2>📖 2. Lire des données depuis la base</h2>
            <pre><code>&lt;?php
$stmt = $pdo-&gt;query("SELECT * FROM utilisateurs");

while ($row = $stmt-&gt;fetch(PDO::FETCH_ASSOC)) {
    echo "👤 " . $row["nom"] . " (" . $row["email"] . ")&lt;br&gt;";
}
?&gt;
</code></pre>

            <p>Cette boucle <code>while</code> lit chaque ligne du résultat et affiche le nom et l’email de l’utilisateur.</p>

            <h2>✍️ 3. Insérer des données en sécurité</h2>
            <pre><code>&lt;?php
$nom = "Alice";
$email = "alice@example.com";

$sql = "INSERT INTO utilisateurs (nom, email) VALUES (:nom, :email)";
$stmt = $pdo-&gt;prepare($sql);
$stmt-&gt;execute([":nom" =&gt; $nom, ":email" =&gt; $email]);

echo "✅ Donnée insérée avec succès !";
?&gt;
</code></pre>

            <p>🧠 L’utilisation de <code>prepare()</code> et <code>execute()</code> protège contre les <strong>injections SQL</strong>.</p>

            <h2>🔐 À retenir</h2>
            <ul>
                <li><code>PDO</code> permet de se connecter à MySQL et d’autres bases facilement.</li>
                <li><code>try / catch</code> capture les erreurs sans planter ton code.</li>
                <li><code>prepare()</code> et <code>execute()</code> sont essentiels pour la sécurité.</li>
                <li>On utilise <code>fetch()</code> ou <code>fetchAll()</code> pour lire les données.</li>
            </ul>

            <div class="overview">
                Prochaine étape : tu vas combiner tout ce que tu as appris pour créer ton premier mini-projet —
                une <strong>barre de recherche de villes françaises</strong>.
            </div>

            <p><a href="04-formulaires.php">⬅️ Étape précédente</a> | <a href="06-mini-projet.php">Étape suivante : Mini-Projet — SearchBar de villes ➡️</a></p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
