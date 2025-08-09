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

if(isset($_GET['f_id'])){
    $f_id=$_GET['f_id'];
    $sql="select * from food where food.f_id='".$f_id."'";
    $result=$conn->query($sql);
    if($result->num_rows >0){
        while($row = $result -> fetch_assoc()){     
            $nameFood=$row['nameFood'];
            $description=$row['description'];
            $imagefood=$row['imageFood'];
            $cart_id=$row['cart_id'];
            $price=$row['price'];
            $f_id=$row['f_id'];
        }
}
}

// Récupérer les informations de la catégorie
$category_name = "";
if(isset($cart_id)) {
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
    <title>FoodTiger - <?php echo htmlspecialchars($nameFood); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Commander <?php echo htmlspecialchars($nameFood); ?> - Plat gastronomique préparé par nos chefs">
    
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
    <link rel="stylesheet" href="css/fooddetails.css">
</head>

<body>
    <!-- Header -->
    <header class="sticky-top">        
        <?php 
          include "navandfooter/nav.php";
        ?>           
</header>

    <!-- Restaurant Menu Header -->
    <section class="menu-header-section">
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
                                <a href="category.php" class="breadcrumb-link">Carte</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="food.php?category=<?php echo $cart_id; ?>" class="breadcrumb-link">
                                    <?php echo htmlspecialchars($category_name); ?>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?php echo htmlspecialchars($nameFood); ?>
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

    <!-- Dish Details Section -->
    <section class="dish-details-section">
        <div class="container">
            <div class="row">
                <!-- Dish Image Gallery -->
                <div class="col-lg-6 col-md-12 mb-4" data-aos="fade-right">
                    <div class="dish-gallery">
                        <div class="main-dish-image">
                            <img src="image/<?php echo $imagefood;?>" 
                                 alt="<?php echo htmlspecialchars($nameFood);?>" 
                                 class="dish-image">
                            <div class="dish-badge">
                                <span class="badge bg-warning">
                                    <i class="fas fa-star me-1"></i>Chef's Choice
                                </span>
                            </div>
                        </div>
                        <div class="dish-thumbnails">
                            <div class="thumbnail active">
                                <img src="image/<?php echo $imagefood;?>" alt="Vue principale">
                            </div>
                            <div class="thumbnail">
                                <img src="image/<?php echo $imagefood;?>" alt="Vue détail">
                            </div>
                            <div class="thumbnail">
                                <img src="image/<?php echo $imagefood;?>" alt="Vue présentation">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Dish Information & Order -->
                <div class="col-lg-6 col-md-12" data-aos="fade-left">
                    <div class="dish-info-card">
                        <!-- Dish Header -->
                        <div class="dish-header">
                            <h1 class="dish-title"><?php echo htmlspecialchars($nameFood); ?></h1>
                            <div class="dish-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="rating-count">(127 avis)</span>
                            </div>
                        </div>

                        <!-- Dish Description -->
                        <div class="dish-description">
                            <p><?php echo htmlspecialchars($description); ?></p>
                        </div>

                        <!-- Dish Features -->
                        <div class="dish-features">
                            <div class="feature-item">
                                <i class="fas fa-clock"></i>
                                <span>Préparation: 15-20 min</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-leaf"></i>
                                <span>Ingrédients frais</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-fire"></i>
                                <span>Préparé à la commande</span>
                            </div>
                        </div>

                        <!-- Order Section -->
                        <div class="order-section">
                            <h3 class="order-title">
                                <i class="fas fa-utensils me-2"></i>Commander ce plat
                            </h3>
                            
                            <form method="post" action="cart.php?action=add&id=<?php echo $f_id; ?>" class="order-form">
                                <!-- Quantity Selection -->
                                <div class="quantity-section">
                                    <label class="quantity-label">Nombre de portions:</label>
                                    <div class="quantity-controls">
                                        <button type="button" class="qty-btn" onclick="decreaseQuantity()">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" 
                                               id="quantity" 
                                               name="quantity" 
                                               min="1" 
                                               max="10" 
                                               value="1" 
                                               class="quantity-input">
                                        <button type="button" class="qty-btn" onclick="increaseQuantity()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Special Instructions -->
                                <div class="special-instructions">
                                    <label class="instructions-label">Instructions spéciales:</label>
                                    <textarea name="special_instructions" 
                                              class="instructions-input" 
                                              placeholder="Ex: Sans gluten, épices douces, cuisson à point..."></textarea>
                                </div>

                                <!-- Price Display -->
                                <div class="price-display">
                                    <div class="price-breakdown">
                                        <span class="price-label">Prix unitaire:</span>
                                        <span class="price-amount">€<?php echo number_format($price, 2); ?></span>
                                    </div>
                                    <div class="total-price">
                                        <span class="total-label">Total:</span>
                                        <span class="total-amount" id="totalAmount">€<?php echo number_format($price, 2); ?></span>
                                    </div>
                                </div>

                                <!-- Hidden Fields -->
                                <input name="hidden_name" value="<?php echo htmlspecialchars($nameFood); ?>" type="hidden">
                                <input name="hidden_price" value="<?php echo $price; ?>" type="hidden">
                                <input name="hidden_c_id" value="<?php echo $cart_id; ?>" type="hidden">

                                <!-- Order Buttons -->
                                <div class="order-buttons">
                                    <?php if (isset($_SESSION['Name'])) { ?>
                                        <button type="submit" name="add" class="btn btn-warning btn-lg order-btn">
                                            <i class="fas fa-shopping-cart me-2"></i>Ajouter à ma commande
                                        </button>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-warning btn-lg order-btn" onclick="showLoginModal()">
                                            <i class="fas fa-user me-2"></i>Se connecter pour commander
                                        </button>
                                    <?php } ?>
                                    
                                    <button type="button" class="btn btn-outline-warning btn-lg favorite-btn">
                                        <i class="fas fa-heart me-2"></i>Favoris
                                    </button>
                                </div>
            </form>
                        </div>

                        <!-- Restaurant Info -->
                        <div class="restaurant-details">
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
            </div>
        </div>
    </section>

    <!-- Dish Details Tabs -->
    <section class="dish-tabs-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="tabs-container" data-aos="fade-up">
                        <ul class="nav nav-tabs" id="dishTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="ingredients-tab" data-bs-toggle="tab" data-bs-target="#ingredients" type="button" role="tab">
                                    <i class="fas fa-list me-2"></i>Ingrédients
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nutrition-tab" data-bs-toggle="tab" data-bs-target="#nutrition" type="button" role="tab">
                                    <i class="fas fa-chart-pie me-2"></i>Nutrition
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="allergens-tab" data-bs-toggle="tab" data-bs-target="#allergens" type="button" role="tab">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Allergènes
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="dishTabsContent">
                            <div class="tab-pane fade show active" id="ingredients" role="tabpanel">
                                <div class="tab-content-inner">
                                    <h4>Ingrédients sélectionnés par notre chef</h4>
                                    <div class="ingredients-grid">
                                        <div class="ingredient-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Ingrédients frais de saison</span>
                                        </div>
                                        <div class="ingredient-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Épices authentiques</span>
                                        </div>
                                        <div class="ingredient-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Huiles d'olive premium</span>
                                        </div>
                                        <div class="ingredient-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Herbes aromatiques fraîches</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nutrition" role="tabpanel">
                                <div class="tab-content-inner">
                                    <h4>Informations nutritionnelles (par portion)</h4>
                                    <div class="nutrition-grid">
                                        <div class="nutrition-item">
                                            <span class="nutrition-label">Calories</span>
                                            <span class="nutrition-value">320 kcal</span>
                                        </div>
                                        <div class="nutrition-item">
                                            <span class="nutrition-label">Protéines</span>
                                            <span class="nutrition-value">18g</span>
                                        </div>
                                        <div class="nutrition-item">
                                            <span class="nutrition-label">Glucides</span>
                                            <span class="nutrition-value">25g</span>
                                        </div>
                                        <div class="nutrition-item">
                                            <span class="nutrition-label">Lipides</span>
                                            <span class="nutrition-value">12g</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="allergens" role="tabpanel">
                                <div class="tab-content-inner">
                                    <h4>Informations allergènes</h4>
                                    <div class="allergens-list">
                                        <div class="allergen-item">
                                            <i class="fas fa-info-circle text-info"></i>
                                            <span>Peut contenir des traces de gluten</span>
                                        </div>
                                        <div class="allergen-item">
                                            <i class="fas fa-info-circle text-info"></i>
                                            <span>Contient des produits laitiers</span>
                                        </div>
                                        <div class="allergen-item">
                                            <i class="fas fa-info-circle text-info"></i>
                                            <span>Préparé dans une cuisine utilisant des fruits de mer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10 col-sm-12" data-aos="fade-up">
                    <h2 class="cta-title">Prêt à déguster ce plat d'exception ?</h2>
                    <p class="cta-subtitle">Commandez maintenant et savourez une expérience gastronomique unique</p>
                    <div class="cta-buttons">
                        <a href="cart.php" class="btn btn-warning btn-lg px-5 py-3 me-3 mb-2">
                            <i class="fas fa-shopping-cart me-2"></i>Voir ma commande
                        </a>
                        <a href="food.php?category=<?php echo $cart_id; ?>" class="btn btn-outline-warning btn-lg px-5 py-3 mb-2">
                            <i class="fas fa-utensils me-2"></i>Voir la carte complète
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

        // Variables globales
        let basePrice = <?php echo $price; ?>;
        let currentQuantity = 1;

        // Fonctionnalité de quantité
        function increaseQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            if (currentValue < 10) {
                input.value = currentValue + 1;
                currentQuantity = currentValue + 1;
                updateTotal();
            }
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                currentQuantity = currentValue - 1;
                updateTotal();
            }
        }

        // Mettre à jour le total
        function updateTotal() {
            const totalElement = document.getElementById('totalAmount');
            const total = basePrice * currentQuantity;
            totalElement.textContent = '€' + total.toFixed(2);
        }

        // Écouter les changements de quantité
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            quantityInput.addEventListener('change', function() {
                currentQuantity = parseInt(this.value);
                updateTotal();
            });

            // Animation des thumbnails
            const thumbnails = document.querySelectorAll('.thumbnail');
            const mainImage = document.querySelector('.dish-image');

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    const imgSrc = this.querySelector('img').src;
                    mainImage.src = imgSrc;
                });
            });

            // Animation des étoiles
            const stars = document.querySelectorAll('.stars i');
            stars.forEach((star, index) => {
                setTimeout(() => {
                    star.style.animation = 'pulse 0.5s ease-in-out';
                    setTimeout(() => {
                        star.style.animation = '';
                    }, 500);
                }, index * 100);
            });
        });

        // Fonction pour afficher le modal de connexion
        function showLoginModal() {
            alert('Veuillez vous connecter pour commander ce plat.');
        }

        // Animation des boutons
        document.addEventListener('DOMContentLoaded', function() {
            const orderBtn = document.querySelector('.order-btn');
            const favoriteBtn = document.querySelector('.favorite-btn');

            if (orderBtn) {
                orderBtn.addEventListener('click', function() {
                    this.innerHTML = '<i class="fas fa-check me-2"></i>Ajouté !';
                    this.classList.remove('btn-warning');
                    this.classList.add('btn-success');
                    
                    setTimeout(() => {
                        this.innerHTML = '<i class="fas fa-shopping-cart me-2"></i>Ajouter à ma commande';
                        this.classList.remove('btn-success');
                        this.classList.add('btn-warning');
                    }, 2000);
                });
            }

            if (favoriteBtn) {
                favoriteBtn.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (icon.classList.contains('far')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        this.classList.remove('btn-outline-warning');
                        this.classList.add('btn-warning');
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        this.classList.remove('btn-warning');
                        this.classList.add('btn-outline-warning');
                    }
                });
            }
        });
    </script>
    </body>
</html>
    </html>