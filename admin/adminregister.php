<?php
include "../database/connection.php";
//if user click create buttom
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['insert'])) {
    require "../database/protect.php";
    $gump = new GUMP();
    $_POST = $gump->sanitize($_POST); 
    
    $gump->validation_rules(array(
      'Name'        => 'required|alpha_space|max_len,30|min_len,5',
      'Email'       => 'required|valid_email',
      'Password'    => 'required|max_len,50|min_len,6',
    ));
    $gump->filter_rules(array(
      'Name'     => 'trim|sanitize_string',
      'Password' => 'trim',
      'Email'    => 'trim|sanitize_email',
      ));
      $validated_data = $gump->run($_POST);
      if($validated_data === false) {
        ?>
       <script>alert(' <?php echo $gump->get_readable_errors(true); ?> ')</script>;
        <?php
      }
      else if ($_POST['Password'] !== $_POST['Password2']) 
      {
        echo  "<script>alert('Passwords do not match ')</script>";
      }
     else {
        $Name = $validated_data['Name'];
        $checkusername = "SELECT * FROM admin WHERE Name = '$Name'";
        $run_check = mysqli_query($conn , $checkusername) or die(mysqli_error($conn));
        $countusername = mysqli_num_rows($run_check); 
        if ($countusername > 0 ) {
      echo  "<script>alert('Username is already taken! try a different one')</script>";
        }
      $Email = $validated_data['Email'];
      $checkemail = "SELECT * FROM admin WHERE Email = '$Email'";
          $run_check = mysqli_query($conn , $checkemail) or die(mysqli_error($conn));
          $countemail = mysqli_num_rows($run_check); 
          if ($countemail > 0 ) {
        echo  "<script>alert('Email is already taken! try a different one')</script>";
    }
    else {
    $Name = $validated_data['Name'];
    $Email = $validated_data['Email'];
    $Password = $_POST['Password'];
    $Password = password_hash("$Password" , PASSWORD_DEFAULT);
 
    $query = "INSERT INTO admin(Name,Email,Password) VALUES ('$Name','$Email','$Password')";
    $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn) > 0) { 
      echo "<script>alert('SUCCESSFULLY REGISTERED');
      window.location.href= 'adminlogin.php';</script>";
}
else {
echo "<script>alert('Error ');</script>";
}
}
}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Créer un administrateur — Restaurant Hôtel</title>
    <link rel="shortcut icon" type="image/x-icon" href="../image/logo 256x256.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
      :root { --brand-start:#ffcf54; --brand-end:#ff9e1b; --card-shadow:0 8px 24px rgba(0,0,0,.08); }
      html, body { height:100%; }
      body { display:flex; align-items:center; justify-content:center; min-height:100vh; background-image: linear-gradient(109.6deg, var(--brand-start) 11.2%, var(--brand-end) 91.1%); }
      .auth-card { width:100%; max-width:520px; border:none; border-radius:1rem; box-shadow:var(--card-shadow); overflow:hidden; }
      .auth-header { display:flex; align-items:center; padding:1rem 1.25rem; background:rgba(255,255,255,.9); }
      .auth-header img { width:36px; height:36px; margin-right:.6rem; }
      .auth-body { background:#fff; padding:1.5rem; }
      .form-group label { font-weight:600; color:#374151; }
    </style>
</head>
  <body>
    <div class="card auth-card">
      <div class="auth-header">
        <img src="../image/logo 256x256.png" alt="Logo" />
        <div>
          <div class="h6 mb-0">Administration</div>
          <div class="small text-muted">Création d'un compte administrateur</div>
        </div>
      </div>
      <div class="auth-body">
        <form name="adminregister" action="adminregister.php" method="POST" novalidate>
          <div class="form-group">
            <label for="Name">Nom d'utilisateur</label>
            <input type="text" class="form-control" name="Name" id="Name" required />
          </div>
          <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control" name="Email" id="Email" required />
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="Password">Mot de passe</label>
              <input type="password" class="form-control" name="Password" id="Password" minlength="6" required />
            </div>
            <div class="form-group col-md-6">
              <label for="Password2">Confirmation</label>
              <input type="password" class="form-control" name="Password2" id="Password2" minlength="6" required />
        </div>
        </div>
          <div class="d-flex align-items-center justify-content-between mt-3">
            <a class="small" href="adminlogin.php"><i class="fa fa-sign-in"></i> Déjà un compte ? Connexion</a>
            <button type="submit" name="insert" class="btn btn-primary"><i class="fa fa-user-plus"></i> Créer</button>
        </div> 
    </form>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>