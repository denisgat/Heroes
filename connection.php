
<?php
$servername = "localhost";
$username = "denisgat";
$password = "12345678";
$dbname = "heroes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

// echo 'succesfully connected'
?>


