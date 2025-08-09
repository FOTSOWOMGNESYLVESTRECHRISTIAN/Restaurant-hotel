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

require 'database/connection.php';
require 'database/pdo.php';
$sql = 'SELECT * FROM food';

$query  = $pdoconn->prepare($sql);
$query->execute();
$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);		
$result=$conn->query($sql); //run SQL
if(isset($_POST['search'])){
    $keyword=$_POST['search'];
}        
$search="";
if(isset($_POST['search'])){
$search=" where nameFood like '%".$keyword."%'or description like '%".$keyword."%'";
}
if(isset($_GET['category'])){
$cart_id=$_GET['category'];
$search=" where cart_id='".$cart_id."'";
}
                   
// Récupérer le nom de la catégorie si disponible
$category_name = "Tous nos plats";
if(isset($_GET['category'])){
    $cat_sql = "SELECT name FROM category WHERE c_id = '".$cart_id."'";
    $cat_result = $conn->query($cat_sql);
    if($cat_result->num_rows > 0){
        $cat_row = $cat_result->fetch_assoc();
        $category_name = $cat_row['name'];
    }
}
                   
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>FoodTiger - Notre Carte Gastronomique</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Découvrez notre carte gastronomique - Des plats d'exception préparés avec des ingrédients frais et de qualité">
    <meta name="keywords" content="carte gastronomique, plats, restaurant, cuisine, menu, gastronomie">
    
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
    <link rel="stylesheet" href="css/food.css">
</head>

