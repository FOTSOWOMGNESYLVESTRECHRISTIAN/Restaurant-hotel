<?php
// Fichier de test pour vérifier la connexion à la base de données
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Test de connexion à la base de données</h2>";

try {
    include "connection.php";
    echo "<p style='color: green;'>✓ Connexion à la base de données réussie</p>";
    
    // Vérifier si la base de données existe
    $db_check = mysqli_query($conn, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'foodtiger'");
    if (mysqli_num_rows($db_check) > 0) {
        echo "<p style='color: green;'>✓ Base de données 'foodtiger' existe</p>";
    } else {
        echo "<p style='color: red;'>✗ Base de données 'foodtiger' n'existe pas</p>";
    }
    
    // Vérifier si la table customer existe
    $table_check = mysqli_query($conn, "SHOW TABLES LIKE 'customer'");
    if (mysqli_num_rows($table_check) > 0) {
        echo "<p style='color: green;'>✓ Table 'customer' existe</p>";
        
        // Vérifier la structure de la table
        $structure = mysqli_query($conn, "DESCRIBE customer");
        echo "<h3>Structure de la table customer :</h3>";
        echo "<ul>";
        while ($row = mysqli_fetch_array($structure)) {
            echo "<li>{$row['Field']} - {$row['Type']}</li>";
        }
        echo "</ul>";
        
        // Compter le nombre d'utilisateurs
        $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM customer");
        $total = mysqli_fetch_array($count);
        echo "<p>Nombre d'utilisateurs dans la table : {$total['total']}</p>";
        
    } else {
        echo "<p style='color: red;'>✗ Table 'customer' n'existe pas</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Erreur : " . $e->getMessage() . "</p>";
}

echo "<br><a href='../login.php'>Retour à la page de connexion</a>";
?>
