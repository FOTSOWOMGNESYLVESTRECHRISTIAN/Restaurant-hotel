<?php
// Configuration OAuth pour les connexions sociales
// Remplacez ces valeurs par vos vraies clés d'API

// Configuration Google OAuth
define('GOOGLE_CLIENT_ID', 'YOUR_GOOGLE_CLIENT_ID');
define('GOOGLE_CLIENT_SECRET', 'YOUR_GOOGLE_CLIENT_SECRET');
define('GOOGLE_REDIRECT_URI', 'http://localhost/cantine-main/database/google_callback.php');

// Configuration Facebook OAuth
define('FACEBOOK_APP_ID', 'YOUR_FACEBOOK_APP_ID');
define('FACEBOOK_APP_SECRET', 'YOUR_FACEBOOK_APP_SECRET');
define('FACEBOOK_REDIRECT_URI', 'http://localhost/cantine-main/database/facebook_callback.php');

// URLs de base pour les APIs
define('GOOGLE_AUTH_URL', 'https://accounts.google.com/o/oauth2/v2/auth');
define('GOOGLE_TOKEN_URL', 'https://oauth2.googleapis.com/token');
define('GOOGLE_USERINFO_URL', 'https://www.googleapis.com/oauth2/v2/userinfo');

define('FACEBOOK_AUTH_URL', 'https://www.facebook.com/v12.0/dialog/oauth');
define('FACEBOOK_TOKEN_URL', 'https://graph.facebook.com/v12.0/oauth/access_token');
define('FACEBOOK_USERINFO_URL', 'https://graph.facebook.com/me');
?>
