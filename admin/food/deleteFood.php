<?php

session_start();
try {

    if (!file_exists('../../database/pdo.php' ))
        throw new Exception();
    else
        require_once('../../database/pdo.php' ); 
		
} catch (Exception $e) {

	$_SESSION['msg'] = 'There were some problem in the Server! Try after some time!';

	header('location: food.php');

	exit();
	
}

if (!isset($_REQUEST['f_id'])) {

	$_SESSION['msg'] = 'Invalid ID!';

	header('location: food.php');

	exit();
} 

	$f_id = $_REQUEST['f_id'];


	$sql = "DELETE FROM food WHERE f_id = ?";
    $query  = $pdoconn->prepare($sql);
    if ($query->execute([$f_id])) {

    	$_SESSION['msg'] = 'Category Deleted!';

		header('location: food.php');
    	
    } else {

    	$_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';

		header('location: food.php');

    }

