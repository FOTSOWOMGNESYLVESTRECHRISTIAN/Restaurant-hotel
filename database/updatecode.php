<?php  
include "connection.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['update'])){
    $Name=$_POST['Name'];
    $Email=$_POST['Email'];
    $PhoneNo=$_POST['PhoneNo'];
    $Address=$_POST['Address'];
    $Password = $_POST['Password'];
    $Password = password_hash("$Password" , PASSWORD_DEFAULT);
 
    $sql="update customer set Name='$Name',PhoneNo='$PhoneNo',Address='$Address',Password='$Password' where Email='$Email'";
	$result=$conn->query($sql);
    echo "<script>alert('Congratulations,Update Succesful!!!');window.location.assign('../userprofile.php');</script>";
}
?>