<?php
	include 'config.php';
	
	//@authors: Kimberly Jimenez and Matthew Lupino
	$link = mysqli_connect($serverName, $serverUser, $serverPass, $dbName);

	//if link is not established...
	if(!$link){
		echo 'not connected to server';
	}

	//if a database is not selected...
	if(!mysqli_select_db($link, 'office-hours')){
		echo 'Database not selected';
	}
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$checkUser = mysqli_query($link, "select Users.username from Users where Users.username = '$username'");
	$checkRows = mysqli_num_rows($checkUser);
	
	if($checkRows > 0){
		//$checkIfExists = mysqli_fetch_assoc($checkUser);
		
		$checkPassword = mysqli_query($link, "select Users.password from Users where Users.password = '$password'");
		$checkRows = mysqli_num_rows($checkPassword);
		
		if($checkRows >0){
					echo nl2br("You have successfully logged in \n");
		
		echo nl2br('<a href="deleteInfo.php" class="page-scroll">Delete Certain Hours or Delete Professor </a>');			// link will take user to delete page
			
		}
		
	
	}
	
?>