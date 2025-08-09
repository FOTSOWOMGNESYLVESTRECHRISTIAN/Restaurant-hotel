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
 } else {
    echo "<script>alert('Veuillez vous connecter pour accéder à votre profil.'); window.location.href='login.php';</script>";
    exit();
 }
?>
<!DOCTYPE html>  
<html lang="fr">  
 <head>  
    <title>FoodTiger - Profil Utilisateur</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Consultez et gérez votre profil utilisateur - FoodTiger Restaurant">
    
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
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
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

        .profile-section {
            padding: 4rem 0;
            background: var(--bg-white);
        }

        .profile-container {
            background: var(--bg-white);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .profile-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .profile-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .profile-avatar {
            text-align: center;
            margin: 2rem 0;
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid var(--primary-color);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .profile-info {
            padding: 3rem;
        }

        .info-group {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: var(--bg-light);
            border-radius: 15px;
            border-left: 4px solid var(--primary-color);
        }

        .info-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1.1rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        .profile-actions {
            padding: 2rem 3rem;
            background: var(--bg-light);
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .action-card {
            background: var(--bg-white);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--text-dark);
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            color: var(--text-dark);
            text-decoration: none;
        }

        .action-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
        }

        .action-card h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .action-card p {
            color: var(--text-light);
            font-size: 0.9rem;
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .profile-info {
                padding: 2rem 1.5rem;
            }

            .profile-actions {
                padding: 2rem 1.5rem;
            }

            .action-grid {
                grid-template-columns: 1fr;
            }

            .avatar {
                width: 100px;
                height: 100px;
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

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
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
                                Mon Profil
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">Mon Profil</h1>
                <p class="hero-subtitle">Gérez vos informations personnelles et vos préférences</p>
            </div>
        </div>
    </section>

    <!-- Profile Section -->
    <section class="profile-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="profile-container" data-aos="fade-up">
                        <div class="profile-header">
                            <h2 class="profile-title">
                                <i class="fas fa-user me-2"></i>Profil Utilisateur
                            </h2>
                            <p class="profile-subtitle">Bienvenue, <?php echo htmlspecialchars($_SESSION['Name']); ?> !</p>
                        </div>

                        <div class="profile-avatar" data-aos="fade-up" data-aos-delay="100">
      <img src="image/avatar6.png" alt="Avatar" class="avatar">
    </div>

                        <div class="profile-info" data-aos="fade-up" data-aos-delay="200">
                            <div class="info-group">
                                <label class="info-label">
                                    <i class="fas fa-user me-2"></i>Nom d'utilisateur
                                </label>
                                <div class="info-value"><?php echo htmlspecialchars($_SESSION['Name']); ?></div>
                            </div>

                            <div class="info-group">
                                <label class="info-label">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <div class="info-value"><?php echo htmlspecialchars($_SESSION['Email']); ?></div>
                            </div>

                            <div class="info-group">
                                <label class="info-label">
                                    <i class="fas fa-phone me-2"></i>Numéro de téléphone
                                </label>
                                <div class="info-value"><?php echo htmlspecialchars($_SESSION['PhoneNo']); ?></div>
                            </div>

                            <div class="info-group">
                                <label class="info-label">
                                    <i class="fas fa-map-marker-alt me-2"></i>Adresse
                                </label>
                                <div class="info-value"><?php echo htmlspecialchars($_SESSION['Address']); ?></div>
                            </div>
                        </div>

                        <div class="profile-actions" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="text-center mb-4">
                                <i class="fas fa-cogs me-2"></i>Actions Rapides
                            </h3>
                            <div class="action-grid">
                                <a href="editprofile.php" class="action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-user-edit"></i>
                                    </div>
                                    <h5>Modifier le Profil</h5>
                                    <p>Mettez à jour vos informations personnelles</p>
                                </a>

                                <a href="paymenthistory.php" class="action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-history"></i>
                                    </div>
                                    <h5>Historique des Paiements</h5>
                                    <p>Consultez vos commandes passées</p>
                                </a>

                                <a href="feedback.php" class="action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-comments"></i>
                                    </div>
                                    <h5>Avis & Commentaires</h5>
                                    <p>Partagez votre expérience avec nous</p>
                                </a>

                                <a href="category.php" class="action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-utensils"></i>
                                    </div>
                                    <h5>Commander</h5>
                                    <p>Découvrez nos délicieux plats</p>
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

        // Animation des cartes d'action
        document.addEventListener('DOMContentLoaded', function() {
            const actionCards = document.querySelectorAll('.action-card');
            actionCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('fade-in-up');
                }, index * 200);
            });
        });
    </script>
</body>
</html>
 