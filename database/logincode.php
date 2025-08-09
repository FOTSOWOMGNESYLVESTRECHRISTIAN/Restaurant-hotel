<?php
include "connection.php";
session_start();
if (isset($_POST['login'])) {
  $Email  = $_POST['Email'];
  $Password = $_POST['Password'];
  mysqli_real_escape_string($conn, $Email);
  mysqli_real_escape_string($conn, $Password);
$query = "SELECT * FROM customer WHERE Email = '$Email'";
$result = mysqli_query($conn , $query) or die (mysqli_error($conn));
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
    $cus_id = $row['cus_id'];
    $Name = $row['Name'];
    $Email = $row['Email'];
    $pass = $row['Password'];
    $PhoneNo = $row['PhoneNo'];
    $Address = $row['Address'];
 
    if (password_verify($Password, $pass )) {
      $_SESSION['cus_id'] = $cus_id;
      $_SESSION['Name'] = $Name;
      $_SESSION['Email'] = $Email;
      $_SESSION['email']  = $email;
      $_SESSION['PhoneNo'] = $PhoneNo;
      $_SESSION['Address'] = $Address;
      header('location: ../userprofile.php');
    }
    else {
      echo "<script>alert('invalid username/password !');
      window.location.href= '../index.php';</script>";

    }
  }
}
else {
      echo "<script>alert('invalid username/password');
      window.location.href= '../index.php';</script>";

    }
}
?>