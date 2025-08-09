<?php  
include "database/connection.php";
include "database/updatecode.php";

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
    <title>FoodTiger - Modifier le Profil</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Modifiez vos informations personnelles - FoodTiger Restaurant">
    
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

        .profile-form {
            padding: 3rem;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: block;
            font-size: 1rem;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 15px;
            padding: 1rem 1.5rem;
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

        .form-control:read-only {
            background: var(--bg-light);
            color: var(--text-light);
        }

        .btn-update {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 50px;
            padding: 1rem 3rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(255, 189, 0, 0.3);
            width: 100%;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(255, 189, 0, 0.4);
            color: white;
        }

        .profile-info {
            background: var(--bg-light);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
        }

        .info-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .info-list {
            list-style: none;
            padding: 0;
        }

        .info-list li {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            padding: 1rem;
            background: var(--bg-white);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .info-list li i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .profile-form {
                padding: 2rem 1.5rem;
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
                            <li class="breadcrumb-item">
                                <a href="userprofile.php" class="breadcrumb-link">Profil</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Modifier le Profil
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">Modifier le Profil</h1>
                <p class="hero-subtitle">Mettez à jour vos informations personnelles</p>
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
                                <i class="fas fa-user-edit me-2"></i>Modifier le Profil
                            </h2>
                            <p class="profile-subtitle">Mettez à jour vos informations personnelles</p>
                        </div>

                        <div class="profile-avatar" data-aos="fade-up" data-aos-delay="100">
      <img src="image/avatar6.png" alt="Avatar" class="avatar">
    </div>

                        <form class="profile-form" action="database/updatecode.php" method="POST" data-aos="fade-up" data-aos-delay="200">
                            <div class="form-group">
                                <label for="Name" class="form-label">
                                    <i class="fas fa-user me-2"></i>Nom d'utilisateur
                                </label>
                                <input type="text" 
                                       name="Name" 
                                       id="Name" 
                                       value="<?php echo htmlspecialchars($_SESSION['Name']); ?>" 
                                       class="form-control"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="Email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input type="email" 
                                       name="Email" 
                                       id="Email" 
                                       value="<?php echo htmlspecialchars($_SESSION['Email']); ?>" 
                                       class="form-control"
                                       readonly>
                            </div>

                            <div class="form-group">
                                <label for="PhoneNo" class="form-label">
                                    <i class="fas fa-phone me-2"></i>Numéro de téléphone
                                </label>
                                <input type="text" 
                                       name="PhoneNo" 
                                       id="PhoneNo" 
                                       value="<?php echo htmlspecialchars($_SESSION['PhoneNo']); ?>" 
                                       class="form-control"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="Address" class="form-label">
                                    <i class="fas fa-map-marker-alt me-2"></i>Adresse
                                </label>
                                <input type="text" 
                                       name="Address" 
                                       id="Address" 
                                       value="<?php echo htmlspecialchars($_SESSION['Address']); ?>" 
                                       class="form-control"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="Password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Nouveau mot de passe (laisser vide si inchangé)
                                </label>
                                <input type="password" 
                                       name="Password" 
                                       id="Password" 
                                       class="form-control"
                                       placeholder="Entrez votre nouveau mot de passe">
                            </div>

                            <button type="submit" 
                                    name="update" 
                                    class="btn btn-update"
                                    onclick="return confirm('Êtes-vous sûr de vouloir mettre à jour votre profil ?')">
                                <i class="fas fa-save me-2"></i>Mettre à Jour le Profil
                            </button>
                        </form>

                        <!-- Profile Info -->
                        <div class="profile-info" data-aos="fade-up" data-aos-delay="300">
                            <h4 class="info-title">
                                <i class="fas fa-info-circle me-2"></i>Informations importantes
                            </h4>
                            <ul class="info-list">
                                <li>
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Vos informations sont protégées et ne seront jamais partagées</span>
                                </li>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <span>L'email ne peut pas être modifié pour des raisons de sécurité</span>
                                </li>
                                <li>
                                    <i class="fas fa-key"></i>
                                    <span>Laissez le champ mot de passe vide si vous ne souhaitez pas le changer</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>Toutes les modifications sont sauvegardées automatiquement</span>
                                </li>
                            </ul>
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

        // Validation du formulaire
        document.querySelector('form').addEventListener('submit', function(e) {
            const name = document.getElementById('Name').value.trim();
            const phoneNo = document.getElementById('PhoneNo').value.trim();
            const address = document.getElementById('Address').value.trim();
            
            if (name === '' || phoneNo === '' || address === '') {
                e.preventDefault();
                alert('Veuillez remplir tous les champs obligatoires.');
                return false;
            }
        });
    </script>
</body>
</html>