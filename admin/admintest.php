<?php  
include "../database/connection.php";
session_start();  

?>  
<html>  
 <head>  
  <title>Webslesson - Tutorial</title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <style>  
  body  
  {  
   margin:0;  
   padding:0;  
   background-color:#f1f1f1;  
  }  
  .box  
        {  
   width:500px;  
   padding:20px;  
   background-color:#fff;  
  }  
  </style>  
 </head>  
 <body>  
  <div class="container box">  
   <h3 align="center">Welcome - <?php echo $_SESSION["Email"]; ?></h3>
   <br />
   <p><a href="s.php">Other</a></p>
   <p><a href="adminlognout.php"  onclick="return confirm('Are you sure?')">Logout</a></p>
  </div>  
 </body>  
</html>
 