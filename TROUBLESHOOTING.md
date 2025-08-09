# Guide de dépannage - FoodTiger

## Problèmes de connexion

### 1. Page blanche après connexion

**Cause possible :** Base de données non configurée ou table manquante

**Solution :**
1. Vérifiez que XAMPP est démarré (Apache et MySQL)
2. Accédez à `http://localhost/phpmyadmin`
3. Créez une base de données nommée `foodtiger`
4. Importez le fichier SQL de la base de données

### 2. Erreur "Table customer non trouvée"

**Solution :**
1. Connectez-vous à phpMyAdmin
2. Sélectionnez la base de données `foodtiger`
3. Créez la table `customer` avec la structure suivante :

```sql
CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `PhoneNo` varchar(20) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  PRIMARY KEY (`cus_id`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### 3. Erreur de connexion à la base de données

**Vérifiez le fichier `database/connection.php` :**
```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "foodtiger";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### 4. Test de connexion

Pour tester la connexion, accédez à :
`http://localhost/cantine-main/database/test_connection.php`

Ce fichier vérifiera :
- La connexion à la base de données
- L'existence de la base de données `foodtiger`
- L'existence de la table `customer`
- La structure de la table

### 5. Connexions sociales (Google/Facebook)

Les connexions sociales sont temporairement désactivées car elles nécessitent :
1. Des clés API Google OAuth
2. Des clés API Facebook OAuth
3. Une configuration serveur spécifique

Pour activer les connexions sociales :
1. Créez un projet Google Cloud Console
2. Créez une application Facebook Developer
3. Configurez les clés dans `database/oauth_config.php`
4. Décommentez le code dans `login.php`

### 6. Redirection vers index.php

Après une connexion réussie, l'utilisateur est redirigé vers `index.php`. Si cela ne fonctionne pas :
1. Vérifiez que le fichier `index.php` existe
2. Vérifiez les permissions des fichiers
3. Vérifiez que les sessions PHP fonctionnent

### 7. Problèmes de session

Si les sessions ne persistent pas :
1. Vérifiez que `session_start()` est appelé au début de chaque fichier
2. Vérifiez la configuration PHP pour les sessions
3. Vérifiez que les cookies sont activés dans le navigateur

## Support

Pour plus d'aide, vérifiez :
1. Les logs d'erreur PHP dans XAMPP
2. Les logs d'erreur MySQL
3. La console du navigateur pour les erreurs JavaScript
