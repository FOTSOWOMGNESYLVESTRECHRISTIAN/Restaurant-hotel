<?php

session_start();
try {

    if (!file_exists('../../database/pdo.php' ))
        throw new Exception();
    else
        require_once('../../database/pdo.php' ); 
		
} catch (Exception $e) {

	$_SESSION['msg'] = 'There were some problem in the Server! Try after some time!';

	header('location: category.php');

	exit();
	
}

if (!isset($_REQUEST['c_id'])) {

	$_SESSION['msg'] = 'Invalid ID!';

	header('location: category.php');

	exit();
} 

	$c_id = $_REQUEST['c_id'];


	$sql = "DELETE FROM category WHERE c_id = ?";
    $query  = $pdoconn->prepare($sql);
    if ($query->execute([$c_id])) {

    	$_SESSION['msg'] = 'Category Deleted!';

		header('location: category.php');
    	
    } else {

    	$_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';

		header('location: category.php');

    }

