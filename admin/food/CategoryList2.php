<?php
session_start();
if (!isset($_SESSION['ad_id'])) { header('Location: ../adminlogin.php'); exit; }
require('../../database/mysql.php');

$c_id = isset($_GET['c_id']) ? $_GET['c_id'] : '';
$name = $description = $image = $category_exixts = '';
if ($c_id !== '') {
  $sql = "SELECT * FROM category WHERE c_id = '" . mysqli_real_escape_string($conn, $c_id) . "'";
  $result = $conn->query($sql);
  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $description = $row['description'];
    $image = $row['image'];
    $category_exixts = $row['category_exixts'];
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Modifier une catégorie — Administration Restaurant Hôtel</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../image/logo 256x256.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
      :root { --brand-start:#ffcf54; --brand-end:#ff9e1b; --sidebar-bg:#1f2937; --sidebar-text:#e5e7eb; --sidebar-active:#111827; --card-shadow:0 6px 16px rgba(0,0,0,.08); }
      html, body { height: 100%; background-color: #f7f7f9; }
      .admin-wrapper { display:flex; min-height:100vh; overflow:hidden; }
      #sidebar { width:260px; min-width:260px; background:var(--sidebar-bg); color:var(--sidebar-text); display:flex; flex-direction:column; z-index:1029; transition: transform .25s ease-in-out; }
      #sidebar .brand { display:flex; align-items:center; padding:1rem 1.25rem; background-image: linear-gradient(109.6deg, var(--brand-start) 11.2%, var(--brand-end) 91.1%); color:#111; font-weight:700; }
      #sidebar .brand img { height:28px; width:28px; margin-right:.6rem; }
      #sidebar .menu { padding:.75rem 0; overflow-y:auto; flex:1; }
      #sidebar .menu a { display:flex; align-items:center; padding:.7rem 1.1rem; color:var(--sidebar-text); text-decoration:none; font-size:.95rem; }
      #sidebar .menu a .fa { width:22px; margin-right:.65rem; }
      #sidebar .menu a:hover, #sidebar .menu a.active { background:var(--sidebar-active); color:#fff; }
      #sidebar .menu .section-title { padding:.75rem 1.1rem; text-transform:uppercase; letter-spacing:.08em; font-size:.75rem; color:#9ca3af; }
      .content { flex:1; display:flex; flex-direction:column; min-width:0; }
      .topbar { height:64px; display:flex; align-items:center; justify-content:space-between; padding:0 1rem; background:#fff; box-shadow:0 2px 10px rgba(0,0,0,.05); position:sticky; top:0; z-index:1028; }
      .topbar .toggle-btn { display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; border-radius:8px; border:none; background-image: linear-gradient(109.6deg, var(--brand-start) 11.2%, var(--brand-end) 91.1%); color:#111; }
      .page-content { padding: 1.25rem; }
      .card-elevated { border:none; border-radius:.75rem; box-shadow:var(--card-shadow); }
      #profileDisplay { width: 120px; height: 120px; object-fit: cover; border-radius: 10px; cursor: pointer; border: 1px dashed #ddd; }
      @media (max-width: 991.98px) { #sidebar{ position:fixed; top:0; bottom:0; transform:translateX(-100%);} #sidebar.show{ transform:translateX(0);} .overlay{ display:none; position:fixed; inset:0; background:rgba(0,0,0,.28); z-index:1027;} .overlay.show{ display:block;} }
    </style>
    <script src="../../js/picture.js"></script>
    <script src="../../js/confirmUpdate.js"></script>
</head>
  <body>
    <div class="admin-wrapper">
      <aside id="sidebar">
        <div class="brand">
          <img src="../../image/logo 256x256.png" alt="Logo" />
          <span>Admin Restaurant</span>
                           </div>
        <div class="menu">
          <div class="section-title">Tableau de bord</div>
          <a href="../adminhome.php"><i class="fa fa-home"></i> Accueil</a>
          <div class="section-title">Gestion</div>
          <a class="active" href="admincontrolside.php"><i class="fa fa-cutlery"></i> Gestion des plats</a>
          <a href="../viewhistoryOrder.php"><i class="fa fa-list-alt"></i> Commandes</a>
          <a href="../viewPayhistory.php"><i class="fa fa-credit-card"></i> Paiements</a>
          <a href="../viewCustomerAcc.php"><i class="fa fa-users"></i> Clients</a>
          <a href="../viewfeedback.php"><i class="fa fa-comments"></i> Avis & Feedback</a>
          <a href="../viewblog.php"><i class="fa fa-newspaper-o"></i> Blog</a>
          <div class="section-title">Autres</div>
          <a href="../view.php"><i class="fa fa-history"></i> Activités</a>
          <a href="../adminlognout.php" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')"><i class="fa fa-sign-out"></i> Déconnexion</a>
                        </div>  
      </aside>

      <div class="content">
        <div class="topbar">
          <button id="sidebarToggle" class="toggle-btn d-lg-none" aria-label="Ouvrir/Fermer le menu"><i class="fa fa-bars"></i></button>
          <div class="brand-title">Modifier une catégorie</div>
          <div class="d-flex align-items-center">
            <a href="category.php" class="btn btn-sm btn-outline-secondary"><i class="fa fa-list"></i> Liste</a>
                                    </div>
                                </div>
          
        <div class="page-content">
          <div class="card card-elevated">
            <div class="card-body">
              <form action="updateCategory.php" method="POST" enctype="multipart/form-data" onsubmit="return ConfirmUpdate();">
                <input type="hidden" name="c_id" value="<?php echo htmlspecialchars($c_id); ?>" />

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name">Nom de la catégorie</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required />
                                    </div>
                  <div class="form-group col-md-6">
                    <label for="category_exixts">Statut</label>
                    <select name="category_exixts" id="category_exixts" class="form-control">
                      <option value="<?php echo htmlspecialchars($category_exixts); ?>"><?php echo htmlspecialchars($category_exixts ?: '—'); ?></option>
                                            <option value="exixts">Exixts</option>
                                            <option value="no exixts">No Exixts</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($description); ?></textarea>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Image</label><br />
                    <img src="../../image/<?php echo htmlspecialchars($image ?: 'uknown.png'); ?>" id="profileDisplay" alt="Aperçu" onclick="triggerClick()" />
                    <input name="image" type="file" id="image" onchange="displayImage(this)" style="display:none" accept="image/*" />
                                    </div>
                                </div>
                                 
                <div class="text-right">
                  <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-check"></i> Mettre à jour</button>
                </div>
              </form>
                                    </div>
                                </div>
                                
          <div class="text-center text-muted small mt-4 mb-2">© <?php echo date('Y'); ?> Restaurant Admin — Tous droits réservés</div>
        </div>
                         </div>
         </div> 

    <div class="overlay" id="overlay"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      (function(){
        var sidebar = document.getElementById('sidebar');
        var overlay = document.getElementById('overlay');
        var toggle = document.getElementById('sidebarToggle');
        function closeSidebar(){ sidebar.classList.remove('show'); overlay.classList.remove('show'); }
        function openSidebar(){ sidebar.classList.add('show'); overlay.classList.add('show'); }
        if (toggle) {
          toggle.addEventListener('click', function(){
            if (sidebar.classList.contains('show')) { closeSidebar(); } else { openSidebar(); }
          });
        }
        if (overlay) overlay.addEventListener('click', closeSidebar);
        Array.prototype.forEach.call(sidebar.querySelectorAll('.menu a'), function(a){ a.addEventListener('click', closeSidebar); });
      })();
    </script>
  </body>
</html>