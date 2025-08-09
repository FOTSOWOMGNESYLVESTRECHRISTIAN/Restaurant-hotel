<?php
require 'connection.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['Email'])) {
    echo "<script>alert('Veuillez vous connecter pour procéder au paiement.'); window.location.href='../login.php';</script>";
    exit();
}

// Vérifier si le panier n'est pas vide
if (empty($_SESSION["cart"])) {
    echo "<script>alert('Votre panier est vide.'); window.location.href='../food.php';</script>";
    exit();
}

$gtotal = 0;
$orderSuccess = true;

foreach($_SESSION["cart"] as $keys => $values) {
    $foodname = $values["food_name"];
    $quantity = $values["food_quantity"];
    $price = $values["food_price"];
    $total = ($values["food_quantity"] * $values["food_price"]);
    $username = $_SESSION['Email'];
    $gtotal = $gtotal + $total;
    
    // Requête SQL corrigée (virgule en trop supprimée)
    $query = "INSERT INTO orders (foodname, price, quantity, username) 
              VALUES ('" . $foodname . "','" . $price . "','" . $quantity . "','" . $username . "')";
    
              $success = $conn->query($query);         
    
    if (!$success) {
        $orderSuccess = false;
        break;
    }
}

if ($orderSuccess) {
    // Ne pas vider le panier ici, le garder pour le processus de paiement
    // Le panier sera vidé après un paiement réussi
              echo "<script>window.location.href='../payment.php';</script>";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <title>FoodTiger - Erreur de Commande</title>
        <link rel="shortcut icon" type="image/x-icon" href="../image/logo 256x256.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- AOS Animation Library -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
            }
            
            .error-container {
                background: #fff;
                border-radius: 20px;
                padding: 3rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                text-align: center;
                max-width: 600px;
                margin: 0 auto;
            }
            
            .error-icon {
                font-size: 4rem;
                color: #dc3545;
                margin-bottom: 2rem;
            }
            
            .error-title {
                font-size: 2.5rem;
                font-weight: 700;
                color: #2c3e50;
                margin-bottom: 1rem;
                font-family: 'Playfair Display', serif;
            }
            
            .error-message {
                font-size: 1.2rem;
                color: #7f8c8d;
                margin-bottom: 2rem;
                line-height: 1.6;
            }
            
            .error-actions {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }
            
            .error-actions .btn {
                border-radius: 15px;
                font-weight: 600;
                transition: all 0.3s ease;
                padding: 12px 24px;
            }
            
            .error-actions .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            }
            
            .restaurant-info {
                background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
                color: #fff;
                border-radius: 15px;
                padding: 1.5rem;
                margin-top: 2rem;
            }
            
            .detail-item {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 1rem;
                font-size: 0.9rem;
            }
            
            .detail-item:last-child {
                margin-bottom: 0;
            }
            
            .detail-item i {
                color: #e67e22;
                font-size: 1rem;
                width: 20px;
            }
            
            .detail-item span {
                color: #ecf0f1;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="error-container" data-aos="fade-up">
                <div class="error-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                
                <h1 class="error-title">Erreur de Commande</h1>
                <p class="error-message">
                    Une erreur s'est produite lors du traitement de votre commande. 
                    Veuillez réessayer ou contactez notre équipe pour assistance.
                </p>
                
                <div class="error-actions">
                    <a href="../cart.php" class="btn btn-warning">
                        <i class="fas fa-shopping-cart me-2"></i>Retour au panier
                    </a>
                    <a href="../food.php" class="btn btn-outline-warning">
                        <i class="fas fa-utensils me-2"></i>Continuer mes achats
                    </a>
                    <a href="../index.php" class="btn btn-outline-secondary">
                        <i class="fas fa-home me-2"></i>Accueil
                    </a>
                </div>
                
                <div class="restaurant-info">
                    <div class="detail-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Restaurant de l'Hôtel • 1er étage</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-phone"></i>
                        <span>Réception: +33 1 23 45 67 89</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Service: 12h-14h • 19h-22h</span>
                    </div>
                </div>
          </div>
        </div>
        
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- AOS Animation Library -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        
        <script>
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });
        </script>
    </body>
    </html>
        <?php
  }
        ?>