<?php    
    include "connection.php";
    include "pdo.php";
    session_start();
    if(isset($_POST['Pay'])) {
     $id = '-';
     $order_id = $_POST['order_id'];
     $Email = $_POST['Email'];
     $Name = $_POST['Name'];
     $Address = $_POST['Address'];
     $PhoneNo = $_POST['PhoneNo'];
     $Card=$_POST['Card'];
     $price=$_POST['price'];
     $Month=$_POST['Month'];
     $Year=$_POST['Year'];
     $CCV=$_POST['CCV'];
    if($Card != "" && $Month != "" && $Year != "" && $CCV != ""){
        $sql=" insert into payment(id,order_id,Email,Name,PhoneNo,Address,Card,price,Month,Year,CCV) values('$id','$order_id', '$Email', '$Name', '$PhoneNo', '$Address', '$Card','$price','$Month','$Year','$CCV')";
        $result=$conn->query($sql);
        echo "<script>alert('Thank you for Ordering at FoodTiger! The ordering process is now complete.');  window.location.assign('../receiptCard.php');</script>";
 
    }
    }else{
    echo "<script>alert('Warning! The ordering process is not complete.');  window.location.assign('../payCredit.php');</script>";
    }