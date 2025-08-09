<?php
 include "../../database/connection.php";
 include "../../database/pdo.php";

 if(isset($_POST['insert'])) {
    $cart_id = $_POST['cart_id'];
    $nameFood = $_POST['nameFood'];
    $description = $_POST['description'];
    $image=$_POST['imageFood'];
    $price=$_POST['price'];


	$sql = "INSERT into food(f_id,cart_id,nameFood,description,imageFood,price)values('','$cart_id', '$nameFood', '$description', '$image','$price')";
  $query = mysqli_query($conn,$sql );
	echo "<script>alert('Congratulations,Insert Succesful!!!'); window.location.assign('food.php');</script>";
    	
    } else {
		echo "<script>alert('Invalid !'); window.location.assign('FoodList.php');</script>";
    }

    
