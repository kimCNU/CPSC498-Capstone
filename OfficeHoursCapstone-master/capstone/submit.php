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
	
	$prefix = $_POST['Prefix'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$location = $_POST['OfficeBuilding'];
	$number = $_POST['OfficeNumber'];
	
	$semester=$_POST['semester'];
	$year=$_POST['year'];

	$dayOfWeek = $_POST['dayOfWeek1'];
	$oHStart = $_POST['dowStart1'];
	$oHEnd = $_POST['dowEnd1'];
	

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
	
	else{
		
		echo nl2br("Only Fall or Spring Semesters allowed \n");
		echo nl2br("Just click on the link if you want to try again \n");
		exit('<a href="form.php#about" class="page-scroll">Start Form</a>');		// link will take user back to form
		
	}
	
	// checks to see if there's any entry in the database that matches the email that was just submitted
	$checkEmail = mysqli_query($link, "select Prof_ID from Professor where email = '$email'");
	$checkRows = mysqli_num_rows($checkEmail);
	
	// if said professor exists then...
	if($checkRows > 0){
		$checkIfExists = mysqli_fetch_assoc($checkEmail);
		$check=$checkIfExists["Prof_ID"];
		$checkID= mysqli_query($link, "select OfficeHour.Prof_ID from OfficeHour 
								where '$check' = OfficeHour.Prof_ID
								and OfficeHour.Semester= '$semester'");
								
		$checkRows = mysqli_num_rows($checkID);
		
		if($checkRows > 0){
			echo nl2br("You have already added your information into the database \n");
		}
		
		else{

				if($dayOfWeek != null){
					$findLastID = "SELECT Prof_ID from Professor where Professor.Prof_ID = '$check'";
					$getVal = mysqli_query($link, $findLastID);
					$row = mysqli_fetch_row($getVal);
					$getLastVal = $row[0];
				
					$sql = "INSERT INTO OfficeHour (dayOfWeek, OfficeHourStart, OfficeHourEnd, Semester, Prof_ID ) values ('$dayOfWeek','$oHStart', '$oHEnd', '$semester' ,'$check')";
					$result = mysqli_query($link, $sql);
					$message = $message."\n".$dayOfWeek.$oHStart.$oHEnd."\n";
					
				}
			
				$dayOfWeek = $_POST['dayOfWeek2'];
				$oHStart = $_POST['dowStart2'];
				$oHEnd = $_POST['dowEnd2'];
				
				if($dayOfWeek != null){
					$findLastID = "SELECT Prof_ID from Professor where Professor.Prof_ID = '$check'";
					$getVal = mysqli_query($link, $findLastID);
					$row = mysqli_fetch_row($getVal);
					$getLastVal = $row[0];
					$sql = "INSERT INTO OfficeHour (dayOfWeek, OfficeHourStart, OfficeHourEnd, Semester, Prof_ID ) values ('$dayOfWeek','$oHStart', '$oHEnd','$semester','$check')";
					$result = mysqli_query($link, $sql);
				
				}
		
				$dayOfWeek = $_POST['dayOfWeek3'];
				$oHStart = $_POST['dowStart3'];
				$oHEnd = $_POST['dowEnd3'];
				
				if($dayOfWeek != null){
					$findLastID = "SELECT Prof_ID from Professor where Professor.Prof_ID = '$check'";
					$getVal = mysqli_query($link, $findLastID);
					$row = mysqli_fetch_row($getVal);
					$getLastVal = $row[0];
					$sql = "INSERT INTO OfficeHour (dayOfWeek, OfficeHourStart, OfficeHourEnd, Semester, Prof_ID ) values ('$dayOfWeek','$oHStart', '$oHEnd','$semester','$check')";
					$result = mysqli_query($link, $sql);
				
				}
		
				$dayOfWeek = $_POST['dayOfWeek4'];
				$oHStart = $_POST['dowStart4'];
				$oHEnd = $_POST['dowEnd4'];
					
				if($dayOfWeek != null){
					$findLastID = "SELECT Prof_ID from Professor where Professor.Prof_ID = '$check'";
					$getVal = mysqli_query($link, $findLastID);
					$row = mysqli_fetch_row($getVal);
					$getLastVal = $row[0];
					$sql = "INSERT INTO OfficeHour (dayOfWeek, OfficeHourStart, OfficeHourEnd, Semester, Prof_ID ) values ('$dayOfWeek','$oHStart', '$oHEnd','$semester','$check')";
					$result = mysqli_query($link, $sql);
				
				}
		
				$dayOfWeek = $_POST['dayOfWeek5'];
				$oHStart = $_POST['dowStart5'];
				$oHEnd = $_POST['dowEnd5'];
				
				if($dayOfWeek != null){
					$findLastID = "SELECT Prof_ID from Professor where Professor.Prof_ID = '$check'";
					$getVal = mysqli_query($link, $findLastID);
					$row = mysqli_fetch_row($getVal);
					$getLastVal = $row[0];
					$sql = "INSERT INTO OfficeHour (dayOfWeek, OfficeHourStart, OfficeHourEnd, Semester, Prof_ID ) values ('$dayOfWeek','$oHStart', '$oHEnd','$semester','$check')";
					$result = mysqli_query($link, $sql);
				
				}	
		
			echo nl2br("You have been added to the database \n");
		
			echo('<a href="index.html#header" class="page-scroll">Home</a>');			// link will take user back to home page
			
		}
		
	}
	else{

		$sql = "INSERT IGNORE INTO Professor(Prefix, FirstName, LastName, OfficeBuilding, OfficeNumber, email) values ('$prefix', '$firstName', '$lastName', '$location', '$number','$email')";
		$result = mysqli_query($link, $sql);
		
		
		if($dayOfWeek != null){
			$findLastID = "SELECT MAX(Prof_ID) from Professor";
			$getVal = mysqli_query($link, $findLastID);
			$row = mysqli_fetch_row($getVal);
			$getLastVal = $row[0];
		
			$sql = "INSERT INTO OfficeHour (dayOfWeek, OfficeHourStart, OfficeHourEnd, Semester, Prof_ID ) values ('$dayOfWeek','$oHStart', '$oHEnd', '$semester' ,'$getLastVal')";
			$result = mysqli_query($link, $sql);
		
		}
			
		$dayOfWeek = $_POST['dayOfWeek2'];
		$oHStart = $_POST['dowStart2'];
		$oHEnd = $_POST['dowEnd2'];
				
		if($dayOfWeek != null){
			$findLastID = "SELECT MAX(Prof_ID) from Professor";
			$getVal = mysqli_query($link, $findLastID);
			$row = mysqli_fetch_row($getVal);
			$getLastVal = $row[0];
			$sql = "INSERT INTO OfficeHour (dayOfWeek, OfficeHourStart, OfficeHourEnd, Semester, Prof_ID ) values ('$dayOfWeek','$oHStart', '$oHEnd','$semester','$getLastVal')";
			$result = mysqli_query($link, $sql);
				
		}
		
		$dayOfWeek = $_POST['dayOfWeek3'];
		$oHStart = $_POST['dowStart3'];
		$oHEnd = $_POST['dowEnd3'];
				
		if($dayOfWeek != null){
			$findLastID = "SELECT MAX(Prof_ID) from Professor";
			$getVal = mysqli_query($link, $findLastID);
			$row = mysqli_fetch_row($getVal);
			$getLastVal = $row[0];
			$sql = "INSERT INTO OfficeHour (dayOfWeek, OfficeHourStart, OfficeHourEnd, Semester, Prof_ID ) values ('$dayOfWeek','$oHStart', '$oHEnd','$semester','$getLastVal')";
			$result = mysqli_query($link, $sql);
				
		}
		
		$dayOfWeek = $_POST['dayOfWeek4'];
		$oHStart = $_POST['dowStart4'];
		$oHEnd = $_POST['dowEnd4'];
				
		if($dayOfWeek != null){
			$findLastID = "SELECT MAX(Prof_ID) from Professor";
			$getVal = mysqli_query($link, $findLastID);
			$row = mysqli_fetch_row($getVal);
			$getLastVal = $row[0];
			$sql = "INSERT INTO OfficeHour (dayOfWeek, OfficeHourStart, OfficeHourEnd, Semester, Prof_ID ) values ('$dayOfWeek','$oHStart', '$oHEnd','$semester','$getLastVal')";
			$result = mysqli_query($link, $sql);
			
		}
		
		$dayOfWeek = $_POST['dayOfWeek5'];
		$oHStart = $_POST['dowStart5'];
		$oHEnd = $_POST['dowEnd5'];
				
		if($dayOfWeek != null){
			$findLastID = "SELECT MAX(Prof_ID) from Professor";
			$getVal = mysqli_query($link, $findLastID);
			$row = mysqli_fetch_row($getVal);
			$getLastVal = $row[0];
			$sql = "INSERT INTO OfficeHour (dayOfWeek, OfficeHourStart, OfficeHourEnd, Semester, Prof_ID ) values ('$dayOfWeek','$oHStart', '$oHEnd','$semester','$getLastVal')";
			$result = mysqli_query($link, $sql);
				
		}		
		echo nl2br("You have been added to the database \n");
		
		echo('<a href="index.html#header" class="page-scroll">Home</a>');			// link will take user back to home page
	}

?>
