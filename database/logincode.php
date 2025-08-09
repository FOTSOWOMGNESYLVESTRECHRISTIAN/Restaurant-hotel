<?php
include "connection.php";
session_start();

function safe_redirect_path($path) {
  // Allow only internal relative paths without scheme/host
  if (empty($path)) return 'index.php';
  // Prevent open redirect: disallow absolute URLs and protocol-relative
  if (preg_match('/^https?:\/\//i', $path) || strpos($path, '//') === 0) {
    return 'index.php';
  }
  // Basic normalization
  $path = ltrim($path, "/");
  // Optional whitelist of allowed pages
  $allowed = [
    'index.php','userprofile.php','cart.php','category.php','food.php','aboutus.php'
  ];
  if (in_array($path, $allowed, true)) return $path;
  // Fallback to index
  return 'index.php';
}

if (isset($_POST['login'])) {
  $Email  = $_POST['Email'];
  $Password = $_POST['Password'];
  $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'userprofile.php';
  $redirect = safe_redirect_path($redirect);

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
        $_SESSION['PhoneNo'] = $PhoneNo;
        $_SESSION['Address'] = $Address;
        header('location: ../' . $redirect);
        exit();
      }
      else {
        echo "<script>alert('invalid username/password !');
        window.location.href= '../login.php';</script>";
        exit();
      }
    }
  }
  else {
    echo "<script>alert('invalid username/password');
    window.location.href= '../login.php';</script>";
    exit();
  }
}
?>