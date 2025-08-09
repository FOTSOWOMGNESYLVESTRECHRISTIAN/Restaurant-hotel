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
    <title>FoodTiger - Avis & Commentaires</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Partagez votre expérience avec FoodTiger - Votre avis nous aide à améliorer notre service">
    
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

        .feedback-section {
            padding: 4rem 0;
            background: var(--bg-white);
        }

        .feedback-container {
            background: var(--bg-white);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .feedback-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .feedback-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .feedback-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .feedback-form {
            padding: 3rem;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
            display: block;
            font-size: 1.1rem;
        }

        .rating-section {
            background: var(--bg-light);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .rating-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .rating-options {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .rating-option {
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 1rem;
            border-radius: 15px;
            border: 2px solid transparent;
        }

        .rating-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .rating-option input[type="radio"] {
            display: none;
        }

        .rating-option label {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .rating-option input[type="radio"]:checked + label {
            color: var(--primary-color);
        }

        .rating-option input[type="radio"]:checked + label .rating-icon {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: scale(1.1);
        }

        .rating-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--bg-white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--text-light);
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .rating-text {
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .btn-submit {
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

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(255, 189, 0, 0.4);
            color: white;
        }

        .feedback-info {
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

            .feedback-form {
                padding: 2rem 1.5rem;
            }

            .rating-options {
                gap: 1rem;
            }

            .rating-option {
                padding: 0.5rem;
            }

            .rating-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
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
                                Avis & Commentaires
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">Avis & Commentaires</h1>
                <p class="hero-subtitle">Aidez-nous à améliorer notre service en partageant votre expérience</p>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="feedback-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="feedback-container" data-aos="fade-up">
                        <div class="feedback-header">
                            <h2 class="feedback-title">
                                <i class="fas fa-comments me-2"></i>Partagez Votre Expérience
                            </h2>
                            <p class="feedback-subtitle">Votre avis nous aide à améliorer notre service et à mieux vous satisfaire</p>
                        </div>

                        <form class="feedback-form" action="database/feedbackcode.php" method="post" data-aos="fade-up" data-aos-delay="100">
                            <!-- Rating Section -->
                            <div class="rating-section">
                                <h3 class="rating-title">
                                    <i class="fas fa-star me-2"></i>Comment trouvez-vous le goût de nos plats ?
                                </h3>
                                <div class="rating-options">
                                    <div class="rating-option" data-aos="fade-up" data-aos-delay="200">
                                        <input type="radio" name="feedback" value="excellent" id="excellent" required>
                                        <label for="excellent">
                                            <div class="rating-icon">
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="rating-text">Excellent</span>
                                        </label>
                                    </div>
                                    <div class="rating-option" data-aos="fade-up" data-aos-delay="300">
                                        <input type="radio" name="feedback" value="good" id="good">
                                        <label for="good">
                                            <div class="rating-icon">
                                                <i class="fas fa-thumbs-up"></i>
                                            </div>
                                            <span class="rating-text">Bon</span>
                                        </label>
                                    </div>
                                    <div class="rating-option" data-aos="fade-up" data-aos-delay="400">
                                        <input type="radio" name="feedback" value="neutral" id="neutral">
                                        <label for="neutral">
                                            <div class="rating-icon">
                                                <i class="fas fa-meh"></i>
                                            </div>
                                            <span class="rating-text">Neutre</span>
                                        </label>
                                    </div>
                                    <div class="rating-option" data-aos="fade-up" data-aos-delay="500">
                                        <input type="radio" name="feedback" value="poor" id="poor">
                                        <label for="poor">
                                            <div class="rating-icon">
                                                <i class="fas fa-thumbs-down"></i>
                                            </div>
                                            <span class="rating-text">Mauvais</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Comments Section -->
                            <div class="form-group">
                                <label for="suggestions" class="form-label">
                                    <i class="fas fa-comment me-2"></i>Avez-vous des commentaires spécifiques ?
                                </label>
                                <textarea 
                                    id="suggestions" 
                                    name="suggestions" 
                                    class="form-control" 
                                    placeholder="Partagez vos suggestions, commentaires ou expériences avec nous..."
                                    rows="4"></textarea>
                            </div>

                            <!-- Hidden Fields -->
                            <input type="hidden" name="Name" value="<?php echo htmlspecialchars($_SESSION['Name']); ?>">
                            <input type="hidden" name="Email" value="<?php echo htmlspecialchars($_SESSION['Email']); ?>">
                            <input type="hidden" name="PhoneNo" value="<?php echo htmlspecialchars($_SESSION['PhoneNo']); ?>">

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-submit">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer Mon Avis
                            </button>
        </form>

                        <!-- Feedback Info -->
                        <div class="feedback-info" data-aos="fade-up" data-aos-delay="200">
                            <h4 class="info-title">
                                <i class="fas fa-info-circle me-2"></i>Pourquoi vos avis sont importants ?
                            </h4>
                            <ul class="info-list">
                                <li>
                                    <i class="fas fa-heart"></i>
                                    <span>Nous aidons à améliorer la qualité de nos plats</span>
                                </li>
                                <li>
                                    <i class="fas fa-users"></i>
                                    <span>Vos suggestions nous permettent de mieux vous servir</span>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                    <span>Votre expérience aide d'autres clients à faire leur choix</span>
                                </li>
                                <li>
                                    <i class="fas fa-cog"></i>
                                    <span>Nous optimisons notre service en fonction de vos retours</span>
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

        // Animation des options de notation
        document.addEventListener('DOMContentLoaded', function() {
            const ratingOptions = document.querySelectorAll('.rating-option');
            
            ratingOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Retirer la sélection précédente
                    ratingOptions.forEach(opt => {
                        opt.querySelector('input[type="radio"]').checked = false;
                        opt.querySelector('.rating-icon').style.background = '';
                        opt.querySelector('.rating-icon').style.color = '';
                        opt.querySelector('.rating-icon').style.transform = '';
                    });
                    
                    // Sélectionner l'option actuelle
                    const radio = this.querySelector('input[type="radio"]');
                    const icon = this.querySelector('.rating-icon');
                    radio.checked = true;
                    icon.style.background = 'linear-gradient(135deg, #FFBD00, #FF8A00)';
                    icon.style.color = 'white';
                    icon.style.transform = 'scale(1.1)';
                });
            });
        });
    </script>
</body>
</html>