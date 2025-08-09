<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
// Si déjà connecté, redirection vers le tableau de bord
if (isset($_SESSION['ad_id'])) { header('Location: adminhome.php'); exit; }
include "../database/connection.php";
// Préparer gestion d'erreur et valeur saisie
$loginError = null;
$enteredEmail = '';
$hasError = false;
if (isset($_POST['login'])) {
  $Email  = $_POST['Email'];
  $Password = $_POST['Password'];
  $enteredEmail = $Email;
  mysqli_real_escape_string($conn, $Email);
  mysqli_real_escape_string($conn, $Password);
$query = "SELECT * FROM admin WHERE Email = '$Email'";
$result = mysqli_query($conn , $query) or die (mysqli_error($conn));
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
    $cus_id = $row['ad_id'];
    $Name = $row['Name'];
    $Email = $row['Email'];
    $pass = $row['Password'];
    if (password_verify($Password, $pass )) {
      $_SESSION['ad_id'] = $cus_id;
      $_SESSION['Name'] = $Name;
      $_SESSION['Email'] = $Email;
      header('location: adminhome.php');
        exit;
      } else {
        $loginError = "Email ou mot de passe invalide.";
        $hasError = true;
      }
    }
  } else {
    $loginError = "Email ou mot de passe invalide.";
    $hasError = true;
  }
}
?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Connexion — Administration Restaurant</title>
  <link rel="shortcut icon" type="image/x-icon" href="../image/logo 256x256.png" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <style>
    :root { --brand-start:#ffcf54; --brand-end:#ff9e1b; }
    html, body { height:100%; }
    /* Background image with subtle dark overlay for legibility */
    body {
      background-image:
        linear-gradient(rgba(17,24,39,.55), rgba(17,24,39,.55)),
        url('../image/hotel-bg.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      background-repeat: no-repeat;
    }
    .auth-wrapper { min-height: 100vh; }
    .auth-card { border: none; border-radius: 1rem; box-shadow: 0 12px 28px rgba(0,0,0,.18); overflow: hidden; backdrop-filter: saturate(120%); }
    .auth-header { display:flex; align-items:center; padding:1rem 1.25rem; background:rgba(255,255,255,.9); }
    .auth-header img { width:36px; height:36px; margin-right:.6rem; }
    .auth-body { background:#fff; padding:1.5rem; }
    .brand-title { font-weight:700; }
    .brand-sub { color:#374151; }
    .input-group-text { background:#fff; color:#6b7280; border-color:#e5e7eb; }
    .form-control { padding-top:.95rem; padding-bottom:.95rem; border-color:#e5e7eb; }
    .form-control:focus { box-shadow: 0 0 0 .2rem rgba(255,158,27,.25); border-color: rgba(255,158,27,.7); }
    .btn-brand { background-image: linear-gradient(109.6deg, var(--brand-start) 11.2%, var(--brand-end) 91.1%); color:#111; border:none; }
    .btn-brand:hover { filter: brightness(.98); color:#000; }
    .toggle-password { cursor: pointer; }
    .small-muted { color: #6c757d; }
    @media (max-width: 767.98px){ .brand-pane { padding: 1.5rem; } }
  </style>
</head>
<body>
  <div class="container auth-wrapper d-flex align-items-center justify-content-center py-5">
    <div class="row w-100 justify-content-center">
      <div class="col-12 col-sm-10 col-md-10 col-lg-8 col-xl-7">
        <div class="card auth-card">
          <div class="row no-gutters">
            <div class="col-md-5 brand-pane">
              <div class="brand-logo mb-2"><img src="../image/logo 256x256.png" alt="Logo" /></div>
              <div class="brand-title">Administration Restaurant</div>
              <div class="brand-sub">Gérez les commandes, menus et paiements depuis un espace sécurisé.</div>
            </div>
            <div class="col-md-7 form-pane">
              <div class="card-body p-4 p-md-5">
                <?php if (!empty($loginError)) { ?>
                  <div class="alert alert-danger" role="alert">
                    <i class="fa fa-exclamation-circle"></i> <?php echo $loginError; ?>
                  </div>
                <?php } ?>
                <h5 class="mb-3">Connexion administrateur</h5>
                <form class="needs-validation" name="login" action="adminlogin.php" method="POST" novalidate>
                  <div class="form-group">
                    <label for="inputEmail">Adresse e-mail</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                      </div>
                      <input id="inputEmail" type="email" class="form-control <?php echo $hasError ? 'is-invalid' : ''; ?>" name="Email" placeholder="admin@hotel.com" value="<?php echo htmlspecialchars($enteredEmail); ?>" required autofocus autocomplete="email" aria-describedby="emailHelp" />
                    </div>
                    <div id="emailHelp" class="invalid-feedback">Veuillez saisir une adresse e-mail valide.</div>
                  </div>
                  <div class="form-group mb-2">
                    <label for="inputPassword">Mot de passe</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                      </div>
                      <input id="inputPassword" type="password" class="form-control <?php echo $hasError ? 'is-invalid' : ''; ?>" name="Password" placeholder="••••••••" required autocomplete="current-password" aria-describedby="passwordHelp" />
                      <div class="input-group-append">
                        <button type="button" class="input-group-text toggle-password" id="togglePassword" aria-label="Afficher le mot de passe" aria-pressed="false"><i class="fa fa-eye"></i></button>
                      </div>
                    </div>
                    <div id="passwordHelp" class="invalid-feedback">Veuillez entrer votre mot de passe.</div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="rememberMe" name="remember" />
                      <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                    </div>
                    <a href="#" class="small">Mot de passe oublié ?</a>
                  </div>
                  <button type="submit" name="login" value="Sign In" class="btn btn-brand btn-block">Se connecter</button>
                  <div class="text-center mt-2 small-muted">En vous connectant, vous acceptez nos conditions d'utilisation.</div>
                </form>
                <div class="text-center mt-3">
                  <small class="text-muted">Pas de compte admin ? <a href="adminregister.php">Créer un compte</a></small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    (function(){
      var toggle = document.getElementById('togglePassword');
      var input = document.getElementById('inputPassword');
      if (toggle && input) {
        toggle.addEventListener('click', function(){
          var isPassword = input.getAttribute('type') === 'password';
          input.setAttribute('type', isPassword ? 'text' : 'password');
          this.setAttribute('aria-pressed', (!isPassword).toString());
          this.querySelector('i').classList.toggle('fa-eye');
          this.querySelector('i').classList.toggle('fa-eye-slash');
        });
      }
      // Validation Bootstrap 4
      var forms = document.getElementsByClassName('needs-validation');
      Array.prototype.forEach.call(forms, function(form){
        form.addEventListener('submit', function(event){
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>
</body>
</html>