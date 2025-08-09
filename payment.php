<?php
include "database/connection.php";

session_start();  
if(isset($_SESSION['Email'])){
    $Email=$_SESSION['Email'];
    $sql="select * from customer where Email = '$Email'";
    $result=$conn->query($sql);
     if($result->num_rows>0){
         while($row=$result->fetch_assoc()){
            $_SESSION['Name']=$row['Name'];
            $_SESSION['Email']=$row['Email'];
            $_SESSION['PhoneNo']=$row['PhoneNo'];
            $_SESSION['Address']=$row['Address'];
            $_SESSION['Password']=$row['Password'];
      }
    }
 }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>FoodTiger - Paiement</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Choisissez votre méthode de paiement - Restaurant gastronomique d'hôtel">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/nav-bar.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/payment.css">
</head>

<body>
    <!-- Header -->
    <header class="sticky-top">
        <?php 
          require "navandfooter/nav.php";
        ?>        
    </header>

    <!-- Payment Header Section -->
    <section class="payment-header-section">
    <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php" class="breadcrumb-link">
                                    <i class="fas fa-home me-2"></i>Accueil
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="cart.php" class="breadcrumb-link">Panier</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Paiement
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4 text-end">
                    <div class="restaurant-info">
                        <span class="restaurant-name">Restaurant Gastronomique</span>
                        <span class="restaurant-time">Ouvert • 12h-14h • 19h-22h</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Options Section -->
    <section class="payment-options-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="payment-container" data-aos="fade-up">
                        <div class="payment-header">
                            <h1 class="payment-title">
                                <i class="fas fa-credit-card me-2"></i>Choisissez votre méthode de paiement
                            </h1>
                            <p class="payment-subtitle">Sélectionnez l'option qui vous convient le mieux</p>
                        </div>

                        <div class="payment-options-grid">
                            <!-- Credit Card Option -->
                            <div class="payment-option-card" data-aos="fade-up" data-aos-delay="100">
                                <a href="payCredit.php" class="payment-link">
                                    <div class="option-icon">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <div class="option-content">
                                        <h3 class="option-title">Carte de Crédit/Débit</h3>
                                        <p class="option-description">
                                            Paiement sécurisé par carte bancaire. 
                                            Nous acceptons Visa, Mastercard et American Express.
                                        </p>
                                        <div class="option-features">
                                            <span class="feature-tag">
                                                <i class="fas fa-shield-alt me-1"></i>Sécurisé
                                            </span>
                                            <span class="feature-tag">
                                                <i class="fas fa-bolt me-1"></i>Rapide
                                            </span>
                                            <span class="feature-tag">
                                                <i class="fas fa-globe me-1"></i>International
                                            </span>
                                        </div>
                                    </div>
                                    <div class="option-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </a>
                            </div>

                            <!-- Cash on Delivery Option -->
                            <div class="payment-option-card" data-aos="fade-up" data-aos-delay="200">
                                <a href="payCash.php" class="payment-link">
                                    <div class="option-icon">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="option-content">
                                        <h3 class="option-title">Paiement à la Livraison</h3>
                                        <p class="option-description">
                                            Payez en espèces lors de la livraison de votre commande. 
                                            Option pratique et fiable.
                                        </p>
                                        <div class="option-features">
                                            <span class="feature-tag">
                                                <i class="fas fa-hand-holding-usd me-1"></i>Espèces
                                            </span>
                                            <span class="feature-tag">
                                                <i class="fas fa-truck me-1"></i>À la livraison
                                            </span>
                                            <span class="feature-tag">
                                                <i class="fas fa-check-circle me-1"></i>Simple
                                            </span>
                                        </div>
                                    </div>
                                    <div class="option-arrow">
                                        <i class="fas fa-arrow-right"></i>
            </div>
            </a>
                            </div>

                            <!-- Cancel Option -->
                            <div class="payment-option-card cancel-option" data-aos="fade-up" data-aos-delay="300">
                                <a href="database/Cancel.php" class="payment-link">
                                    <div class="option-icon">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                    <div class="option-content">
                                        <h3 class="option-title">Annuler la Commande</h3>
                                        <p class="option-description">
                                            Annulez votre commande et retournez à la carte. 
                                            Vous pouvez recommander à tout moment.
                                        </p>
                                        <div class="option-features">
                                            <span class="feature-tag">
                                                <i class="fas fa-undo me-1"></i>Annulation
                                            </span>
                                            <span class="feature-tag">
                                                <i class="fas fa-arrow-left me-1"></i>Retour
                                            </span>
                                            <span class="feature-tag">
                                                <i class="fas fa-clock me-1"></i>Gratuit
                                            </span>
                                        </div>
      </div>
                                    <div class="option-arrow">
                                        <i class="fas fa-arrow-right"></i>
            </div>
            </a>
                            </div>
                        </div>

                        <!-- Payment Security Info -->
                        <div class="payment-security" data-aos="fade-up" data-aos-delay="400">
                            <div class="security-header">
                                <i class="fas fa-shield-alt"></i>
                                <h4>Paiement Sécurisé</h4>
                            </div>
                            <div class="security-features">
                                <div class="security-item">
                                    <i class="fas fa-lock"></i>
                                    <span>Chiffrement SSL 256-bit</span>
                                </div>
                                <div class="security-item">
                                    <i class="fas fa-user-shield"></i>
                                    <span>Protection des données</span>
                                </div>
                                <div class="security-item">
                                    <i class="fas fa-certificate"></i>
                                    <span>Certification PCI DSS</span>
                                </div>
                            </div>
                        </div>
                    </div>
      </div>
            </div>
        </div>
    </section>

    <!-- Restaurant Info Section -->
    <section class="restaurant-info-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="restaurant-info-card" data-aos="fade-up">
                        <div class="info-header">
                            <h3 class="info-title">
                                <i class="fas fa-info-circle me-2"></i>Informations Restaurant
                            </h3>
                        </div>
                        <div class="info-content">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="info-details">
                                    <h5>Localisation</h5>
                                    <p>Restaurant de l'Hôtel • 1er étage</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <div class="info-details">
                                    <h5>Contact</h5>
                                    <p>Réception: +33 1 23 45 67 89</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <div class="info-details">
                                    <h5>Horaires de Service</h5>
                                    <p>Déjeuner: 12h-14h • Dîner: 19h-22h</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-credit-card"></i>
                                <div class="info-details">
                                    <h5>Moyens de Paiement</h5>
                                    <p>Cartes bancaires, espèces, chèques</p>
                                </div>
                            </div>
                        </div>
                    </div>
      </div>
    </div>
</div>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <?php 
          include "navandfooter/footer.php";
        ?>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Initialiser AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Animation des cartes de paiement
        document.addEventListener('DOMContentLoaded', function() {
            const paymentCards = document.querySelectorAll('.payment-option-card');
            
            paymentCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px)';
                    this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
                });
            });

            // Animation des icônes de sécurité
            const securityItems = document.querySelectorAll('.security-item');
            securityItems.forEach((item, index) => {
                setTimeout(() => {
                    item.style.animation = 'pulse 0.5s ease-in-out';
                    setTimeout(() => {
                        item.style.animation = '';
                    }, 500);
                }, index * 200);
            });
        });
    </script>
</body>
</html>