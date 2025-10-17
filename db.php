<?php
/**
 * =====================================================
 *  FICHIER : db.php
 *  Rôle    : établir une connexion sécurisée à la BDD
 *  Auteur  : TonNom
 * =====================================================
 */

// Informations de connexion
$host = 'localhost';       // ou l’adresse du serveur (ex: 127.0.0.1)
$dbname = 'villes_france'; // nom de ta base de données
$username = 'root';        // utilisateur (souvent "root" en local)
$password = '';            // mot de passe (vide sur XAMPP/WAMP)
$charset = 'utf8mb4';

// DSN (Data Source Name) — configuration PDO
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// Options PDO pour la sécurité et le confort
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,   // Affiche les erreurs (en dev)
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Résultats sous forme de tableau associatif
    PDO::ATTR_EMULATE_PREPARES => false,           // Utiliser les vraies requêtes préparées
];

// Connexion à la BDD avec gestion d’erreur
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // En production, ne JAMAIS afficher le message exact
    // Loguer l’erreur plutôt que de l’afficher
    echo "<div style='
        background:#fee2e2;
        color:#991b1b;
        padding:1em;
        border-radius:8px;
        font-family:monospace;
        margin:2em auto;
        max-width:600px;
    '>
    ❌ Erreur de connexion à la base de données.<br>
    Vérifie tes identifiants dans <code>db.php</code>.
    </div>";

    // Pour le débogage local (à commenter en prod)
    // echo $e->getMessage();
    exit;
}
?>
