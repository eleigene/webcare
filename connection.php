<?php
// Check if running on XAMPP or Hostinger
if (strpos($_SERVER['DOCUMENT_ROOT'], 'xampp') !== false) {
	// XAMPP (local) environment settings
	$host = "localhost";
	$username = "root";
	$password = ""; // Typically, no password for XAMPP by default
	$database = "webcaredb"; // Local database name
} else {
	// Hostinger (live server) environment settings
	$host = "localhost"; // Usually 'localhost' on Hostinger
	$username = "u671054248_webcaredb"; // Hostinger database username
	$password = "7v92H5WoKG"; // Hostinger database password
	$database = "u671054248_webcaredb"; // Hostinger database name
}

// Create a connection
$con = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$con) {
	die("Connection failed: " . mysqli_connect_error());
}
