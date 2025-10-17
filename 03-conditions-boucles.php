<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>3. Conditions, Boucles et Fonctions en PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="print-btn no-print" onclick="window.print()">🖨️ Imprimer / PDF</button>

    <div class="wrapper">
        <div class="container">
            <div class="topbar">
                <div>
                    <h1>3️⃣ Conditions, Boucles et Fonctions</h1>
                    <p style="margin:6px 0 0 0; color:var(--muted)">Découvre comment prendre des décisions et automatiser des actions en PHP.</p>
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
                PHP te permet de contrôler la logique de ton programme à l’aide de <strong>conditions</strong>, de <strong>boucles</strong> et de <strong>fonctions</strong>.
            </div>

            <h2>🧠 Les conditions (<code>if / else</code>)</h2>
            <pre><code>&lt;?php
$age = 18;

if ($age >= 18) {
    echo "Tu es majeur.";
} else {
    echo "Tu es mineur.";
}
?&gt;
</code></pre>

            <p>👉 PHP exécute le bloc de code qui correspond à la condition vraie.</p>

            <h3>🧩 Conditions imbriquées</h3>
            <pre><code>&lt;?php
$note = 14;

if ($note >= 16) {
    echo "Excellent !";
} elseif ($note >= 10) {
    echo "Bien joué !";
} else {
    echo "À retravailler.";
}
?&gt;
</code></pre>

            <h2>🔁 Les boucles</h2>
            <p>Une boucle permet de répéter une action plusieurs fois.</p>

            <h3>➡️ Boucle <code>for</code></h3>
            <pre><code>&lt;?php
for ($i = 1; $i &lt;= 5; $i++) {
    echo "Ligne " . $i . "&lt;br&gt;";
}
?&gt;
</code></pre>

            <h3>➡️ Boucle <code>while</code></h3>
            <pre><code>&lt;?php
$i = 1;
while ($i &lt;= 3) {
    echo "Compteur : $i&lt;br&gt;";
    $i++;
}
?&gt;
</code></pre>

            <h3>➡️ Boucle <code>foreach</code></h3>
            <pre><code>&lt;?php
$animaux = ["chat", "chien", "poisson"];
foreach ($animaux as $animal) {
    echo "Animal : $animal&lt;br&gt;";
}
?&gt;
</code></pre>

            <h2>🧮 Les fonctions</h2>
            <p>Les fonctions permettent de regrouper un ensemble d’instructions réutilisables.</p>

            <pre><code>&lt;?php
function direBonjour($nom) {
    return "Bonjour, " . $nom . " !";
}

echo direBonjour("Alice");
?&gt;
</code></pre>

            <p>💡 Les fonctions sont très utiles pour structurer ton code et éviter les répétitions.</p>

            <div class="overview">
                Ces concepts seront essentiels pour ton futur projet de <strong>barre de recherche</strong> :
                conditions pour filtrer, boucles pour parcourir les résultats, et fonctions pour structurer le code.
            </div>

            <p><a href="02-variables.php">⬅️ Étape précédente</a> | <a href="04-formulaires.php">Étape suivante : Formulaires et Sécurité ➡️</a></p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
