<?php 
	//@author: Matthew Lupino
	//Creating a connection
	include 'config.php';
	
	$link = mysqli_connect($serverName, $serverUser, $serverPass, $dbName);
	 
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	/*Get the id of the last visible item in the RecyclerView from the request and store it in a variable. For            the first request id will be zero.*/	
	
	$sql= "Select * from Professor";
	
	$result = mysqli_query($link ,$sql);
	
	while ($row = mysqli_fetch_assoc($result)) {
		
		$array[] = $row;
		
	}
	header('Content-Type:Application/json');
	
	echo json_encode($array);

    mysqli_free_result($result);

    mysqli_close($link);
  
 ?>