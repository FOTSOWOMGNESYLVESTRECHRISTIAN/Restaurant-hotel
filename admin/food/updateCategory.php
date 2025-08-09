<?php
 include "../../database/connection.php";
 include "../../database/pdo.php";
 if(isset($_POST['update'])){
    $c_id=$_POST['c_id'];
    $name=$_POST['name'];
    $description=$_POST['description'];
    $image=$_POST['image'];
    $category_exixts=$_POST['category_exixts'];

  $sql="update category set name='$name',description='$description',image='$image',category_exixts='$category_exixts' where c_id='$c_id'";
	$result=$conn->query($sql);
 	echo "<script>alert('Congratulations,Update Succesful!!!');window.location.assign('category.php');</script>";
}