<body>
    <!-- Header -->
    <header class="sticky-top">        
        <?php 
          require "navandfooter/nav.php";
        ?>
    </header>

    <!-- Hero Section -->
    <section class="food-hero">
        <div class="hero-background">
            <div class="hero-overlay">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8 col-md-10 col-sm-12" data-aos="fade-up">
                            <h1 class="hero-title">Notre Carte Gastronomique</h1>
                            <p class="hero-subtitle">Découvrez nos plats d'exception préparés avec passion par nos chefs expérimentés</p>
                            <div class="hero-stats">
                                <div class="stat-item">
                                    <i class="fas fa-utensils"></i>
                                    <span>Plats Premium</span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-leaf"></i>
                                    <span>Ingrédients Frais</span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-star"></i>
                                    <span>Qualité Hôtel</span>
            </div>   
          </div>
            </div>   
          </div>
            </div>   
          </div>
        </div>
    </section>

    <!-- Breadcrumb Section -->
    <section class="breadcrumb-section py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php" class="breadcrumb-link">
                            <i class="fas fa-home me-2"></i>Accueil
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="category.php" class="breadcrumb-link">Cuisines</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo htmlspecialchars($category_name); ?>
                    </li>
                </ol>
            </nav>
    </div>
    </section>

    <!-- Search Section -->
    <section class="search-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="search-container" data-aos="fade-up">
                        <form action="food.php" method="POST" class="search-form">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" 
                                       class="form-control search-input" 
                                       name="search" 
                                       placeholder="Rechercher un plat ou un ingrédient..." 
                                       id="search"
                                       value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
                                <button class="btn btn-warning search-btn" type="submit">
                                    <i class="fas fa-search me-2"></i>Rechercher
                                </button>
                            </div>
    </form>
                        <div class="search-tags">
                            <span class="tag">Entrées</span>
                            <span class="tag">Plats principaux</span>
                            <span class="tag">Desserts</span>
                            <span class="tag">Boissons</span>
                            <span class="tag">Spécialités</span>
                            <span class="tag">Végétarien</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Info Section -->
    <section class="category-info-section py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12 text-center" data-aos="fade-up">
                    <h2 class="category-title"><?php echo htmlspecialchars($category_name); ?></h2>
                    <p class="category-description">Découvrez nos spécialités culinaires préparées avec des ingrédients frais et des techniques traditionnelles</p>
                </div>
            </div>
    </div>
    </section>

    <!-- Foods Section -->
    <section class="foods-section py-5">
        <div class="container">
        <div class="row">
                <div class="col-12">
                    <div class="foods-grid">
            <?php
                $sql="select * from food".$search;
                $result=$conn->query($sql);
                if($result->num_rows >0){
                            $delay = 100;
                    while($row = $result -> fetch_assoc()){     
                                // Définir les badges selon le type de plat
                                $badge = '';
                                $badge_color = '';
                                
                                if(strpos(strtolower($row['nameFood']), 'salad') !== false || 
                                   strpos(strtolower($row['nameFood']), 'soup') !== false) {
                                    $badge = 'Entrée';
                                    $badge_color = 'bg-primary';
                                } elseif(strpos(strtolower($row['nameFood']), 'cake') !== false || 
                                        strpos(strtolower($row['nameFood']), 'dessert') !== false) {
                                    $badge = 'Dessert';
                                    $badge_color = 'bg-warning';
                                } elseif(strpos(strtolower($row['nameFood']), 'drink') !== false || 
                                        strpos(strtolower($row['nameFood']), 'juice') !== false) {
                                    $badge = 'Boisson';
                                    $badge_color = 'bg-info';
                                } else {
                                    $badge = 'Plat principal';
                                    $badge_color = 'bg-success';
                                }
                        ?>  
                        <div class="food-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                <div class="card h-100">
                                <div class="card-image-container">
                                    <a href="fooddetails.php?f_id=<?php echo $row['f_id']; ?>">
                                        <img src="image/<?php echo $row['imageFood'];?>" 
                                             class="card-img-top" 
                                             alt="<?php echo htmlspecialchars($row['nameFood']); ?>">
                                        <div class="image-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </a>
                                    <div class="food-badge">
                                        <span class="badge <?php echo $badge_color; ?>"><?php echo $badge; ?></span>
                                    </div>
                                </div>
                    <div class="card-body">
                                    <div class="food-header">
                                        <h5 class="card-title"><?php echo htmlspecialchars($row['nameFood']); ?></h5>
                                        <div class="food-rating">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="food-description">
                                        <?php echo htmlspecialchars($row['description']); ?>
                                    </div>
                                    <div class="food-footer">
                                        <div class="food-price">
                                            <span class="price-currency">€</span>
                                            <span class="price-amount"><?php echo number_format($row['price'], 2); ?></span>
                                        </div>
                                        <div class="food-actions">
                                            <a href="fooddetails.php?f_id=<?php echo $row['f_id']; ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-eye me-1"></i>Voir détails
                                            </a>
                                            <button class="btn btn-outline-warning btn-sm add-to-cart" 
                                                    data-food-id="<?php echo $row['f_id']; ?>"
                                                    data-food-name="<?php echo htmlspecialchars($row['nameFood']); ?>"
                                                    data-food-price="<?php echo $row['price']; ?>">
                                                <i class="fas fa-shopping-cart me-1"></i>Ajouter
                                            </button>
                                        </div>
                        </div>
                    </div>
                </div>
            </div>  
            <?php
                            $delay += 100;
                            } 
                        } else {
                            ?>
                            <div class="col-12 text-center" data-aos="fade-up">
                                <div class="no-results">
                                    <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                                    <h3>Aucun plat trouvé</h3>
                                    <p class="text-muted">Essayez avec d'autres mots-clés ou explorez toutes nos spécialités</p>
                                    <a href="food.php" class="btn btn-warning">
                                        <i class="fas fa-utensils me-2"></i>Voir tous les plats
                                    </a>
                                </div>
                            </div>
                            <?php
            }
            ?>
        </div>
    </div>
    </div>
        </div>
    </section>

    <!-- Special Offers Section -->
    <section class="offers-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Offres Spéciales</h2>
                    <p class="section-subtitle">Découvrez nos promotions exclusives</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="offer-card">
                        <div class="offer-content">
                            <div class="offer-icon">
                                <i class="fas fa-percentage"></i>
                            </div>
                            <h4>Menu Dégustation</h4>
                            <p>Dégustez 5 plats sélectionnés par notre chef -20%</p>
                            <a href="category.php" class="btn btn-warning">Découvrir</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="offer-card">
                        <div class="offer-content">
                            <div class="offer-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h4>Happy Hours</h4>
                            <p>Boissons et cocktails à prix réduits de 18h à 20h</p>
                            <a href="category.php" class="btn btn-warning">Voir les boissons</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="300">
                    <div class="offer-card">
                        <div class="offer-content">
                            <div class="offer-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h4>Plats du Chef</h4>
                            <p>Découvrez les créations exclusives de notre chef étoilé</p>
                            <a href="category.php" class="btn btn-warning">Explorer</a>
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
                    <h2 class="cta-title">Prêt à savourer l'excellence ?</h2>
                    <p class="cta-subtitle">Commandez maintenant et dégustez nos plats gastronomiques</p>
                    <div class="cta-buttons">
                        <a href="cart.php" class="btn btn-warning btn-lg px-5 py-3 me-3 mb-2">
                            <i class="fas fa-shopping-cart me-2"></i>Commander maintenant
                        </a>
                        <a href="category.php" class="btn btn-outline-warning btn-lg px-5 py-3 mb-2">
                            <i class="fas fa-utensils me-2"></i>Voir le menu complet
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

        // Animation des tags de recherche
        document.addEventListener('DOMContentLoaded', function() {
            const tags = document.querySelectorAll('.search-tags .tag');
            tags.forEach((tag, index) => {
                tag.style.animationDelay = `${index * 0.1}s`;
            });

            // Animation des cartes au scroll
            const cards = document.querySelectorAll('.food-card');
            
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

            // Fonctionnalité de recherche avec tags
            const searchTags = document.querySelectorAll('.search-tags .tag');
            const searchInput = document.getElementById('search');

            searchTags.forEach(tag => {
                tag.addEventListener('click', function() {
                    const tagText = this.textContent;
                    searchInput.value = tagText;
                    searchInput.focus();
                });
            });

            // Amélioration de la recherche
            const searchForm = document.querySelector('.search-form');
            searchForm.addEventListener('submit', function(e) {
                const searchValue = searchInput.value.trim();
                if (searchValue === '') {
                    e.preventDefault();
                    searchInput.focus();
                }
            });

            // Fonctionnalité d'ajout au panier
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const foodId = this.getAttribute('data-food-id');
                    const foodName = this.getAttribute('data-food-name');
                    const foodPrice = this.getAttribute('data-food-price');
                    
                    // Animation de confirmation
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check me-1"></i>Ajouté';
                    this.classList.remove('btn-outline-warning');
                    this.classList.add('btn-success');
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('btn-success');
                        this.classList.add('btn-outline-warning');
                    }, 2000);
                    
                    // Ici vous pouvez ajouter la logique pour ajouter au panier
                    console.log('Ajout au panier:', foodName, 'Prix:', foodPrice);
                });
            });
        });

        // Animation des statistiques du hero
        function animateStats() {
            const stats = document.querySelectorAll('.hero-stats .stat-item');
            stats.forEach((stat, index) => {
                setTimeout(() => {
                    stat.style.opacity = '1';
                    stat.style.transform = 'translateY(0)';
                }, index * 200);
            });
        }

        // Déclencher l'animation des stats au chargement
        window.addEventListener('load', animateStats);
    </script>
    </body>
</html>