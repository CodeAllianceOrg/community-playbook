<?php

/*
 *	process.php
 *
 *	script for calling MySQL database with HTTP POST to add 
 *	data to database
 *
 *	@author: S. West
 *	@date: April 2016
 *	@license: cc-by-nc-sa 2.0
 */
 
//attempt an SQL connection
//you would normally fill in the mysqli_connect parameters with your hostname, username, password, and database
$connect=mysqli_connect('localhost','root','','employees1');

//exit if we cannot connect 
if($connect === false)
{
	die("Failed to connect" . mysqli_connect_error());
}

// create a variable and escape user inputs for security (prevent SQL injection attacks, etc.)
$first_name=mysqli_real_escape_string($connect, $_POST['first_name']);
$last_name=mysqli_real_escape_string($connect, $_POST['last_name']);
$department=mysqli_real_escape_string($connect, $_POST['department']);
$email=mysqli_real_escape_string($connect, $_POST['email']);

//string to use when making the sql call  
$sql_call = "INSERT INTO employees1 (first_name,last_name,department,email) VALUES ('$first_name','$last_name','$department','$email')";
 
//Attempt to execute the query 
if (mysqli_query($connect,$sql_call)){
	//if we were able to add the record to the table
	if(mysqli_affected_rows($connect) > 0){
		echo "<p>Employee Added</p>";
		echo '<a href="index.php">Go Back</a>';
	} else {
		echo "Employee NOT Added<br />";
		echo mysqli_error ($connect);
	}
}
else{
	echo "ERROR: Could not execute $sql_call" . mysqli_error($connect);
}
				
//close the connection when we are done
mysqli_close($connect);

?>