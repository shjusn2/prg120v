<?php
$host = "b-studentsql-1.usn.no";
$user = "108381";
$pass = "3e49108381";
$db   = "108381";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Feil: klarte ikke å koble til databasen.");
}

?>