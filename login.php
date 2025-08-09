<?php
session_start();
require 'database/connection.php';

// Rediriger si déjà connecté
if (isset($_SESSION['Email'])) {
    header('location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>FoodTiger - Connexion</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/logo 256x256.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Connectez-vous à votre compte FoodTiger - Restaurant gastronomique d'excellence">
    
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
</head>
<body>
    <?php require "navandfooter/nav.php"; ?>

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
                                Connexion
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">Connexion</h1>
                <p class="hero-subtitle">Accédez à votre compte FoodTiger</p>
            </div>
        </div>
    </section>

    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <div class="login-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="login-header">
                            <div class="login-icon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <h2>Bienvenue</h2>
                            <p>Connectez-vous à votre compte pour continuer</p>
                        </div>

                        <form class="login-form" action="database/logincode.php" method="POST" id="loginForm">
                            <div class="form-group">
                                <label for="Email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Adresse Email
                                </label>
                                <input type="email" 
                                       class="form-control" 
                                       id="Email" 
                                       name="Email" 
                                       placeholder="Entrez votre email"
                                       required>
                                <div class="invalid-feedback">
                                    Veuillez entrer une adresse email valide.
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Mot de passe
                                </label>
                                <div class="password-input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="Password" 
                                           name="Password" 
                                           placeholder="Entrez votre mot de passe"
                                           required>
                                    <button type="button" class="password-toggle" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="passwordIcon"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback">
                                    Le mot de passe est requis.
                                </div>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Se souvenir de moi
                                </label>
                            </div>

                            <button type="submit" class="btn btn-login" name="login" id="loginBtn">
                                <span class="btn-text">
                                    <i class="fas fa-sign-in-alt me-2"></i>Se Connecter
                                </span>
                                <span class="btn-loading d-none">
                                    <i class="fas fa-spinner fa-spin me-2"></i>Connexion...
                                </span>
                            </button>
                        </form>

                        <div class="login-footer">
                            <p class="text-center mb-3">
                                Pas encore de compte ? 
                                <a href="register.php" class="register-link">
                                    <i class="fas fa-user-plus me-1"></i>Créer un compte
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require "navandfooter/footer.php"; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        :root {
            --primary-color: #E6A800;
            --secondary-color: #E67A00;
            --accent-color: #E65A35;
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
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 2rem;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.7);
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

        .breadcrumb-item.active {
            color: rgba(255,255,255,0.7);
        }

        .login-section {
            padding: 4rem 0;
            background: var(--bg-light);
            min-height: 60vh;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 20px rgba(230,168,0,0.3);
        }

        .login-icon i {
            font-size: 2rem;
            color: white;
        }

        .login-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: var(--text-light);
            font-size: 1rem;
            margin: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--bg-light);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(230,168,0,0.25);
            background: white;
        }

        .password-input-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-label {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(230,168,0,0.3);
            color: var(--text-dark);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            margin-top: 2rem;
            text-align: center;
        }

        .register-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link:hover {
            color: var(--secondary-color);
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .login-card {
                padding: 2rem;
                margin: 0 1rem;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                padding: 6rem 0 3rem 0;
            }

            .hero-title {
                font-size: 2rem;
            }

            .login-card {
                padding: 1.5rem;
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

    <script>
        // Initialiser AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('Password');
            const passwordIcon = document.getElementById('passwordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        // Form validation and submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('Email').value.trim();
            const password = document.getElementById('Password').value.trim();
            let isValid = true;

            // Reset validation states
            document.querySelectorAll('.form-control').forEach(input => {
                input.classList.remove('is-invalid');
            });

            // Email validation
            if (!email || !isValidEmail(email)) {
                document.getElementById('Email').classList.add('is-invalid');
                isValid = false;
            }

            // Password validation
            if (!password) {
                document.getElementById('Password').classList.add('is-invalid');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                return false;
            }

            // Show loading state
            const btn = document.getElementById('loginBtn');
            const btnText = btn.querySelector('.btn-text');
            const btnLoading = btn.querySelector('.btn-loading');

            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');
            btn.disabled = true;
        });

        // Email validation function
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Real-time validation
        document.getElementById('Email').addEventListener('blur', function() {
            const email = this.value.trim();
            if (email && !isValidEmail(email)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

        document.getElementById('Password').addEventListener('blur', function() {
            const password = this.value.trim();
            if (!password) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    </script>
</body>
</html>
