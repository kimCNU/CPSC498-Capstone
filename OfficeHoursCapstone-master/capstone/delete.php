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

	$email = $_POST['email'];
	
	$semester=$_POST['semester'];
	$year=$_POST['year'];

	
	// if admin inputs semester and year
	if($semester != null && $year != null){
		// to properly format the semester into aa-##
		if(strcasecmp(strtolower($semester), strtolower("spring")) == 0){
			$semester = "SP-".$year;
		}
	
		else if(strcasecmp(strtolower($semester), strtolower("fall")) == 0){
			$semester = "FA-".$year;
		}
	
		else if(strcasecmp(strtolower($semester), strtolower("sp")) == 0){
			$semester = "SP-".$year;
		}
	
		else if(strcasecmp(strtolower($semester), strtolower("fa")) == 0){
			$semester = "FA-".$year;
		}
	
	
		// checks to see if there's any entry in the database that matches the email that was just submitted
		$checkEmail = mysqli_query($link, "select Prof_ID from Professor where email = '$email'");
		// returns the number of rows that matches the last query that was run
		$checkRows = mysqli_num_rows($checkEmail);
	
		// if said professor exists then...
		if($checkRows > 0){
			$checkIfExists = mysqli_fetch_assoc($checkEmail);
			$check = $checkIfExists["Prof_ID"];
			// selects the Office Hours entries that match the associated Prof_ID
			$checkID = mysqli_query($link, "select OfficeHour.Prof_ID from OfficeHour 
										   where '$check' = OfficeHour.Prof_ID
										   and OfficeHour.Semester= '$semester'");
			// returns the number of rows that match the associated Prof_ID						
			$checkRows = mysqli_num_rows($checkID);
		
			if($checkRows > 0){
				// delete from OfficeHour where the Prof_ID and Semester match
				$deleteOH = mysqli_query($link, "delete from OfficeHour where '$check' = OfficeHour.Prof_ID and '$semester' = OfficeHour.Semester");
				$result = mysqli_query($link, $deleteOH);

				print("Record(s) from selected semester deleted.");
				echo nl2br('<a href="deleteInfo.php" class="page-scroll"> Delete Certain Hours or Delete Professor</a>');			// link will take user to delete page
				echo nl2br('<a href="index.html#header" class="page-scroll">Home</a>');			// link will take user to home page
			}
		}
	}

	// else if admin only enters in an email...
	else{
		// checks to see if there is an entry in Professor table with email entered
		$checkEmail = mysqli_query($link, "select Prof_ID from Professor where email = '$email'");
		// return number of ros that matches the last query
		$checkRows = mysqli_num_rows($checkEmail);
		
		// if said Professor exists then...
		if($checkRows > 0){
			$checkIfExists = mysqli_fetch_assoc($checkEmail);
			$check = $checkIfExists["Prof_ID"];
				
				// now delete from Professor table
				$deleteProf = mysqli_query($link, "delete from Professor where '$email' = Professor.email ");
				$result = mysqli_query($link, $deleteProf);
				
				print ("All entries that involve '$email' have been deleted from both OfficeHour and Professor");
				echo nl2br('<a href="deleteInfo.php" class="page-scroll"> Delete Certain Hours or Delete Professor</a>');			// link will take user to delete page
				echo nl2br('<a href="index.html#header" class="page-scroll"> Home </a>');			// link will take user to home page
				
			//}
		}

	}
	
?>