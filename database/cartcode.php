<?php
session_start();
require 'connection.php';
if(isset($_GET["action"]))
{
if($_GET["action"] == "delete")
{
foreach($_SESSION["cart"] as $keys => $values)
{
if($values["food_id"] == $_GET["id"])
{
unset($_SESSION["cart"][$keys]);
echo '<script>alert("Food has been removed")</script>';
echo '<script>window.location="../cart.php"</script>';
}
}
}
}


if(isset($_GET["action"]))
{
if($_GET["action"] == "empty")
{
foreach($_SESSION["cart"] as $keys => $values)
{
unset($_SESSION["cart"]);
echo '<script>alert("Cart is made empty!")</script>';
echo '<script>window.location="../cart.php"</script>';
}
}
}

?>



