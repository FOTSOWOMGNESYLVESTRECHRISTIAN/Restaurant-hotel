<?php
session_start();
require 'connection.php';
require 'oauth_config.php';

function base_url() {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    return $scheme . '://' . $host . $dir;
}

function safe_redirect_path($path) {
    if (empty($path)) return '../index.php';
    if (preg_match('/^https?:\/\//i', $path) || strpos($path, '//') === 0) {
        return '../index.php';
    }
    $path = ltrim($path, "/");
    $allowed = ['index.php','userprofile.php','cart.php','category.php','food.php','aboutus.php'];
    if (in_array($path, $allowed, true)) return '../' . $path;
    return '../index.php';
}

$final_redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
$runtime_redirect_uri = base_url() . '/facebook_login.php';

// Si l'utilisateur n'est pas connecté via Facebook, rediriger vers l'autorisation
if (!isset($_GET['code'])) {
    $auth_url = FACEBOOK_AUTH_URL . '?' . http_build_query([
        'client_id' => FACEBOOK_APP_ID,
        'redirect_uri' => $runtime_redirect_uri,
        'scope' => 'email,public_profile',
        'response_type' => 'code',
        'state' => urlencode($final_redirect)
    ]);
    
    header('Location: ' . $auth_url);
    exit();
}

// Récupérer le redirect demandé via state si présent
if (isset($_GET['state'])) {
    $decoded = urldecode($_GET['state']);
    if (!empty($decoded)) {
        $final_redirect = $decoded;
    }
}

// Si on a un code d'autorisation, traiter la connexion
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    
    // Échanger le code contre un token d'accès
    $token_data = [
        'client_id' => FACEBOOK_APP_ID,
        'client_secret' => FACEBOOK_APP_SECRET,
        'code' => $code,
        'redirect_uri' => $runtime_redirect_uri
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, FACEBOOK_TOKEN_URL . '?' . http_build_query($token_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $token_response = curl_exec($ch);
    curl_close($ch);
    
    $token_info = json_decode($token_response, true);
    
    if (isset($token_info['access_token'])) {
        // Récupérer les informations de l'utilisateur
        $user_info_url = FACEBOOK_USERINFO_URL . '?fields=id,name,email&access_token=' . $token_info['access_token'];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $user_info_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $user_response = curl_exec($ch);
        curl_close($ch);
        
        $user_info = json_decode($user_response, true);
        
        if (isset($user_info['email'])) {
            $email = mysqli_real_escape_string($conn, $user_info['email']);
            $name = mysqli_real_escape_string($conn, $user_info['name'] ?? '');
            $facebook_id = mysqli_real_escape_string($conn, $user_info['id'] ?? '');
            
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
                
                header('location: ' . safe_redirect_path($final_redirect));
                exit();
            } else {
                // Créer un nouveau compte
                $hashed_password = password_hash($facebook_id, PASSWORD_DEFAULT);
                $insert_query = "INSERT INTO customer (Name, Email, Password, PhoneNo, Address) 
                                VALUES ('$name', '$email', '$hashed_password', '', '')";
                
                if (mysqli_query($conn, $insert_query)) {
                    $new_user_id = mysqli_insert_id($conn);
                    $_SESSION['cus_id'] = $new_user_id;
                    $_SESSION['Name'] = $name;
                    $_SESSION['Email'] = $email;
                    $_SESSION['PhoneNo'] = '';
                    $_SESSION['Address'] = '';
                    
                    header('location: ' . safe_redirect_path($final_redirect));
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
        echo "<script>alert('Erreur lors de l\'authentification Facebook !');
        window.location.href= '../login.php';</script>";
        exit();
    }
}
?>
