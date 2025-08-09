<?php
session_start();
require 'database/connection.php';

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

unset($_SESSION["cart"]);
$Email = $_SESSION['Email'];
$sql = "select * from payment where Email = '$Email' ORDER BY time_date DESC LIMIT 1";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
     $_SESSION['id']=$row['id'];
     $_SESSION['order_id']=$row['order_id'];
     $_SESSION['Email']=$row['Email'];
     $_SESSION['Name']=$row['Name'];
     $_SESSION['PhoneNo']=$row['PhoneNo'];
     $_SESSION['Address']=$row['Address'];
     $_SESSION['price']=$row['price'];
     $_SESSION['Card']=$row['Card'];
     $_SESSION['Month']=$row['Month'];
     $_SESSION['Year']=$row['Year'];
     $_SESSION['CCV']=$row['CCV'];
     $_SESSION['time_date']=$row['time_date'];
}
} else {
  $_SESSION['id']='';
  $_SESSION['order_id']='';
  $_SESSION['Email']='';
  $_SESSION['Name']='';
  $_SESSION['PhoneNo']='';
  $_SESSION['Address']='';
  $_SESSION['price']='';
  $_SESSION['Card']='';
  $_SESSION['Month']='';
  $_SESSION['Year']='';
  $_SESSION['CCV']='';
  $_SESSION['time_date']='';
}
  ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>FoodTiger - Reçu de Commande</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Reçu de votre commande - FoodTiger Restaurant">
    
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
            color: var(--text-dark);
            line-height: 1.6;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--success-color) 0%, #20c997 100%);
            padding: 6rem 0 3rem 0;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('image/food.jpg') center/cover;
            opacity: 0.1;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
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

        .receipt-section {
            padding: 4rem 0;
            background: var(--bg-white);
        }

        .receipt-container {
            background: var(--bg-white);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .receipt-header {
            background: linear-gradient(135deg, var(--success-color) 0%, #20c997 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .receipt-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .receipt-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 3rem;
            color: white;
        }

        .receipt-content {
            padding: 3rem;
        }

        .order-info {
            background: var(--bg-light);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .order-number {
            font-family: 'Courier New', monospace;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            background: rgba(255, 189, 0, 0.1);
            padding: 1rem 2rem;
            border-radius: 25px;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .order-status {
            background: linear-gradient(135deg, var(--success-color), #20c997);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .info-card {
            background: var(--bg-white);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-left: 4px solid var(--primary-color);
        }

        .info-card h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-card p {
            color: var(--text-dark);
            font-size: 1.1rem;
            margin: 0;
        }

        .delivery-info {
            background: linear-gradient(135deg, var(--info-color), #138496);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .delivery-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .delivery-details {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .delivery-icon {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-custom {
            border-radius: 50px;
            padding: 1rem 2rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 189, 0, 0.3);
            color: white;
        }

        .btn-outline-custom {
            background: transparent;
            color: var(--text-dark);
            border: 2px solid var(--text-dark);
        }

        .btn-outline-custom:hover {
            background: var(--text-dark);
            color: white;
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .receipt-content {
                padding: 2rem 1.5rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-custom {
                width: 100%;
                max-width: 300px;
                justify-content: center;
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
    </style>
</head>
<body>
    <!-- Header -->
    <header class="sticky-top">
        <?php 
          require "navandfooter/nav.php";
        ?>        
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php" class="breadcrumb-link">
                                    <i class="fas fa-home me-2"></i>Accueil
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Reçu de Commande
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="hero-content" data-aos="fade-up">
                <div class="success-icon" data-aos="pulse" data-aos-delay="200">
                    <i class="fas fa-check"></i>
                </div>
                <h1 class="hero-title">Commande Confirmée !</h1>
                <p class="hero-subtitle">Votre commande a été traitée avec succès</p>
            </div>
        </div>
    </section>

    <!-- Receipt Section -->
    <section class="receipt-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="receipt-container" data-aos="fade-up">
                        <div class="receipt-header">
                            <h2 class="receipt-title">
                                <i class="fas fa-receipt me-2"></i>Reçu de Commande
                            </h2>
                            <p class="receipt-subtitle">Merci pour votre commande !</p>
                        </div>

                        <div class="receipt-content" data-aos="fade-up" data-aos-delay="100">
                            <div class="order-info">
                                <div class="text-center mb-4">
                                    <div class="order-number">
                                        <i class="fas fa-hashtag me-2"></i>
                                        <?php echo $_SESSION['order_id']; ?>
                                    </div>
                                    <div class="order-status">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Commande Confirmée
                                    </div>
                                </div>
                                <p class="text-center mb-0">
                                    <strong>Date de commande :</strong> 
                                    <?php echo date('d/m/Y à H:i', strtotime($_SESSION['time_date'])); ?>
                                </p>
                            </div>

                            <div class="info-grid">
                                <div class="info-card" data-aos="fade-up" data-aos-delay="200">
                                    <h5>
                                        <i class="fas fa-user text-primary"></i>
                                        Informations Client
                                    </h5>
                                    <p><strong>Nom :</strong> <?php echo htmlspecialchars($_SESSION['Name']); ?></p>
                                    <p><strong>Email :</strong> <?php echo htmlspecialchars($_SESSION['Email']); ?></p>
                                    <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($_SESSION['PhoneNo']); ?></p>
                                </div>

                                <div class="info-card" data-aos="fade-up" data-aos-delay="300">
                                    <h5>
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                        Adresse de Livraison
                                    </h5>
                                    <p><?php echo htmlspecialchars($_SESSION['Address']); ?></p>
                                </div>

                                <div class="info-card" data-aos="fade-up" data-aos-delay="400">
                                    <h5>
                                        <i class="fas fa-credit-card text-primary"></i>
                                        Informations de Paiement
                                    </h5>
                                    <p><strong>Montant :</strong> €<?php echo number_format($_SESSION['price'], 2); ?></p>
                                    <p><strong>Méthode :</strong> Carte bancaire</p>
                                    <p><strong>Statut :</strong> <span class="text-success">Payé</span></p>
                                </div>
                            </div>

                            <div class="delivery-info" data-aos="fade-up" data-aos-delay="500">
                                <h4 class="delivery-title">
                                    <i class="fas fa-truck me-2"></i>Informations de Livraison
                                </h4>
                                <div class="delivery-details">
                                    <div class="delivery-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <h6>Délai de livraison estimé</h6>
                                        <p>30-45 minutes</p>
                                    </div>
                                </div>
                                <div class="delivery-details">
                                    <div class="delivery-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h6>Zone de livraison</h6>
                                        <p>Dans un rayon de 5km autour du restaurant</p>
                                    </div>
                                </div>
                                <div class="delivery-details">
                                    <div class="delivery-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h6>Contact</h6>
                                        <p>+33 1 23 45 67 89 (en cas de problème)</p>
                                    </div>
                                </div>
</div>

                            <div class="action-buttons" data-aos="fade-up" data-aos-delay="600">
                                <a href="category.php" class="btn btn-primary-custom btn-custom">
                                    <i class="fas fa-utensils"></i>
                                    Commander à Nouveau
                                </a>
                                <a href="userprofile.php" class="btn btn-outline-custom btn-custom">
                                    <i class="fas fa-user"></i>
                                    Mon Profil
                                </a>
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

        // Animation de l'icône de succès
        document.addEventListener('DOMContentLoaded', function() {
            const successIcon = document.querySelector('.success-icon');
            if (successIcon) {
                setTimeout(() => {
                    successIcon.classList.add('pulse');
                    setTimeout(() => {
                        successIcon.classList.remove('pulse');
                    }, 500);
                }, 1000);
            }
        });
    </script>
</body>
</html>