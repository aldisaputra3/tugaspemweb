<?php
$servername = "localhost";
$username = "u107095992_tugas";
$password = "!pMumYh$W1";
$dbname = "u107095992_pemweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
