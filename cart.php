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
if(isset($_POST["add"]))
{ 
  if(isset($_SESSION["cart"]))
  { 
    $item_array_id = array_column($_SESSION["cart"], "food_id");
    if(!in_array($_GET["id"], $item_array_id))
    {
      $count = count($_SESSION["cart"]);
      $item_array = array(
      'food_id' => $_GET["id"],
      'food_name' => $_POST["hidden_name"],
      'food_price' => $_POST["hidden_price"],
      'c_id' => $_POST["hidden_c_id"],
      'food_quantity' => $_POST["quantity"],
      );
      $_SESSION["cart"][$count] = $item_array;
      echo '<script>alert("Added succesful!")</script>';
      echo '<script>window.location="cart.php"</script>';
    }   
    else
    {
      echo '<script>alert("This food already added to cart")</script>';
      echo '<script>window.location="cart.php"</script>';
    }
  }
  else
  {
    $item_array = array(
    'food_id' => $_GET["id"],
    'food_name' => $_POST["hidden_name"],
    'food_price' => $_POST["hidden_price"],
    'c_id' => $_POST["hidden_c_id"],
    'food_quantity' => $_POST["quantity"],
    );
    $_SESSION["cart"][0] = $item_array;
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>FoodTiger - Mon Panier</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Votre panier de commande - Restaurant gastronomique d'hôtel">
    
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
    <link rel="stylesheet" href="css/cart.css">
</head>

<body>
    <!-- Header -->
    <header class="sticky-top">        
        <?php 
          require "navandfooter/nav.php";
        ?>        
    </header>

    <!-- Cart Header Section -->
    <section class="cart-header-section">
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
                            <li class="breadcrumb-item active" aria-current="page">
                                Mon Panier
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

    <?php if(!empty($_SESSION["cart"])) { ?>
    <!-- Cart Content Section -->
    <section class="cart-content-section">
        <div class="container">
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8 col-md-12 mb-4" data-aos="fade-right">
                    <div class="cart-items-container">
                        <div class="cart-header">
                            <h2 class="cart-title">
                                <i class="fas fa-shopping-cart me-2"></i>Ma Commande
                            </h2>
                            <p class="cart-subtitle">Vérifiez vos plats sélectionnés</p>
    </div>

                        <div class="cart-items-list">
          <?php  
            $total = 0;
                                $itemCount = 0;
            foreach($_SESSION["cart"] as $keys => $values)
            {
                                    $itemCount++;
                                    $itemTotal = $values["food_quantity"] * $values["food_price"];
                                    $total += $itemTotal;
                            ?>
                            <div class="cart-item" data-aos="fade-up" data-aos-delay="<?php echo $itemCount * 100; ?>">
                                <div class="item-image">
                                    <img src="image/food.jpg" alt="<?php echo htmlspecialchars($values["food_name"]); ?>" class="food-image">
                                    <div class="item-badge">
                                        <span class="badge bg-warning">
                                            <i class="fas fa-star me-1"></i>Chef's Choice
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="item-details">
                                    <div class="item-header">
                                        <h4 class="item-name"><?php echo htmlspecialchars($values["food_name"]); ?></h4>
                                        <div class="item-rating">
                                            <div class="stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="item-description">
                                        <p>Plat gastronomique préparé avec des ingrédients frais et des techniques traditionnelles.</p>
                                    </div>
                                    
                                    <div class="item-features">
                                        <span class="feature-tag">
                                            <i class="fas fa-clock me-1"></i>15-20 min
                                        </span>
                                        <span class="feature-tag">
                                            <i class="fas fa-leaf me-1"></i>Frais
                                        </span>
                                        <span class="feature-tag">
                                            <i class="fas fa-fire me-1"></i>À la commande
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="item-quantity">
                                    <label class="quantity-label">Quantité:</label>
                                    <div class="quantity-controls">
                                        <button type="button" class="qty-btn" onclick="updateQuantity(<?php echo $keys; ?>, -1)">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="quantity-display"><?php echo $values["food_quantity"]; ?></span>
                                        <button type="button" class="qty-btn" onclick="updateQuantity(<?php echo $keys; ?>, 1)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="item-price">
                                    <div class="price-breakdown">
                                        <span class="price-label">Prix unitaire:</span>
                                        <span class="price-amount">€<?php echo number_format($values["food_price"], 2); ?></span>
                                    </div>
                                    <div class="item-total">
                                        <span class="total-label">Total:</span>
                                        <span class="total-amount">€<?php echo number_format($itemTotal, 2); ?></span>
                                    </div>
                                </div>
                                
                                <div class="item-actions">
                                    <a href="database/cartcode.php?action=delete&id=<?php echo $values["food_id"]; ?>" 
                                       class="btn btn-outline-danger btn-sm remove-btn"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce plat ?')">
                                        <i class="fas fa-trash me-1"></i>Supprimer
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="col-lg-4 col-md-12" data-aos="fade-left">
                    <div class="order-summary-card">
                        <div class="summary-header">
                            <h3 class="summary-title">
                                <i class="fas fa-receipt me-2"></i>Récapitulatif
                            </h3>
                        </div>
                        
                        <div class="summary-content">
                            <div class="summary-item">
                                <span class="item-label">Nombre de plats:</span>
                                <span class="item-value"><?php echo count($_SESSION["cart"]); ?></span>
                            </div>
                            
                            <div class="summary-item">
                                <span class="item-label">Total articles:</span>
                                <span class="item-value"><?php 
                                    $totalItems = 0;
                                    foreach($_SESSION["cart"] as $values) {
                                        $totalItems += $values["food_quantity"];
                                    }
                                    echo $totalItems;
                                ?></span>
                            </div>
                            
                            <div class="summary-divider"></div>
                            
                            <div class="summary-item total-item">
                                <span class="item-label">Total commande:</span>
                                <span class="item-value total-price">€<?php echo number_format($total, 2); ?></span>
                            </div>
                        </div>
                        
                        <div class="summary-actions">
                            <a href="database/cartcode.php?action=empty" 
                               class="btn btn-outline-danger btn-lg w-100 mb-3"
                               onclick="return confirm('Êtes-vous sûr de vouloir vider votre panier ?')">
                                <i class="fas fa-trash me-2"></i>Vider le panier
                            </a>
                            
                            <a href="food.php" class="btn btn-outline-warning btn-lg w-100 mb-3">
                                <i class="fas fa-utensils me-2"></i>Continuer mes achats
                            </a>
                            
                            <a href="database/paymentoptioncode.php" class="btn btn-warning btn-lg w-100">
                                <i class="fas fa-credit-card me-2"></i>Procéder au paiement
                            </a>
                        </div>
                        
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

    <!-- Special Offers Section -->
    <section class="offers-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4" data-aos="fade-up">
                    <h3 class="offers-title">Suggestions du Chef</h3>
                    <p class="offers-subtitle">Complétez votre commande avec nos spécialités</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 col-sm-12" data-aos="fade-up">
                    <div class="offer-card">
                        <div class="offer-image">
                            <img src="image/food.jpg" alt="Dessert spécial" class="offer-img">
                            <div class="offer-badge">
                                <span class="badge bg-success">-15%</span>
                            </div>
                        </div>
                        <div class="offer-content">
                            <h5 class="offer-title">Dessert du Chef</h5>
                            <p class="offer-description">Crème brûlée à la vanille de Madagascar</p>
                            <div class="offer-price">
                                <span class="original-price">€8.50</span>
                                <span class="discount-price">€7.25</span>
                            </div>
                            <button class="btn btn-warning btn-sm w-100">
                                <i class="fas fa-plus me-1"></i>Ajouter
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="offer-card">
                        <div class="offer-image">
                            <img src="image/food.jpg" alt="Boisson premium" class="offer-img">
                            <div class="offer-badge">
                                <span class="badge bg-info">Nouveau</span>
                            </div>
                        </div>
                        <div class="offer-content">
                            <h5 class="offer-title">Cocktail Signature</h5>
                            <p class="offer-description">Cocktail maison avec fruits frais</p>
                            <div class="offer-price">
                                <span class="discount-price">€12.00</span>
                            </div>
                            <button class="btn btn-warning btn-sm w-100">
                                <i class="fas fa-plus me-1"></i>Ajouter
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="offer-card">
                        <div class="offer-image">
                            <img src="image/food.jpg" alt="Entrée spéciale" class="offer-img">
                            <div class="offer-badge">
                                <span class="badge bg-warning">Populaire</span>
                            </div>
                        </div>
                        <div class="offer-content">
                            <h5 class="offer-title">Entrée Gourmet</h5>
                            <p class="offer-description">Foie gras poêlé aux figues</p>
                            <div class="offer-price">
                                <span class="discount-price">€18.50</span>
                            </div>
                            <button class="btn btn-warning btn-sm w-100">
                                <i class="fas fa-plus me-1"></i>Ajouter
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="300">
                    <div class="offer-card">
                        <div class="offer-image">
                            <img src="image/food.jpg" alt="Vin premium" class="offer-img">
                            <div class="offer-badge">
                                <span class="badge bg-primary">Premium</span>
                            </div>
                        </div>
                        <div class="offer-content">
                            <h5 class="offer-title">Vin de la Maison</h5>
                            <p class="offer-description">Sélection spéciale du sommelier</p>
                            <div class="offer-price">
                                <span class="discount-price">€25.00</span>
                            </div>
                            <button class="btn btn-warning btn-sm w-100">
                                <i class="fas fa-plus me-1"></i>Ajouter
                            </button>
                        </div>
                    </div>
                </div>
      </div>
    </div>
    </section>

    <?php } else { ?>
    <!-- Empty Cart Section -->
    <section class="empty-cart-section">
  <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12 text-center" data-aos="fade-up">
                    <div class="empty-cart-content">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h2 class="empty-cart-title">Votre panier est vide</h2>
                        <p class="empty-cart-subtitle">Oups ! Nous ne sentons aucun plat ici. Retournez à la carte et commandez maintenant.</p>
                        <div class="empty-cart-actions">
                            <a href="food.php" class="btn btn-warning btn-lg px-5 py-3 me-3 mb-2">
                                <i class="fas fa-utensils me-2"></i>Voir la carte
                            </a>
                            <a href="category.php" class="btn btn-outline-warning btn-lg px-5 py-3 mb-2">
                                <i class="fas fa-th-large me-2"></i>Explorer les cuisines
                            </a>
                        </div>
                    </div>
                </div>
      </div>
    </div>
    </section>
    <?php } ?>

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

        // Fonction pour mettre à jour la quantité
        function updateQuantity(itemIndex, change) {
            // Ici vous pouvez implémenter la logique AJAX pour mettre à jour la quantité
            // Pour l'instant, on affiche juste une confirmation
            if (change > 0) {
                alert('Quantité augmentée !');
            } else {
                alert('Quantité diminuée !');
            }
        }

        // Animation des cartes d'offres
        document.addEventListener('DOMContentLoaded', function() {
            const offerCards = document.querySelectorAll('.offer-card');
            
            offerCards.forEach((card, index) => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px)';
                    this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
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

        // Animation des boutons
        document.addEventListener('DOMContentLoaded', function() {
            const addButtons = document.querySelectorAll('.offer-card .btn');
            
            addButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check me-1"></i>Ajouté !';
                    this.classList.remove('btn-warning');
                    this.classList.add('btn-success');
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('btn-success');
                        this.classList.add('btn-warning');
                    }, 2000);
                });
            });
        });
    </script>
    </body>
</html>
    
