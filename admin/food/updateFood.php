<?php
 include "../../database/connection.php";
 include "../../database/pdo.php";
 if(isset($_POST['update'])){
    $f_id=$_POST['f_id'];
    $cart_id=$_POST['cart_id'];
    $nameFood=$_POST['nameFood'];
    $description=$_POST['description'];
    $image=$_POST['imageFood'];
    $price=$_POST['price'];

  $sql="update food set cart_id='$cart_id',nameFood='$nameFood',description='$description',imageFood='$image',price='$price' where f_id='$f_id'";
	$result=$conn->query($sql);
 	echo "<script>alert('Congratulations,Update Succesful!!!');window.location.assign('food.php');</script>";
}