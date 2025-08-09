<?php
session_start();
require 'database/connection.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['Email'])) {
    echo "<script>alert('Veuillez vous connecter pour procéder au paiement.'); window.location.href='login.php';</script>";
    exit();
}

// Vérifier si le panier n'est pas vide
if (empty($_SESSION["cart"])) {
    echo "<script>alert('Votre panier est vide. Veuillez ajouter des articles avant de procéder au paiement.'); window.location.href='food.php';</script>";
    exit();
}

$generateid = uniqid();
$gtotal = 0;

foreach($_SESSION["cart"] as $keys => $values) {
    $foodname = $values["food_name"];
    $quantity = $values["food_quantity"];
    $price = $values["food_price"];
    $total = ($values["food_quantity"] * $values["food_price"]);
    $gtotal = $gtotal + $total;
  }

  if(isset($_SESSION['Email'])){
    $Email = $_SESSION['Email'];
    $sql = "select * from customer where Email = '$Email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['PhoneNo'] = $row['PhoneNo'];
            $_SESSION['Address'] = $row['Address'];
            $_SESSION['Password'] = $row['Password'];
        }
    }
 }
  ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>FoodTiger - Paiement en Espèces</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Paiement en espèces - Restaurant gastronomique d'hôtel">
    
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
    <style>
        :root {
            --primary-color: #FFBD00;
            --secondary-color: #FF8A00;
            --accent-color: #FF6B35;
            --text-dark: #2C3E50;
            --text-light: #7F8C8D;
            --bg-light: #F8F9FA;
            --bg-white: #FFFFFF;
            --border-color: #E9ECEF;
            --success-color: #28A745;
            --danger-color: #DC3545;
            --warning-color: #FFC107;
            --info-color: #17A2B8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: var(--text-dark);
        }

        .payment-header-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 2rem 0;
            margin-top: 80px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.8);
        }

        .breadcrumb-link {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .breadcrumb-link:hover {
            color: white;
            text-decoration: none;
        }

        .breadcrumb-item.active .breadcrumb-link {
            color: white;
            font-weight: 600;
        }

        .restaurant-info {
            text-align: right;
        }

        .restaurant-name {
            display: block;
            font-weight: 600;
            color: white;
            font-size: 1.1rem;
        }

        .restaurant-time {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
        }

        .payment-form-section {
            padding: 3rem 0;
        }

        .payment-form-container {
            background: var(--bg-white);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            position: relative;
        }

        .form-header {
            background: linear-gradient(135deg, var(--success-color) 0%, #20c997 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
        }

        .payment-form {
            padding: 2rem;
        }

        .order-summary-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .summary-header {
            margin-bottom: 1rem;
        }

        .summary-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin: 0;
        }

        .summary-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .summary-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .item-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .item-value {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .total-price {
            font-size: 1.5rem;
            color: var(--warning-color);
        }

        .order-id {
            font-family: 'Courier New', monospace;
            background: rgba(255,255,255,0.2);
            padding: 0.25rem 0.5rem;
            border-radius: 5px;
        }

        .cash-info-section {
            background: var(--bg-light);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        .cash-benefits {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .benefit-item {
            background: var(--bg-white);
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .benefit-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .benefit-item i {
            font-size: 2.5rem;
            color: var(--success-color);
            margin-bottom: 1rem;
        }

        .benefit-item h5 {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .benefit-item p {
            color: var(--text-light);
            font-size: 0.9rem;
            margin: 0;
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            flex: 1;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            display: block;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--bg-white);
        }

        .form-control:focus {
            border-color: var(--success-color);
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            outline: none;
        }

        .form-control::placeholder {
            color: var(--text-light);
        }

        .form-actions {
            text-align: center;
            margin-top: 2rem;
        }

        .payment-btn {
            background: linear-gradient(135deg, var(--success-color) 0%, #20c997 100%);
            border: none;
            border-radius: 50px;
            padding: 1rem 3rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
        }

        .payment-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(40, 167, 69, 0.4);
            color: white;
        }

        .cash-info-card {
            background: var(--bg-white);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-left: 4px solid var(--success-color);
        }

        .cash-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .cash-header i {
            font-size: 3rem;
            color: var(--success-color);
            margin-bottom: 1rem;
        }

        .cash-header h4 {
            color: var(--text-dark);
            font-weight: 600;
        }

        .cash-features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .cash-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            background: var(--bg-light);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .cash-item:hover {
            background: var(--success-color);
            color: white;
            transform: translateX(5px);
        }

        .cash-item i {
            color: var(--success-color);
            font-size: 1.2rem;
        }

        .cash-item:hover i {
            color: white;
        }

        .restaurant-info-card {
            background: var(--bg-white);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-left: 4px solid var(--info-color);
        }

        .info-header h4 {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .info-content {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .info-item i {
            color: var(--info-color);
            font-size: 1.2rem;
            margin-top: 0.25rem;
        }

        .info-details h6 {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--text-dark);
        }

        .info-details p {
            color: var(--text-light);
            margin: 0;
            font-size: 0.9rem;
        }

        .cancel-section {
            text-align: center;
            padding: 2rem;
            border-top: 1px solid var(--border-color);
        }

        .cancel-btn {
            border: 2px solid var(--danger-color);
            border-radius: 50px;
            padding: 0.75rem 2rem;
            color: var(--danger-color);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .cancel-btn:hover {
            background: var(--danger-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-title {
                font-size: 2rem;
            }

            .form-row {
                flex-direction: column;
            }

            .summary-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .cash-benefits {
                grid-template-columns: 1fr;
            }

            .payment-btn {
                width: 100%;
                padding: 1rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .pulse {
            animation: pulse 0.5s ease-in-out;
        }

        /* Loading Spinner */
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid var(--success-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 0.5rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Form Validation Styles */
        .form-control.is-invalid {
            border-color: var(--danger-color);
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .form-control.is-valid {
            border-color: var(--success-color);
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .invalid-feedback {
            display: block;
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .valid-feedback {
            display: block;
            color: var(--success-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
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
                            <li class="breadcrumb-item">
                                <a href="payment.php" class="breadcrumb-link">Paiement</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Paiement en Espèces
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

    <!-- Payment Form Section -->
    <section class="payment-form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="payment-form-container" data-aos="fade-up">
                        <div class="form-header">
                            <h1 class="form-title">
                                <i class="fas fa-money-bill-wave me-2"></i>Paiement en Espèces
                            </h1>
                            <p class="form-subtitle">Paiement simple et sécurisé à la livraison</p>
                        </div>

                        <div class="row">
                            <!-- Payment Form -->
                            <div class="col-lg-8 col-md-12">
                                <form class="payment-form" action="database/cashCode.php" method="POST" id="cashPaymentForm" data-aos="fade-up" data-aos-delay="100">
                                    <!-- Order Summary -->
                                    <div class="order-summary-card">
                                        <div class="summary-header">
                                            <h3 class="summary-title">
                                                <i class="fas fa-receipt me-2"></i>Récapitulatif de Commande
                                            </h3>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-item">
                                                <span class="item-label">Total de la commande:</span>
                                                <span class="item-value total-price">€<?php echo number_format($gtotal, 2); ?></span>
                                            </div>
                                            <div class="summary-item">
                                                <span class="item-label">Numéro de commande:</span>
                                                <span class="item-value order-id"><?php echo $generateid; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cash Benefits -->
                                    <div class="cash-info-section">
                                        <h3 class="section-title">
                                            <i class="fas fa-hand-holding-usd me-2"></i>Avantages du Paiement en Espèces
                                        </h3>
                                        
                                        <div class="cash-benefits">
                                            <div class="benefit-item" data-aos="fade-up" data-aos-delay="200">
                                                <i class="fas fa-shield-alt"></i>
                                                <h5>Sécurisé</h5>
                                                <p>Paiement sécurisé à la livraison</p>
                                            </div>
                                            <div class="benefit-item" data-aos="fade-up" data-aos-delay="300">
                                                <i class="fas fa-clock"></i>
                                                <h5>Rapide</h5>
                                                <p>Pas de saisie de données bancaires</p>
                                            </div>
                                            <div class="benefit-item" data-aos="fade-up" data-aos-delay="400">
                                                <i class="fas fa-user-shield"></i>
                                                <h5>Confidentiel</h5>
                                                <p>Aucune information bancaire stockée</p>
                                            </div>
                                        </div>

                                        <!-- Customer Information -->
                                        <h3 class="section-title">
                                            <i class="fas fa-user me-2"></i>Informations Client
                                        </h3>
                                        
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="Name" class="form-label">
                                                    <i class="fas fa-user me-1"></i>Nom Complet
                                                </label>
                                                <input type="text" 
                                                       id="Name" 
                                                       name="Name" 
                                                       value="<?php echo htmlspecialchars($_SESSION['Name']); ?>" 
                                                       class="form-control"
                                                       required>
                                                <div class="invalid-feedback">Veuillez entrer votre nom complet.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="PhoneNo" class="form-label">
                                                    <i class="fas fa-phone me-1"></i>Numéro de Téléphone
                                                </label>
                                                <input type="text" 
                                                       id="PhoneNo" 
                                                       name="PhoneNo" 
                                                       value="<?php echo htmlspecialchars($_SESSION['PhoneNo']); ?>" 
                                                       class="form-control"
                                                       required>
                                                <div class="invalid-feedback">Veuillez entrer votre numéro de téléphone.</div>
    </div>
  </div>

                                        <div class="form-group">
                                            <label for="Address" class="form-label">
                                                <i class="fas fa-map-marker-alt me-1"></i>Adresse de Livraison
                                            </label>
                                            <textarea id="Address" 
                                                      name="Address" 
                                                      class="form-control"
                                                      rows="3"
                                                      placeholder="Entrez votre adresse de livraison complète"
                                                      required><?php echo htmlspecialchars($_SESSION['Address']); ?></textarea>
                                            <div class="invalid-feedback">Veuillez entrer votre adresse de livraison.</div>
                                        </div>

                                        <!-- Hidden Fields -->
                                        <input type="hidden" name="Email" value="<?php echo htmlspecialchars($_SESSION['Email']); ?>">
                                        <input type="hidden" name="price" value="<?php echo $gtotal; ?>">
                                        <input type="hidden" name="order_id" value="<?php echo $generateid; ?>">
                                        <input type="hidden" name="Card" value="-">
                                        <input type="hidden" name="Month" value="-">
                                        <input type="hidden" name="Year" value="-">
                                        <input type="hidden" name="CCV" value="-">

                                        <!-- Submit Button -->
                                        <div class="form-actions">
                                            <button type="submit" 
                                                    class="btn btn-success btn-lg payment-btn" 
                                                    name="Pay"
                                                    id="submitBtn">
                                                <span class="loading-spinner"></span>
                                                <i class="fas fa-check me-2"></i>Confirmer la Commande - €<?php echo number_format($gtotal, 2); ?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Cash Info -->
                            <div class="col-lg-4 col-md-12">
                                <div class="cash-info-card" data-aos="fade-up" data-aos-delay="200">
                                    <div class="cash-header">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <h4>Paiement en Espèces</h4>
                                    </div>
                                    <div class="cash-features">
                                        <div class="cash-item">
                                            <i class="fas fa-truck"></i>
                                            <span>Livraison à domicile</span>
                                        </div>
                                        <div class="cash-item">
                                            <i class="fas fa-credit-card"></i>
                                            <span>Paiement à la livraison</span>
                                        </div>
                                        <div class="cash-item">
                                            <i class="fas fa-receipt"></i>
                                            <span>Reçu détaillé</span>
                                        </div>
                                        <div class="cash-item">
                                            <i class="fas fa-clock"></i>
                                            <span>Livraison rapide</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Restaurant Info -->
                                <div class="restaurant-info-card" data-aos="fade-up" data-aos-delay="300">
                                    <div class="info-header">
                                        <h4>
                                            <i class="fas fa-info-circle me-2"></i>Informations Restaurant
                                        </h4>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div class="info-details">
                                                <h6>Localisation</h6>
                                                <p>Restaurant de l'Hôtel • 1er étage</p>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-phone"></i>
                                            <div class="info-details">
                                                <h6>Contact</h6>
                                                <p>Réception: +33 1 23 45 67 89</p>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-clock"></i>
                                            <div class="info-details">
                                                <h6>Horaires</h6>
                                                <p>Déjeuner: 12h-14h • Dîner: 19h-22h</p>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-truck"></i>
                                            <div class="info-details">
                                                <h6>Livraison</h6>
                                                <p>30-45 minutes • Gratuite dès €25</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cancel Button -->
                        <div class="cancel-section" data-aos="fade-up" data-aos-delay="400">
                            <a href="payment.php" class="btn btn-outline-danger btn-lg cancel-btn" onclick="return confirm('Êtes-vous sûr de vouloir annuler la commande ?')">
                                <i class="fas fa-times me-2"></i>Annuler la Commande
                            </a>
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

        // Validation du formulaire
        document.getElementById('cashPaymentForm').addEventListener('submit', function(e) {
            const name = document.getElementById('Name').value;
            const phoneNo = document.getElementById('PhoneNo').value;
            const address = document.getElementById('Address').value;
            
            let isValid = true;
            
            // Validation du nom
            if (name.trim() === '') {
                document.getElementById('Name').classList.add('is-invalid');
                isValid = false;
            } else {
                document.getElementById('Name').classList.remove('is-invalid');
                document.getElementById('Name').classList.add('is-valid');
            }
            
            // Validation du numéro de téléphone
            if (phoneNo.trim() === '') {
                document.getElementById('PhoneNo').classList.add('is-invalid');
                isValid = false;
            } else {
                document.getElementById('PhoneNo').classList.remove('is-invalid');
                document.getElementById('PhoneNo').classList.add('is-valid');
            }
            
            // Validation de l'adresse
            if (address.trim() === '') {
                document.getElementById('Address').classList.add('is-invalid');
                isValid = false;
            } else {
                document.getElementById('Address').classList.remove('is-invalid');
                document.getElementById('Address').classList.add('is-valid');
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Veuillez corriger les erreurs dans le formulaire avant de continuer.');
                return false;
            }
            
            // Afficher le spinner de chargement
            const submitBtn = document.getElementById('submitBtn');
            const spinner = submitBtn.querySelector('.loading-spinner');
            const icon = submitBtn.querySelector('i');
            
            submitBtn.disabled = true;
            spinner.style.display = 'inline-block';
            icon.style.display = 'none';
            
            // Confirmation de commande
            const total = <?php echo $gtotal; ?>;
            const confirmMessage = `Confirmez-vous la commande de €${total.toFixed(2)} ? Le paiement se fera en espèces à la livraison.`;
                
            if (!confirm(confirmMessage)) {
                e.preventDefault();
                submitBtn.disabled = false;
                spinner.style.display = 'none';
                icon.style.display = 'inline-block';
                return false;
            }
        });

        // Animation des éléments
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des éléments de bénéfices
            const benefitItems = document.querySelectorAll('.benefit-item');
            benefitItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('fade-in-up');
                }, index * 200);
            });

            // Animation des éléments de paiement en espèces
            const cashItems = document.querySelectorAll('.cash-item');
            cashItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('fade-in-up');
                }, index * 300);
            });
        });

        // Validation en temps réel des champs
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '' && this.hasAttribute('required')) {
                    this.classList.add('is-invalid');
                } else if (this.value.trim() !== '') {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });

        // Formatage automatique du numéro de téléphone
        document.getElementById('PhoneNo').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9+\-\s\(\)]/gi, '');
            e.target.value = value;
        });
    </script>
</body>
</html>