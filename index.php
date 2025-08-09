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
    <title>FoodTiger - Restaurant Gastronomique d'Excellence</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="FoodTiger - Restaurant gastronomique offrant une expérience culinaire exceptionnelle avec des cuisines du monde entier">
    <meta name="keywords" content="restaurant, gastronomie, cuisine française, cuisine internationale, livraison, commande en ligne">
    
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
    <link rel="stylesheet" href="css/aboutus.css">
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
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
                    <img src="image/food.jpg" alt="Cuisine Gastronomique d'Excellence" class="d-block w-100">
            <div class="carousel-caption">
                        <h1 class="display-1 fw-bold" data-aos="fade-up" data-aos-delay="200">FoodTiger</h1>
                        <p class="lead" data-aos="fade-up" data-aos-delay="400">Une expérience gastronomique exceptionnelle</p>
                        <div class="hero-buttons" data-aos="fade-up" data-aos-delay="600">
                            <a href="category.php" class="btn btn-warning btn-lg px-5 py-3 me-3 mb-2">
                                <i class="fas fa-utensils me-2"></i>Découvrir nos plats
                            </a>
                            <a href="aboutus.php" class="btn btn-outline-light btn-lg px-5 py-3 mb-2">
                                <i class="fas fa-heart me-2"></i>Notre histoire
                            </a>
                        </div>
            </div>   
          </div>
          <div class="carousel-item">
                    <img src="image/food4.jpg" alt="Qualité Premium et Ingrédients Frais" class="d-block w-100">
            <div class="carousel-caption">
                        <h1 class="display-1 fw-bold" data-aos="fade-up" data-aos-delay="200">Qualité Premium</h1>
                        <p class="lead" data-aos="fade-up" data-aos-delay="400">Des ingrédients frais et une cuisine d'excellence</p>
                        <div class="hero-buttons" data-aos="fade-up" data-aos-delay="600">
                            <a href="category.php" class="btn btn-warning btn-lg px-5 py-3 me-3 mb-2">
                                <i class="fas fa-star me-2"></i>Nos spécialités
                            </a>
                            <a href="cart.php" class="btn btn-outline-light btn-lg px-5 py-3 mb-2">
                                <i class="fas fa-shopping-cart me-2"></i>Commander maintenant
                            </a>
                        </div>
            </div>   
          </div>
          <div class="carousel-item">
                    <img src="image/food3.jpg" alt="Service Exceptionnel et Expérience Client" class="d-block w-100">
            <div class="carousel-caption">
                        <h1 class="display-1 fw-bold" data-aos="fade-up" data-aos-delay="200">Service Exceptionnel</h1>
                        <p class="lead" data-aos="fade-up" data-aos-delay="400">Une expérience client inoubliable</p>
                        <div class="hero-buttons" data-aos="fade-up" data-aos-delay="600">
                            <a href="aboutus.php" class="btn btn-warning btn-lg px-5 py-3 me-3 mb-2">
                                <i class="fas fa-heart me-2"></i>Notre histoire
                            </a>
                            <a href="userprofile.php" class="btn btn-outline-light btn-lg px-5 py-3 mb-2">
                                <i class="fas fa-user me-2"></i>Mon compte
                            </a>
                        </div>
                    </div>   
            </div>   
          </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
    </section>

    <!-- Section Statistiques -->
    <section class="stats-section py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item">
                        <i class="fas fa-utensils fa-3x text-warning mb-3"></i>
                        <h3 class="stat-number">500+</h3>
                        <p class="stat-text">Plats uniques</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item">
                        <i class="fas fa-users fa-3x text-warning mb-3"></i>
                        <h3 class="stat-number">10K+</h3>
                        <p class="stat-text">Clients satisfaits</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-item">
                        <i class="fas fa-clock fa-3x text-warning mb-3"></i>
                        <h3 class="stat-number">15min</h3>
                        <p class="stat-text">Temps de livraison</p>
    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-item">
                        <i class="fas fa-award fa-3x text-warning mb-3"></i>
                        <h3 class="stat-number">5★</h3>
                        <p class="stat-text">Note moyenne</p>
                    </div>
              </div>
            </div>
        </div>
    </section>

    <!-- Nos Cuisines Section -->
    <section class="cuisines-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Nos Cuisines du Monde</h2>
                    <p class="section-subtitle">Découvrez une palette de saveurs authentiques</p>
              </div>
            </div>
            <div class="row g-4">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="card cuisine-card h-100">
                        <div class="inner">
                            <a href="category.php">
                                <img class="card-img-top" src="image/malay food.jpg" alt="Cuisine Malaisienne Authentique">
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <i class="fas fa-pepper-hot me-2"></i>Cuisine Malaisienne
                            </h5>
                            <p class="card-text flex-grow-1">Découvrez les saveurs authentiques de la cuisine malaisienne, avec ses épices parfumées et ses plats traditionnels préparés avec passion par nos chefs expérimentés.</p>
                            <a href="category.php" class="btn btn-warning mt-auto">
                                <i class="fas fa-arrow-right me-2"></i>Explorer
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="card cuisine-card h-100">
                <div class="inner">
                            <a href="category.php">
                                <img class="card-img-top" src="image/chinese food.jpg" alt="Cuisine Chinoise Traditionnelle">
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <i class="fas fa-dragon me-2"></i>Cuisine Chinoise
                            </h5>
                            <p class="card-text flex-grow-1">Plongez dans l'art culinaire chinois millénaire, avec ses techniques raffinées et ses saveurs équilibrées qui éveillent tous les sens et transportent vos papilles.</p>
                            <a href="category.php" class="btn btn-warning mt-auto">
                                <i class="fas fa-arrow-right me-2"></i>Explorer
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="300">
                    <div class="card cuisine-card h-100">
                        <div class="inner">
                            <a href="category.php">
                                <img class="card-img-top" src="image/western food.jpg" alt="Cuisine Occidentale Sophistiquée">
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <i class="fas fa-crown me-2"></i>Cuisine Occidentale
                            </h5>
                            <p class="card-text flex-grow-1">Savourez l'excellence de la gastronomie occidentale, avec ses plats sophistiqués et ses techniques culinaires modernes qui allient tradition et innovation.</p>
                            <a href="category.php" class="btn btn-warning mt-auto">
                                <i class="fas fa-arrow-right me-2"></i>Explorer
                            </a>
                        </div>
              </div>
            </div>
          </div>
    </div>
    </section>

    <!-- Section À Propos -->
    <section class="about-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 mb-4" data-aos="fade-right">
                    <div class="about-content">
                        <h2 class="section-title text-start mb-4">
                            <i class="fas fa-heart text-warning me-3"></i>Notre Histoire
                        </h2>
                        <p class="lead mb-4">FoodTiger est né d'une passion pour la gastronomie et d'un désir de partager les meilleures saveurs du monde avec nos clients exigeants.</p>
                        <p class="mb-4">Notre mission est simple : apporter une expérience culinaire exceptionnelle à votre table, en combinant authenticité, qualité et innovation dans chaque plat que nous préparons.</p>
                        <div class="features-list">
                            <div class="feature-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Ingrédients frais et de qualité premium</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Chefs expérimentés et passionnés</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Service personnalisé et attentionné</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Livraison rapide et soignée</span>
                            </div>
                        </div>
                        <div class="about-buttons mt-4">
                            <a href="aboutus.php" class="btn btn-warning btn-lg me-3 mb-2">
                                <i class="fas fa-book-open me-2"></i>En savoir plus
                            </a>
                            <a href="category.php" class="btn btn-outline-warning btn-lg mb-2">
                                <i class="fas fa-utensils me-2"></i>Voir le menu
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12" data-aos="fade-left">
                    <div class="about-image text-center">
                        <img src="image/logo 256x256.png" alt="FoodTiger Logo" class="img-fluid rounded-circle shadow-lg" style="max-width: 300px;">
                        <div class="about-badge mt-3">
                            <span class="badge bg-warning text-dark fs-6 px-4 py-2">
                                <i class="fas fa-star me-2"></i>Restaurant d'Excellence
                            </span>
          </div>
          </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section Témoignages -->
    <section class="testimonials-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Ce que disent nos clients</h2>
                    <p class="section-subtitle">Découvrez les avis de nos clients satisfaits</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="stars mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="testimonial-text">"Une expérience gastronomique exceptionnelle ! Les plats sont délicieux et le service est impeccable."</p>
                            <div class="testimonial-author">
                                <img src="image/avatar6.png" alt="Client" class="author-avatar">
                                <div class="author-info">
                                    <h6 class="author-name">Marie Dubois</h6>
                                    <p class="author-title">Cliente fidèle</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="stars mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="testimonial-text">"La qualité des ingrédients est remarquable. Je recommande vivement FoodTiger pour une expérience culinaire unique."</p>
                            <div class="testimonial-author">
                                <img src="image/avatar6.png" alt="Client" class="author-avatar">
                                <div class="author-info">
                                    <h6 class="author-name">Pierre Martin</h6>
                                    <p class="author-title">Critique gastronomique</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="stars mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="testimonial-text">"Service rapide et professionnel. Les plats arrivent toujours chauds et délicieux. Un vrai régal !"</p>
                            <div class="testimonial-author">
                                <img src="image/avatar6.png" alt="Client" class="author-avatar">
                                <div class="author-info">
                                    <h6 class="author-name">Sophie Laurent</h6>
                                    <p class="author-title">Cliente régulière</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Questions Fréquentes</h2>
                    <p class="section-subtitle">Tout ce que vous devez savoir sur FoodTiger</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-clock me-3"></i>Quels sont vos horaires d'ouverture ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    FoodTiger est ouvert de 10h à 23h, du lundi au dimanche, pour vous servir à tout moment de la journée. Notre équipe est disponible pour répondre à vos commandes et vous offrir le meilleur service possible.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-credit-card me-3"></i>Quels moyens de paiement acceptez-vous ?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Nous acceptons les cartes de crédit/débit (Visa, Mastercard, American Express) et le paiement en espèces à la livraison. Toutes nos transactions sont sécurisées et une fois le paiement confirmé, votre commande sera transmise à notre équipe de cuisine.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-user-plus me-3"></i>Comment créer un compte FoodTiger ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Cliquez sur "S'inscrire" en haut de la page, remplissez toutes les informations demandées (nom, email, téléphone, adresse) et cliquez sur "Soumettre" pour créer votre compte. C'est simple et rapide !
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <i class="fas fa-truck me-3"></i>Quel est le temps de livraison ?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Notre temps de livraison moyen est de 15 à 30 minutes selon votre localisation. Nous nous efforçons de livrer vos commandes le plus rapidement possible tout en maintenant la qualité de nos plats.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="500">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <i class="fas fa-leaf me-3"></i>Utilisez-vous des ingrédients frais ?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Absolument ! Nous nous engageons à utiliser uniquement des ingrédients frais et de qualité premium. Nos légumes, viandes et poissons sont sélectionnés avec soin pour garantir une expérience gustative exceptionnelle.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section py-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10 col-sm-12" data-aos="fade-up">
                    <h2 class="cta-title">Prêt à vivre une expérience gastronomique unique ?</h2>
                    <p class="cta-subtitle">Commandez maintenant et découvrez les saveurs exceptionnelles de FoodTiger</p>
                    <div class="cta-buttons">
                        <a href="category.php" class="btn btn-warning btn-lg px-5 py-3 me-3 mb-2">
                            <i class="fas fa-utensils me-2"></i>Voir le menu
                        </a>
                        <a href="cart.php" class="btn btn-outline-warning btn-lg px-5 py-3 mb-2">
                            <i class="fas fa-shopping-cart me-2"></i>Commander maintenant
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <?php 
          require "navandfooter/footer.php";
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

        // Animation au scroll pour les cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.cuisine-card');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(50px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });

            // Animation pour les statistiques
            const stats = document.querySelectorAll('.stat-number');
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = entry.target;
                        const finalValue = parseInt(target.textContent);
                        let currentValue = 0;
                        const increment = finalValue / 50;
                        
                        const timer = setInterval(() => {
                            currentValue += increment;
                            if (currentValue >= finalValue) {
                                target.textContent = finalValue + (target.textContent.includes('+') ? '+' : '');
                                clearInterval(timer);
        } else {
                                target.textContent = Math.floor(currentValue) + (target.textContent.includes('+') ? '+' : '');
                            }
                        }, 30);
                        
                        statsObserver.unobserve(target);
                    }
                });
            });
            
            stats.forEach(stat => {
                statsObserver.observe(stat);
            });
        });

        // Amélioration du carousel
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.querySelector('#heroCarousel');
            if (carousel) {
                carousel.addEventListener('slide.bs.carousel', function (e) {
                    const activeItem = carousel.querySelector('.carousel-item.active');
                    const nextItem = carousel.querySelectorAll('.carousel-item')[e.to];
                    
                    // Réinitialiser les animations
                    activeItem.querySelectorAll('[data-aos]').forEach(el => {
                        el.style.opacity = '0';
                        el.style.transform = 'translateY(30px)';
                    });
                    
                    // Animer le nouvel élément
                    setTimeout(() => {
                        nextItem.querySelectorAll('[data-aos]').forEach((el, index) => {
                            setTimeout(() => {
                                el.style.opacity = '1';
                                el.style.transform = 'translateY(0)';
                            }, index * 200);
                        });
                    }, 500);
                });
            }
        });
</script>
</body>
</html>