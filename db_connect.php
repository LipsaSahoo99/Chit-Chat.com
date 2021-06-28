<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "chatroom1";

// Creating Database Connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if(!$conn)
{
	die("Failed to connect". mysqli_connect_error());
}


?>