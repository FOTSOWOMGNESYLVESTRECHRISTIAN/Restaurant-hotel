<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<header>        
        <!-- nav bar -->
        <nav class="navbar navbar-expand-md  navbar-dark fixed-top" style="background-image: linear-gradient( 109.6deg,  rgba(255,207,84,1) 11.2%, rgba(255,158,27,1) 91.1% );">
            <!-- Image -->
            <a class="navbar-brand" href="index.php"><img src="image/logo 256x256.png" alt="logo" width="30" height="30" style="margin-left:30%; display: block;max-width: 100%;"></a>
          
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2 " id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="category.php">Categories</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="food.php">Foods</a>
                    </li>
                    <?php
                    if (isset($_SESSION['Name'])) { ?>
                       <li class="nav-item active"><a href="userprofile.php" href="#" class="nav-link">Hi, <?php echo $_SESSION['Name']?></a></li>
                      <li class="nav-item active"><a class="nav-link" href="database/lognoutcode.php" style="width:auto;" onclick="return confirm('Are you sure?')">Logout</a></li>
                      <li class="nav-item active">
                      <a class="nav-link" href="cart.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
                      </li>
                     <?php
                     } else { ?>
                       <li class='nav-item active'><a class='nav-link' href="login.php" style="width:auto;">Login</a></li>
                       <li class="nav-item active"><a class="nav-link" href="register.php" style="width:auto;">Sign Up</a></li>
                        <?php
                     } 
                    ?>
                </ul>
            </div>
          </nav>
    </header>
