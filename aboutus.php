<?php
session_start();  
require 'database/connection.php';

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
    <title>FoodTiger - À Propos de Nous</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Découvrez l'histoire de FoodTiger - Restaurant gastronomique d'excellence avec une passion pour la cuisine et le service client">
    
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
            padding: 8rem 0 4rem 0;
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
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
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

        .about-section {
            padding: 5rem 0;
            background: var(--bg-white);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--text-dark);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            text-align: center;
            margin-bottom: 3rem;
        }

        .about-card {
            background: var(--bg-white);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            margin-bottom: 3rem;
            transition: all 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
        }

        .about-content {
            display: flex;
            align-items: center;
            gap: 3rem;
        }

        .about-text {
            flex: 1;
        }

        .about-text h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .about-text p {
            font-size: 1.1rem;
            color: var(--text-dark);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .about-image {
            flex: 1;
            text-align: center;
        }

        .about-image img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .about-image img:hover {
            transform: scale(1.05);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .feature-card {
            background: var(--bg-white);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }

        .feature-card h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: var(--text-light);
            line-height: 1.6;
        }

        .stats-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 4rem 0;
            color: white;
        }

        .stat-item {
            text-align: center;
            padding: 2rem 1rem;
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .team-section {
            padding: 5rem 0;
            background: var(--bg-light);
        }

        .team-card {
            background: var(--bg-white);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .team-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            border: 4px solid var(--primary-color);
            overflow: hidden;
        }

        .team-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .team-role {
            color: var(--text-light);
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .team-description {
            color: var(--text-dark);
            line-height: 1.6;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--text-dark) 0%, #34495e 100%);
            padding: 4rem 0;
            color: white;
            text-align: center;
        }

        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .cta-buttons {
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
            color: white;
            border: 2px solid white;
        }

        .btn-outline-custom:hover {
            background: white;
            color: var(--text-dark);
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .about-content {
                flex-direction: column;
                gap: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
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
                                À Propos de Nous
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">À Propos de FoodTiger</h1>
                <p class="hero-subtitle">Découvrez notre passion pour la gastronomie et notre engagement envers l'excellence</p>
            </div>   
          </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Notre Histoire</h2>
                    <p class="section-subtitle">Une passion pour la gastronomie depuis plus de 10 ans</p>
            </div>   
          </div>

            <!-- First About Card -->
            <div class="about-card" data-aos="fade-up" data-aos-delay="100">
                <div class="about-content">
                    <div class="about-text">
                        <h3>Nous sommes FoodTiger</h3>
                        <p>FoodTiger est né d'une passion pour la gastronomie et d'un désir de partager les meilleures saveurs du monde avec nos clients exigeants. Notre mission est simple : apporter une expérience culinaire exceptionnelle à votre table, en combinant authenticité, qualité et innovation dans chaque plat que nous préparons.</p>
                        <p>Depuis notre création, nous nous efforçons de créer des plats qui racontent une histoire, qui éveillent les sens et qui créent des moments inoubliables. Notre équipe de chefs passionnés travaille avec des ingrédients frais et de qualité premium pour vous offrir une expérience gastronomique unique.</p>
                    </div>
                    <div class="about-image">
                        <img src="image/logo + font_4.png" alt="FoodTiger Logo" class="img-fluid">
            </div>   
          </div>
        </div>

            <!-- Second About Card -->
            <div class="about-card" data-aos="fade-up" data-aos-delay="200">
                <div class="about-content">
                    <div class="about-image">
                        <img src="image/aboutpicture.jpg" alt="Notre Équipe" class="img-fluid">
                    </div>
                    <div class="about-text">
                        <h3>Rejoignez Notre Équipe</h3>
                        <p>Nous recherchons constamment des talents passionnés pour rejoindre notre équipe dynamique. Que vous soyez un chef expérimenté, un serveur attentionné ou un livreur motivé, nous avons une place pour vous dans notre famille FoodTiger.</p>
                        <p>Chez FoodTiger, nous offrons des horaires flexibles, une rémunération compétitive et un environnement de travail convivial. C'est plus qu'un simple emploi - c'est une opportunité de faire partie d'une équipe qui partage votre passion pour la gastronomie.</p>
                        <a href="#" class="btn btn-warning btn-lg">
                            <i class="fas fa-briefcase me-2"></i>Postuler Maintenant
                        </a>
                    </div>
                </div>
            </div>

            <!-- Third About Card -->
            <div class="about-card" data-aos="fade-up" data-aos-delay="300">
                <div class="about-content">
                    <div class="about-text">
                        <h3>Besoin d'Aide ?</h3>
                        <p>Notre équipe de service client est là pour vous accompagner à chaque étape de votre expérience FoodTiger. Que vous ayez des questions sur nos plats, besoin d'aide pour votre commande ou souhaitez partager vos commentaires, nous sommes là pour vous.</p>
                        <p>Nous nous engageons à fournir un service client exceptionnel, disponible 7j/7 pour répondre à vos besoins. Votre satisfaction est notre priorité absolue.</p>
                        <a href="#" class="btn btn-warning btn-lg">
                            <i class="fas fa-headset me-2"></i>Nous Contacter
        </a>
    </div>
                    <div class="about-image">
                        <img src="image/helppicture.jpg" alt="Service Client" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="about-section" style="background: var(--bg-light);">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Pourquoi Choisir FoodTiger ?</h2>
                    <p class="section-subtitle">Découvrez ce qui nous rend uniques</p>
                </div>
            </div>
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h4>Cuisine d'Excellence</h4>
                    <p>Nos chefs expérimentés créent des plats exceptionnels avec des ingrédients frais et de qualité premium.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h4>Livraison Rapide</h4>
                    <p>Livraison en 30-45 minutes dans toute la ville, avec un service soigneux et professionnel.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Service Personnalisé</h4>
                    <p>Un service client attentionné et personnalisé pour répondre à tous vos besoins.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>Qualité Premium</h4>
                    <p>Nous sélectionnons rigoureusement nos fournisseurs pour garantir la meilleure qualité.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4>Disponible 7j/7</h4>
                    <p>Ouvert tous les jours de 10h à 23h pour satisfaire vos envies à tout moment.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
              </div>
                    <h4>Paiement Sécurisé</h4>
                    <p>Paiement sécurisé en ligne ou en espèces à la livraison selon vos préférences.</p>
              </div>
            </div>
          </div>
    </section>
          
    <!-- Stats Section -->
    <section class="stats-section">
          <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item">
                        <div class="stat-number">10+</div>
                        <div class="stat-label">Années d'Expérience</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item">
                        <div class="stat-number">50k+</div>
                        <div class="stat-label">Clients Satisfaits</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Plats Uniques</div>
                    </div>
              </div>
                <div class="col-lg-3 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Service Client</div>
              </div>
            </div>
          </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Notre Équipe</h2>
                    <p class="section-subtitle">Des professionnels passionnés à votre service</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-card">
                        <div class="team-avatar">
                            <img src="image/chef1.jpg" alt="Chef Principal" onerror="this.src='https://via.placeholder.com/120x120/FFBD00/FFFFFF?text=Chef'">
                        </div>
                        <h4 class="team-name">Chef Michel</h4>
                        <p class="team-role">Chef Principal</p>
                        <p class="team-description">Avec plus de 15 ans d'expérience, notre chef principal crée des plats exceptionnels qui racontent une histoire.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="team-card">
                        <div class="team-avatar">
                            <img src="image/chef2.jpg" alt="Chef Pâtissier" onerror="this.src='https://via.placeholder.com/120x120/FF8A00/FFFFFF?text=Pâtissier'">
                        </div>
                        <h4 class="team-name">Chef Sophie</h4>
                        <p class="team-role">Chef Pâtissier</p>
                        <p class="team-description">Notre chef pâtissier transforme les ingrédients les plus simples en desserts extraordinaires.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="team-card">
                        <div class="team-avatar">
                            <img src="image/manager.jpg" alt="Manager" onerror="this.src='https://via.placeholder.com/120x120/FF6B35/FFFFFF?text=Manager'">
                        </div>
                        <h4 class="team-name">Marie Dubois</h4>
                        <p class="team-role">Manager</p>
                        <p class="team-description">Notre manager s'assure que chaque client reçoit un service exceptionnel et personnalisé.</p>
              </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12 text-center" data-aos="fade-up">
                    <h2 class="cta-title">Prêt à Découvrir Nos Saveurs ?</h2>
                    <p class="cta-subtitle">Commandez maintenant et savourez une expérience gastronomique exceptionnelle</p>
                    <div class="cta-buttons">
                        <a href="category.php" class="btn btn-primary-custom btn-custom">
                            <i class="fas fa-utensils"></i>
                            Découvrir le Menu
                        </a>
                        <a href="contact.php" class="btn btn-outline-custom btn-custom">
                            <i class="fas fa-phone"></i>
                            Nous Contacter
                        </a>
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

        // Animation des statistiques
        function animateStats() {
            const stats = document.querySelectorAll('.stat-number');
            stats.forEach(stat => {
                const target = parseInt(stat.textContent);
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    stat.textContent = Math.floor(current) + (stat.textContent.includes('+') ? '+' : '') + (stat.textContent.includes('/') ? '/7' : '');
                }, 50);
            });
        }

        // Observer pour déclencher l'animation des statistiques
        const statsSection = document.querySelector('.stats-section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.unobserve(entry.target);
                }
            });
        });

        if (statsSection) {
            observer.observe(statsSection);
        }

        // Animation des cartes au survol
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.about-card, .feature-card, .team-card');
            
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Animation des icônes
            const icons = document.querySelectorAll('.feature-icon');
            icons.forEach((icon, index) => {
                setTimeout(() => {
                    icon.classList.add('pulse');
                    setTimeout(() => {
                        icon.classList.remove('pulse');
                    }, 500);
                }, index * 200);
            });
        });
    </script>
    </body>
    </html>