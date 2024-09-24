

<?php

function connectDB(){
	$dbConnection = mysqli_connect("localhost", "gabonsondeuser", "gabonsondemdp", "gabonsondedb");
	if (mysqli_connect_errno()){
		die(mysqli_connect_error());
	}

	//BEWARE: Putting an echo in this code will break the bar graph.

	return $dbConnection;
}


?>
