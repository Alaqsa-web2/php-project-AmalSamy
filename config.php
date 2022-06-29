<?php 
// Amal Samy Abo_Ouda
session_start();
	 $server = "localhost";
	 $user = "root";
	 $password = "";
	$database = "databace";
 
	$conn = mysqli_connect($server, $user, $password, $database);

	if (!$conn) {
		die("<script>alert('Connection Failed.')</script>");
	}
