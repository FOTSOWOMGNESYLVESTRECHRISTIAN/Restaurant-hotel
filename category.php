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

$sql = 'SELECT * FROM category';
if(isset($_GET['page'])){
     $page = $_GET['page'];
}
else{
     $page = 1;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>FoodTiger - Nos Cuisines du Monde</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Découvrez nos cuisines du monde - Une expérience gastronomique exceptionnelle avec des saveurs authentiques">
    <meta name="keywords" content="cuisines du monde, gastronomie, restaurant, malaisienne, chinoise, occidentale, indienne, coréenne, japonaise">
    
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
    <link rel="stylesheet" href="css/category.css">
</head>

<body>
    <!-- Header -->
    <header class="sticky-top">        
        <?php 
          require "navandfooter/nav.php";
        ?>           
</header>

    <!-- Hero Section -->
    <section class="category-hero">
        <div class="hero-background">
            <div class="hero-overlay">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8 col-md-10 col-sm-12" data-aos="fade-up">
                            <h1 class="hero-title">Nos Cuisines du Monde</h1>
                            <p class="hero-subtitle">Découvrez une palette de saveurs authentiques et laissez-vous transporter par nos spécialités culinaires</p>
                            <div class="hero-stats">
                                <div class="stat-item">
                                    <i class="fas fa-utensils"></i>
                                    <span>6 Cuisines</span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-star"></i>
                                    <span>Premium</span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-heart"></i>
                                    <span>Authentique</span>
            </div>   
          </div>
            </div>   
          </div>
            </div>   
          </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="search-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="search-container" data-aos="fade-up">
                        <form action="category.php" method="POST" class="search-form">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" 
                                       class="form-control search-input" 
                                       name="search" 
                                       placeholder="Rechercher une cuisine ou un plat..." 
                                       id="search"
                                       value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
                                <button class="btn btn-warning search-btn" type="submit">
                                    <i class="fas fa-search me-2"></i>Rechercher
                                </button>
    </div>
    </form>
                        <div class="search-tags">
                            <span class="tag">Malaisienne</span>
                            <span class="tag">Chinoise</span>
                            <span class="tag">Occidentale</span>
                            <span class="tag">Indienne</span>
                            <span class="tag">Coréenne</span>
                            <span class="tag">Japonaise</span>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section py-5">
        <div class="container">
        <div class="row">
                <div class="col-12">
                    <div class="categories-grid">
          <?php
            if(isset($_POST['search'])){
              $keyword=$_POST['search'];
            }        
            $search="";
            if(isset($_POST['search'])){
                $search=" where name like '%".$keyword."%'or description like '%".$keyword."%'";
            }
            if(isset($_GET['category'])){
              $cart_id=$_GET['category'];
              $search=" where cart_id='".$cart_id."'";
            }
            $sql="select * from category".$search;
            $result=$conn->query($sql);
                      
            if($result->num_rows >0){
                            $delay = 100;
              while($row = mysqli_fetch_assoc($result)){     
                $name=$row['name'];
                $image=$row['image'];
                $description=$row['description'];
                                $c_id=$row['c_id'];
                                
                                // Définir les icônes selon la cuisine
                                $icon = 'fas fa-utensils';
                                $color = '#e67e22';
                                
                                switch(strtolower($name)) {
                                    case 'malay':
                                        $icon = 'fas fa-pepper-hot';
                                        $color = '#e74c3c';
                                        break;
                                    case 'chinese':
                                        $icon = 'fas fa-dragon';
                                        $color = '#e67e22';
                                        break;
                                    case 'western':
                                        $icon = 'fas fa-crown';
                                        $color = '#f39c12';
                                        break;
                                    case 'indian':
                                        $icon = 'fas fa-spice';
                                        $color = '#f1c40f';
                                        break;
                                    case 'korean':
                                        $icon = 'fas fa-leaf';
                                        $color = '#27ae60';
                                        break;
                                    case 'japanese':
                                        $icon = 'fas fa-fish';
                                        $color = '#3498db';
                                        break;
                                }
                                ?> 
                                <div class="category-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
            <div class="card h-100">
                                        <div class="card-image-container">
                                            <a href="food.php?category=<?php echo $row['c_id'];?>">
                                                <img src="image/<?php echo $row['image'];?>" 
                                                     class="card-img-top" 
                                                     alt="<?php echo htmlspecialchars($row['name']); ?> Cuisine">
                                                <div class="image-overlay">
                                                    <i class="fas fa-arrow-right"></i>
                                                </div>
                                            </a>
                                        </div>
              <div class="card-body">
                                            <div class="category-header">
                                                <div class="category-icon" style="background-color: <?php echo $color; ?>">
                                                    <i class="<?php echo $icon; ?>"></i>
                                                </div>
                                                <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                                            </div>
                                            <div class="card-description">
                                                <?php echo htmlspecialchars($row['description']); ?>
                                            </div>
                                            <div class="card-actions">
                                                <a href="food.php?category=<?php echo $row['c_id'];?>" class="btn btn-warning">
                                                    <i class="fas fa-utensils me-2"></i>Découvrir
                                                </a>
                                                <div class="category-badge">
                                                    <span class="badge bg-success">Premium</span>
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
                                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                    <h3>Aucun résultat trouvé</h3>
                                    <p class="text-muted">Essayez avec d'autres mots-clés ou explorez toutes nos cuisines</p>
                                    <a href="category.php" class="btn btn-warning">
                                        <i class="fas fa-utensils me-2"></i>Voir toutes les cuisines
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

    <!-- Pagination Section -->
        <?php
        $result = $conn->query("SELECT * FROM category where category_exixts='exixts'");
        $count = $result->num_rows;      
        $a = $count / 9;
        $a = ceil($a);
    
    if($a > 1) {
    ?>
    <section class="pagination-section py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <nav aria-label="Navigation des catégories">
                        <ul class="pagination justify-content-center"> 
          <?php
                            for ($i = 1; $i <= $a; $i++) {
                                $active = ($i == $page) ? 'active' : '';
                            ?>
                                <li class="page-item <?php echo $active; ?>">
                                    <a class="page-link" href="category.php?page=<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li> 
          <?php
          }
          ?>
        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <!-- Call to Action Section -->
    <section class="cta-section py-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10 col-sm-12" data-aos="fade-up">
                    <h2 class="cta-title">Prêt à découvrir nos saveurs ?</h2>
                    <p class="cta-subtitle">Commandez maintenant et savourez une expérience gastronomique exceptionnelle</p>
                    <div class="cta-buttons">
                        <a href="cart.php" class="btn btn-warning btn-lg px-5 py-3 me-3 mb-2">
                            <i class="fas fa-shopping-cart me-2"></i>Commander maintenant
                        </a>
                        <a href="aboutus.php" class="btn btn-outline-warning btn-lg px-5 py-3 mb-2">
                            <i class="fas fa-heart me-2"></i>Notre histoire
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
            const cards = document.querySelectorAll('.category-card');
            
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