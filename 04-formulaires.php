<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>4. Formulaires et Sécurité en PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="print-btn no-print" onclick="window.print()">🖨️ Imprimer / PDF</button>

    <div class="wrapper">
        <div class="container">
            <div class="topbar">
                <div>
                    <h1>4️⃣ Formulaires et Sécurité</h1>
                    <p style="margin:6px 0 0 0; color:var(--muted)">Apprends à recevoir, traiter et sécuriser les données d’un utilisateur.</p>
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
                Les formulaires permettent à l’utilisateur d’envoyer des informations à ton serveur.  
                PHP peut ensuite les lire, les valider et les afficher en toute sécurité.
            </div>

            <h2>📥 Exemple de formulaire simple</h2>

            <pre><code>&lt;form method="post" action=""&gt;
    &lt;label&gt;Votre prénom :&lt;/label&gt;&lt;br&gt;
    &lt;input type="text" name="prenom"&gt;&lt;br&gt;&lt;br&gt;
    &lt;button type="submit"&gt;Envoyer&lt;/button&gt;
&lt;/form&gt;
</code></pre>

            <p>En PHP, tu peux ensuite récupérer la donnée avec la superglobale <code>$_POST</code> :</p>

            <pre><code>&lt;?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = $_POST["prenom"];
    echo "Bonjour, " . $prenom;
}
?&gt;
</code></pre>

            <h2>🛡️ Sécuriser les entrées</h2>
            <p>Les données saisies par l’utilisateur peuvent contenir du code malveillant.
            Pour les afficher sans danger, on utilise <code>htmlspecialchars()</code>.</p>

            <pre><code>&lt;?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = htmlspecialchars($_POST["prenom"]);
    echo "Bonjour, " . $prenom;
}
?&gt;
</code></pre>

            <p>💡 Cela empêche l’exécution de code JavaScript injecté par un utilisateur.</p>

            <h2>📦 Exemple complet</h2>

            <pre><code>&lt;?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = trim($_POST["prenom"]); // retire les espaces
    $prenom = htmlspecialchars($prenom); // protège le HTML
    if (!empty($prenom)) {
        echo "&lt;p&gt;👋 Bonjour, &lt;strong&gt;$prenom&lt;/strong&gt; !&lt;/p&gt;";
    } else {
        echo "&lt;p style='color:red'&gt;Veuillez entrer votre prénom.&lt;/p&gt;";
    }
}
?&gt;

&lt;form method="post"&gt;
    &lt;label&gt;Votre prénom :&lt;/label&gt;&lt;br&gt;
    &lt;input type="text" name="prenom"&gt;&lt;br&gt;&lt;br&gt;
    &lt;button type="submit"&gt;Envoyer&lt;/button&gt;
&lt;/form&gt;
</code></pre>

            <h3>🧠 À retenir</h3>
            <ul>
                <li><code>$_POST</code> → données envoyées par formulaire en POST.</li>
                <li><code>htmlspecialchars()</code> → empêche les injections HTML/JS.</li>
                <li><code>trim()</code> → supprime les espaces inutiles.</li>
                <li>toujours vérifier si la variable n’est pas vide avant de l’utiliser.</li>
            </ul>

            <div class="overview">
                Ces bonnes pratiques t’éviteront des failles XSS et te serviront dans le projet de recherche.
            </div>

            <p><a href="03-conditions-boucles.php">⬅️ Étape précédente</a> | <a href="05-bdd-pdo.php">Étape suivante : Connexion à une base de données (PDO) ➡️</a></p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
