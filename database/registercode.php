<?php
include "connection.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function safe_redirect_path($path) {
  if (empty($path)) return 'userprofile.php';
  if (preg_match('/^https?:\/\//i', $path) || strpos($path, '//') === 0) {
    return 'userprofile.php';
  }
  $path = ltrim($path, "/");
  $allowed = [
    'userprofile.php','index.php','cart.php','category.php','food.php','aboutus.php'
  ];
  if (in_array($path, $allowed, true)) return $path;
  return 'userprofile.php';
}

if (isset($_POST['insert'])) {
  require "protect.php";
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
  $redirect = isset($_POST['redirect']) ? safe_redirect_path($_POST['redirect']) : 'userprofile.php';
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
    $checkusername = "SELECT * FROM customer WHERE Name = '$Name'";
    $run_check = mysqli_query($conn , $checkusername) or die(mysqli_error($conn));
    $countusername = mysqli_num_rows($run_check); 
    if ($countusername > 0 ) {
      echo  "<script>alert('Username is already taken! try a different one')</script>";
    }
    $Email = $validated_data['Email'];
    $checkemail = "SELECT * FROM customer WHERE Email = '$Email'";
    $run_check = mysqli_query($conn , $checkemail) or die(mysqli_error($conn));
    $countemail = mysqli_num_rows($run_check); 
    if ($countemail > 0 ) {
      echo  "<script>alert('Email is already taken! try a different one')</script>";
    }

    else {
      $Name = $validated_data['Name'];
      $Email = $validated_data['Email'];
      $Password = $validated_data['Password'];
      $Password = password_hash("$Password" , PASSWORD_DEFAULT);
      $PhoneNo = $_POST['PhoneNo'];
      $Address = $_POST['Address'];
      $query = "INSERT INTO customer(Name,Email,PhoneNo,Address,Password) VALUES ('$Name','$Email','$PhoneNo','$Address','$Password')";
      $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
      if (mysqli_affected_rows($conn) > 0) { 
        // Auto login after registration
        $new_user_id = mysqli_insert_id($conn);
        session_start();
        $_SESSION['cus_id'] = $new_user_id;
        $_SESSION['Name'] = $Name;
        $_SESSION['Email'] = $Email;
        $_SESSION['PhoneNo'] = $PhoneNo;
        $_SESSION['Address'] = $Address;
        echo "<script>alert('Registration Successfully!');
        window.location.href='../$redirect'</script>";
      }
      else {
        echo "<script>alert('Error ');</script>";
      }
    }
  }
}
?>