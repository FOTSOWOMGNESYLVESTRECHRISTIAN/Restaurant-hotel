<?php 
ob_start(); 
require 'connection.php';
session_start();
if($_POST){
$Email = $_SESSION['Email'];
$Name = $_SESSION['Name'];
$phone = $_SESSION['PhoneNo'];
$feedback = $_POST['feedback'];
$suggestions = $_POST['suggestions'];

$sql="INSERT INTO `feedback`(`id`, `Email`, `Name`, `phone`, `feedback`, `suggestions`) VALUES ('','$Email','$Name','$phone','$feedback','$suggestions')";
$query = mysqli_query($conn,$sql );
if($query)
{
    echo '<script>alert("Thank You..! Your Feedback is Valuable to Us");location.replace(document.referrer);</script>';
}
else
{
    echo '<script>alert("Something went wrong");</script>';
}

}

?>

