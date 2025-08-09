<?php
session_start();
require 'connection.php';
require 'oauth_config.php';

// Si l'utilisateur n'est pas connecté via Google, rediriger vers l'autorisation
if (!isset($_GET['code'])) {
    $auth_url = GOOGLE_AUTH_URL . '?' . http_build_query([
        'client_id' => GOOGLE_CLIENT_ID,
        'redirect_uri' => GOOGLE_REDIRECT_URI,
        'scope' => 'email profile',
        'response_type' => 'code',
        'access_type' => 'offline'
    ]);
    
    header('Location: ' . $auth_url);
    exit();
}

// Si on a un code d'autorisation, traiter la connexion
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    
    // Échanger le code contre un token d'accès
    $token_data = [
        'client_id' => GOOGLE_CLIENT_ID,
        'client_secret' => GOOGLE_CLIENT_SECRET,
        'code' => $code,
        'grant_type' => 'authorization_code',
        'redirect_uri' => GOOGLE_REDIRECT_URI
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, GOOGLE_TOKEN_URL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    
    $token_response = curl_exec($ch);
    curl_close($ch);
    
    $token_info = json_decode($token_response, true);
    
    if (isset($token_info['access_token'])) {
        // Récupérer les informations de l'utilisateur
        $user_info_url = GOOGLE_USERINFO_URL . '?access_token=' . $token_info['access_token'];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $user_info_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $user_response = curl_exec($ch);
        curl_close($ch);
        
        $user_info = json_decode($user_response, true);
        
        if (isset($user_info['email'])) {
            $email = mysqli_real_escape_string($conn, $user_info['email']);
            $name = mysqli_real_escape_string($conn, $user_info['name'] ?? '');
            $google_id = mysqli_real_escape_string($conn, $user_info['id'] ?? '');
            
            // Vérifier si l'utilisateur existe déjà
            $check_query = "SELECT * FROM customer WHERE Email = '$email'";
            $check_result = mysqli_query($conn, $check_query);
            
            if (mysqli_num_rows($check_result) > 0) {
                // Utilisateur existe, connecter
                $user = mysqli_fetch_array($check_result);
                $_SESSION['cus_id'] = $user['cus_id'];
                $_SESSION['Name'] = $user['Name'];
                $_SESSION['Email'] = $user['Email'];
                $_SESSION['PhoneNo'] = $user['PhoneNo'];
                $_SESSION['Address'] = $user['Address'];
                
                header('location: ../index.php');
                exit();
            } else {
                // Créer un nouveau compte
                $hashed_password = password_hash($google_id, PASSWORD_DEFAULT);
                $insert_query = "INSERT INTO customer (Name, Email, Password, PhoneNo, Address) 
                                VALUES ('$name', '$email', '$hashed_password', '', '')";
                
                if (mysqli_query($conn, $insert_query)) {
                    $new_user_id = mysqli_insert_id($conn);
                    $_SESSION['cus_id'] = $new_user_id;
                    $_SESSION['Name'] = $name;
                    $_SESSION['Email'] = $email;
                    $_SESSION['PhoneNo'] = '';
                    $_SESSION['Address'] = '';
                    
                    header('location: ../index.php');
                    exit();
                } else {
                    echo "<script>alert('Erreur lors de la création du compte !');
                    window.location.href= '../login.php';</script>";
                    exit();
                }
            }
        } else {
            echo "<script>alert('Impossible de récupérer les informations utilisateur !');
            window.location.href= '../login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Erreur lors de l\'authentification Google !');
        window.location.href= '../login.php';</script>";
        exit();
    }
}
?>
