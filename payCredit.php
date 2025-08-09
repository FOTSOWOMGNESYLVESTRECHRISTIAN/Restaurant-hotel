<?php
session_start();
require 'database/connection.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['Email'])) {
    echo "<script>alert('Veuillez vous connecter pour procéder au paiement.'); window.location.href='login.php';</script>";
    exit();
}

// Vérifier si le panier n'est pas vide (optionnel pour permettre les tests)
if (empty($_SESSION["cart"])) {
    // Afficher un avertissement mais permettre de continuer
    echo "<script>console.log('Session cart vide - mode test autorisé');</script>";
    // Ne pas rediriger, permettre l'accès à la page de paiement
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
    <title>FoodTiger - Paiement par Carte</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Paiement sécurisé par carte bancaire - Restaurant gastronomique d'hôtel">
    
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
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
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

        .card-info-section {
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

        .accepted-cards {
            margin-bottom: 2rem;
        }

        .cards-label {
            display: block;
            font-weight: 500;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .card-icons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .card-icons i {
            font-size: 2rem;
            color: var(--text-light);
            transition: all 0.3s ease;
        }

        .card-icons i:hover {
            color: var(--primary-color);
            transform: scale(1.1);
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
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 189, 0, 0.25);
            outline: none;
        }

        .form-control::placeholder {
            color: var(--text-light);
        }

        select.form-control {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        .form-actions {
            text-align: center;
            margin-top: 2rem;
        }

        .payment-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 50px;
            padding: 1rem 3rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(255, 189, 0, 0.3);
        }

        .payment-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(255, 189, 0, 0.4);
            color: white;
        }

        .security-info-card {
            background: var(--bg-white);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-left: 4px solid var(--success-color);
        }

        .security-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .security-header i {
            font-size: 3rem;
            color: var(--success-color);
            margin-bottom: 1rem;
        }

        .security-header h4 {
            color: var(--text-dark);
            font-weight: 600;
        }

        .security-features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .security-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            background: var(--bg-light);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .security-item:hover {
            background: var(--primary-color);
            color: white;
            transform: translateX(5px);
        }

        .security-item i {
            color: var(--success-color);
            font-size: 1.2rem;
        }

        .security-item:hover i {
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

            .card-icons {
                justify-content: center;
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
            border-top: 2px solid var(--primary-color);
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
                                Carte Bancaire
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
                                <i class="fas fa-credit-card me-2"></i>Paiement par Carte Bancaire
                            </h1>
                            <p class="form-subtitle">Remplissez les informations de votre carte en toute sécurité</p>
                        </div>

            <div class="row">
                            <!-- Payment Form -->
                            <div class="col-lg-8 col-md-12">
                                <form class="payment-form" action="database/creditpaycode.php" method="POST" id="paymentForm" data-aos="fade-up" data-aos-delay="100">
                                    <!-- Order Summary -->
                                    <div class="order-summary-card">
                                        <div class="summary-header">
                                            <h3 class="summary-title">
                                                <i class="fas fa-receipt me-2"></i>Récapitulatif de Commande
                                            </h3>
                                        </div>
                                        <div class="summary-content">
                                            <?php if (!empty($_SESSION["cart"])) { ?>
                                                <div class="summary-item">
                                                    <span class="item-label">Total de la commande:</span>
                                                    <span class="item-value total-price">€<?php echo number_format($gtotal, 2); ?></span>
                                                </div>
                                                <div class="summary-item">
                                                    <span class="item-label">Numéro de commande:</span>
                                                    <span class="item-value order-id"><?php echo $generateid; ?></span>
                                                </div>
                                            <?php } else { ?>
                                                <div class="summary-item">
                                                    <span class="item-label">Mode Test:</span>
                                                    <span class="item-value">Aucun article dans le panier</span>
                                                </div>
                                                <div class="summary-item">
                                                    <span class="item-label">Numéro de commande:</span>
                                                    <span class="item-value order-id"><?php echo $generateid; ?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <!-- Card Information -->
                                    <div class="card-info-section">
                                        <h3 class="section-title">
                                            <i class="fas fa-credit-card me-2"></i>Informations de la Carte
                                        </h3>
                                        
                                        <div class="accepted-cards">
                                            <label class="cards-label">Cartes Acceptées:</label>
                                            <div class="card-icons">
                                                <i class="fab fa-cc-visa" title="Visa"></i>
                                                <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                                                <i class="fab fa-cc-amex" title="American Express"></i>
                                                <i class="fab fa-cc-discover" title="Discover"></i>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="Name" class="form-label">
                                                    <i class="fas fa-user me-1"></i>Nom sur la Carte
                                                </label>
                                                <input type="text" 
                                                       id="Name" 
                                                       name="Name" 
                                                       value="<?php echo htmlspecialchars($_SESSION['Name']); ?>" 
                                                       class="form-control"
                                                       required>
                                                <div class="invalid-feedback">Veuillez entrer le nom sur la carte.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cardNumber" class="form-label">
                                                    <i class="fas fa-credit-card me-1"></i>Numéro de Carte
                                                </label>
                                                <input type="text" 
                                                       id="cardNumber" 
                                                       name="cardNumber" 
                                                       class="form-control"
                                                       placeholder="1234 5678 9012 3456"
                                                       maxlength="19"
                                                       required>
                                                <div class="invalid-feedback">Veuillez entrer un numéro de carte valide.</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="expMonth" class="form-label">
                                                    <i class="fas fa-calendar me-1"></i>Mois d'Expiration
                                                </label>
                                                <select id="expMonth" name="expMonth" class="form-control" required>
                                                    <option value="">Mois</option>
                                                    <option value="01">01 - Janvier</option>
                                                    <option value="02">02 - Février</option>
                                                    <option value="03">03 - Mars</option>
                                                    <option value="04">04 - Avril</option>
                                                    <option value="05">05 - Mai</option>
                                                    <option value="06">06 - Juin</option>
                                                    <option value="07">07 - Juillet</option>
                                                    <option value="08">08 - Août</option>
                                                    <option value="09">09 - Septembre</option>
                                                    <option value="10">10 - Octobre</option>
                                                    <option value="11">11 - Novembre</option>
                                                    <option value="12">12 - Décembre</option>
                    </select>
                                                <div class="invalid-feedback">Veuillez sélectionner le mois d'expiration.</div>
              </div>
                                            <div class="form-group">
                                                <label for="expYear" class="form-label">
                                                    <i class="fas fa-calendar me-1"></i>Année d'Expiration
                                                </label>
                                                <select id="expYear" name="expYear" class="form-control" required>
                                                    <option value="">Année</option>
                                                    <?php 
                                                        $currentYear = date('Y');
                                                        for($i = $currentYear; $i <= $currentYear + 10; $i++) {
                                                            echo "<option value='$i'>$i</option>";
                                                        }
                                                    ?>
                    </select>
                                                <div class="invalid-feedback">Veuillez sélectionner l'année d'expiration.</div>
              </div>
                                            <div class="form-group">
                                                <label for="cvv" class="form-label">
                                                    <i class="fas fa-lock me-1"></i>Code CVV
                                                </label>
                                                <input type="text" 
                                                       id="cvv" 
                                                       name="cvv" 
                                                       class="form-control"
                                                       placeholder="123"
                                                       maxlength="4"
                                                       required>
                                                <div class="invalid-feedback">Veuillez entrer un code CVV valide.</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="billingAddress" class="form-label">
                                                <i class="fas fa-map-marker-alt me-1"></i>Adresse de Facturation
                                            </label>
                                            <textarea id="billingAddress" 
                                                      name="billingAddress" 
                                                      class="form-control"
                                                      rows="3"
                                                      placeholder="Entrez votre adresse de facturation complète"
                                                      required><?php echo htmlspecialchars($_SESSION['Address']); ?></textarea>
                                            <div class="invalid-feedback">Veuillez entrer votre adresse de facturation.</div>
                                        </div>

                                        <!-- Hidden Fields -->
                                        <input type="hidden" name="order_id" value="<?php echo $generateid; ?>">
                                        <input type="hidden" name="total_amount" value="<?php echo $gtotal; ?>">
                                        <input type="hidden" name="customer_email" value="<?php echo htmlspecialchars($_SESSION['Email']); ?>">

                                        <!-- Submit Button -->
                                        <div class="form-actions">
                                            <?php if (!empty($_SESSION["cart"])) { ?>
                                                <button type="submit" 
                                                        class="btn btn-warning btn-lg payment-btn" 
                                                        name="Pay"
                                                        id="submitBtn">
                                                    <span class="loading-spinner"></span>
                                                    <i class="fas fa-lock me-2"></i>Payer €<?php echo number_format($gtotal, 2); ?>
                                                </button>
                                            <?php } else { ?>
                                                <button type="submit" 
                                                        class="btn btn-warning btn-lg payment-btn" 
                                                        name="Pay"
                                                        id="submitBtn">
                                                    <span class="loading-spinner"></span>
                                                    <i class="fas fa-lock me-2"></i>Paiement Test
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Security Info -->
                            <div class="col-lg-4 col-md-12">
                                <div class="security-info-card" data-aos="fade-up" data-aos-delay="200">
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
                                        <div class="security-item">
                                            <i class="fas fa-eye-slash"></i>
                                            <span>Données non stockées</span>
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
                                    </div>
        </div>
    </div>
  </div>

                        <!-- Cancel Button -->
                        <div class="cancel-section" data-aos="fade-up" data-aos-delay="400">
                            <a href="payment.php" class="btn btn-outline-danger btn-lg cancel-btn" onclick="return confirm('Êtes-vous sûr de vouloir annuler le paiement ?')">
                                <i class="fas fa-times me-2"></i>Annuler le Paiement
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

        // Formatage automatique du numéro de carte
        document.getElementById('cardNumber').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
            
            // Validation en temps réel
            validateCardNumber(value);
        });

        // Formatage automatique du CVV
        document.getElementById('cvv').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/gi, '');
            e.target.value = value;
            
            // Validation en temps réel
            validateCVV(value);
        });

        // Validation du numéro de carte
        function validateCardNumber(cardNumber) {
            const cardInput = document.getElementById('cardNumber');
            const isValid = cardNumber.length >= 13 && cardNumber.length <= 19;
            
            if (isValid) {
                cardInput.classList.remove('is-invalid');
                cardInput.classList.add('is-valid');
            } else {
                cardInput.classList.remove('is-valid');
                cardInput.classList.add('is-invalid');
            }
        }

        // Validation du CVV
        function validateCVV(cvv) {
            const cvvInput = document.getElementById('cvv');
            const isValid = cvv.length >= 3 && cvv.length <= 4;
            
            if (isValid) {
                cvvInput.classList.remove('is-invalid');
                cvvInput.classList.add('is-valid');
            } else {
                cvvInput.classList.remove('is-valid');
                cvvInput.classList.add('is-invalid');
            }
        }

        // Validation du formulaire complet
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const cardNumber = document.getElementById('cardNumber').value.replace(/\s+/g, '');
            const cvv = document.getElementById('cvv').value;
            const name = document.getElementById('Name').value;
            const expMonth = document.getElementById('expMonth').value;
            const expYear = document.getElementById('expYear').value;
            const billingAddress = document.getElementById('billingAddress').value;
            
            let isValid = true;
            
            // Validation du nom
            if (name.trim() === '') {
                document.getElementById('Name').classList.add('is-invalid');
                isValid = false;
            } else {
                document.getElementById('Name').classList.remove('is-invalid');
                document.getElementById('Name').classList.add('is-valid');
            }
            
            // Validation du numéro de carte
            if (cardNumber.length < 13 || cardNumber.length > 19) {
                document.getElementById('cardNumber').classList.add('is-invalid');
                isValid = false;
            } else {
                document.getElementById('cardNumber').classList.remove('is-invalid');
                document.getElementById('cardNumber').classList.add('is-valid');
            }
            
            // Validation du CVV
            if (cvv.length < 3 || cvv.length > 4) {
                document.getElementById('cvv').classList.add('is-invalid');
                isValid = false;
            } else {
                document.getElementById('cvv').classList.remove('is-invalid');
                document.getElementById('cvv').classList.add('is-valid');
            }
            
            // Validation du mois d'expiration
            if (expMonth === '') {
                document.getElementById('expMonth').classList.add('is-invalid');
                isValid = false;
            } else {
                document.getElementById('expMonth').classList.remove('is-invalid');
                document.getElementById('expMonth').classList.add('is-valid');
            }
            
            // Validation de l'année d'expiration
            if (expYear === '') {
                document.getElementById('expYear').classList.add('is-invalid');
                isValid = false;
            } else {
                document.getElementById('expYear').classList.remove('is-invalid');
                document.getElementById('expYear').classList.add('is-valid');
            }
            
            // Validation de l'adresse
            if (billingAddress.trim() === '') {
                document.getElementById('billingAddress').classList.add('is-invalid');
                isValid = false;
            } else {
                document.getElementById('billingAddress').classList.remove('is-invalid');
                document.getElementById('billingAddress').classList.add('is-valid');
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
            
            // Confirmation de paiement
            const total = <?php echo $gtotal; ?>;
            const confirmMessage = total > 0 ? 
                `Confirmez-vous le paiement de €${total.toFixed(2)} ?` : 
                'Mode test - Confirmez-vous le paiement ?';
                
            if (!confirm(confirmMessage)) {
                e.preventDefault();
                submitBtn.disabled = false;
                spinner.style.display = 'none';
                icon.style.display = 'inline-block';
                return false;
            }
        });

        // Animation des icônes de cartes
        document.addEventListener('DOMContentLoaded', function() {
            const cardIcons = document.querySelectorAll('.card-icons i');
            
            cardIcons.forEach((icon, index) => {
                setTimeout(() => {
                    icon.classList.add('pulse');
                    setTimeout(() => {
                        icon.classList.remove('pulse');
                    }, 500);
                }, index * 200);
            });

            // Animation des éléments de sécurité
            const securityItems = document.querySelectorAll('.security-item');
            securityItems.forEach((item, index) => {
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
    </script>
</body>
</html>