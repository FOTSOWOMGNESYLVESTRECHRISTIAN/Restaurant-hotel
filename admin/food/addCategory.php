<?php
 include "../../database/connection.php";
 include "../../database/pdo.php";

 if(isset($_POST['insert'])) {
	
  	$name = $_POST['name'];
  	$description = $_POST['description'];
    $image=$_POST['image'];
    $category_exixts = $_POST['category_exixts'];

	$sql = "INSERT into category(c_id, name, description, image,category_exixts)values('', '$name', '$description', '$image', '$category_exixts')";
  $query = mysqli_query($conn,$sql );
	echo "<script>alert('Congratulations,Insert Succesful!!!'); window.location.assign('category.php');</script>";
    	
    } else {
		echo "<script>alert('Invalid !'); window.location.assign('CategoryList.php');</script>";
    }


