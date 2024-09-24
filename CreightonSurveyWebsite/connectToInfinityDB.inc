
<!--connectToInfinityDB.inc-->
<!--Script to connect to MYSQL database on the InfinityFree website-->
<!--Made by Ryan King and Dr.Samer-->
<!--November 19, 2020-->

<?php

function connectDB(){
	//$dbConnection = mysqli_connect("localhost", "gabonsondeuser", "gabonsondemdp", "gabonsondedb");
        $dbConnection = new mysqli("localhost", "gabonsondeuser", "gabonsondemdp", "gabonsondedb");
	if (mysqli_connect_errno()){
		die(mysqli_connect_error());
	}

	//BEWARE: Putting an echo in this code will break the bar graph.

	return $dbConnection;
}


?>
