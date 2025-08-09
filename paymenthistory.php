<?php
session_start();
require('database/connection.php');
require('database/pdo.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['Email'])) {
    echo "<script>alert('Veuillez vous connecter pour accéder à l\'historique des paiements.'); window.location.href='login.php';</script>";
    exit();
}

$Email = $_SESSION['Email'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>FoodTiger - Historique des Paiements</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Consultez votre historique des paiements - FoodTiger Restaurant">
    
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

        .history-section {
            padding: 4rem 0;
            background: var(--bg-white);
        }

        .history-container {
            background: var(--bg-white);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .history-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .history-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .history-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .table-container {
            padding: 2rem;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--bg-white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            font-weight: 600;
            padding: 1.5rem 1rem;
            border: none;
            text-align: left;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: var(--bg-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .table tbody td {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .order-id {
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: var(--primary-color);
            background: rgba(255, 189, 0, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
        }

        .price {
            font-weight: 600;
            color: var(--success-color);
            font-size: 1.1rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-completed {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }

        .btn-delete {
            background: linear-gradient(135deg, var(--danger-color), #c82333);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .empty-state p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 50px;
            padding: 1rem 2rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 189, 0, 0.3);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .table-container {
                padding: 1rem;
            }

            .table {
                font-size: 0.9rem;
            }

            .table thead th,
            .table tbody td {
                padding: 1rem 0.5rem;
            }

            .order-id {
                font-size: 0.8rem;
                padding: 0.25rem 0.5rem;
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
                            <li class="breadcrumb-item">
                                <a href="userprofile.php" class="breadcrumb-link">Profil</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Historique des Paiements
                            </li>
                        </ol>
                    </nav>
                </div>
              </div>
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">Historique des Paiements</h1>
                <p class="hero-subtitle">Consultez tous vos paiements et commandes passées</p>
            </div>
        </div>
    </section>

    <!-- History Section -->
    <section class="history-section">
        <div class="container">
            <div class="history-container" data-aos="fade-up">
                <div class="history-header">
                    <h2 class="history-title">
                        <i class="fas fa-history me-2"></i>Vos Commandes
                    </h2>
                    <p class="history-subtitle">Retrouvez l'historique complet de vos transactions</p>
                </div>

                <div class="table-container">
                    <?php
                    $currentuser = $_SESSION['Email'];
                    $query = "SELECT * FROM payment WHERE Email= '$currentuser' ORDER BY time_date DESC";
                    $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    
                    if (mysqli_num_rows($run_query) > 0) {
                    ?>
                        <div class="table-responsive">
                            <table class="table">
                  <thead>
                    <tr>
                                        <th><i class="fas fa-cog me-2"></i>Actions</th>
                                        <th><i class="fas fa-hashtag me-2"></i>N° Commande</th>
                                        <th><i class="fas fa-envelope me-2"></i>Email</th>
                                        <th><i class="fas fa-user me-2"></i>Nom</th>
                                        <th><i class="fas fa-phone me-2"></i>Téléphone</th>
                                        <th><i class="fas fa-map-marker-alt me-2"></i>Adresse</th>
                                        <th><i class="fas fa-euro-sign me-2"></i>Prix</th>
                                        <th><i class="fas fa-credit-card me-2"></i>Carte</th>
                                        <th><i class="fas fa-calendar me-2"></i>Date & Heure</th>
                    </tr> 
                  </thead>
                  <tbody>
                  <?php
                while ($row = mysqli_fetch_array($run_query)) {
                    $order_id = $row['order_id'];
                    $Email = $row['Email'];
                    $Name = $row['Name'];
                    $PhoneNo = $row['PhoneNo'];
                    $Address = $row['Address'];
                    $price = $row['price'];
                    $Card = $row['Card'];
                    $Month = $row['Month'];
                    $Year = $row['Year'];
                    $CCV = $row['CCV'];
                    $time_date = $row['time_date'];
                                    ?>
                                        <tr data-aos="fade-up">
                                            <td>
                                                <a class="btn btn-delete" 
                                                   onClick="javascript: return confirm('Êtes-vous sûr de vouloir supprimer cet historique de commande ?')" 
                                                   href='?del=<?php echo $order_id; ?>'>
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <span class="order-id"><?php echo $order_id; ?></span>
                                            </td>
                                            <td><?php echo $Email; ?></td>
                                            <td><strong><?php echo $Name; ?></strong></td>
                                            <td><?php echo $PhoneNo; ?></td>
                                            <td><?php echo $Address; ?></td>
                                            <td class="price">€<?php echo number_format($price, 2); ?></td>
                                            <td>
                                                <span class="status-badge status-completed">
                                                    <?php echo $Card . '-' . $Month . '-' . $Year . '-' . $CCV; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($time_date)); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                      </tbody>
                </table>        
              </div>
                <?php
                    } else {
                    ?>
                        <div class="empty-state" data-aos="fade-up">
                            <i class="fas fa-history"></i>
                            <h3>Aucun historique pour le moment</h3>
                            <p>Vous n'avez pas encore effectué de commandes. Commencez à commander maintenant !</p>
                            <a href="category.php" class="btn btn-primary-custom">
                                <i class="fas fa-utensils"></i>
                                Commander Maintenant
                            </a>
                        </div>
                    <?php
                    }
                    ?>
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

        // Animation des lignes du tableau
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('.table tbody tr');
            tableRows.forEach((row, index) => {
                setTimeout(() => {
                    row.classList.add('fade-in-up');
                }, index * 100);
            });
        });
    </script>
</body>
</html>

<?php
$conn = mysqli_connect("localhost","root","","foodtiger" ) or die ("error" . mysqli_error($conn));
if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $del_query = "DELETE FROM payment WHERE order_id = '$del_id'";
    if (mysqli_query($conn, $del_query)) {
        echo "<script>alert('Historique supprimé avec succès!');
        window.location.href='paymenthistory.php';</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression!');
        window.location.href='paymenthistory.php';</script>";
    }
}
?>