<?php
// Enkel test for databasekobling i Dokploy
echo "<h2>Tester databasekobling...</h2>";

// Fyll inn detaljene fra Dokploy-panelet
$host = "b-studentsql-1.usn.no";         // vanlige Dokploy-installasjoner bruker "mysql"
$user = "108381";       // erstatt med ditt brukernavn (f.eks. "sondrej")
$pass = "3e49108381";   // erstatt med passordet Dokploy viser
$db   = "108381";       // ofte samme som brukernavn

$conn = mysqli_connect($host, $user, $pass, $db);

// Sjekk om tilkoblingen fungerer
if (!$conn) {
    die("<p style='color:red;'>❌ Kunne ikke koble til databasen:<br>" . mysqli_connect_error() . "</p>");
} else {
    echo "<p style='color:green;'>✅ Koblet til databasen!</p>";
}

// Test en enkel spørring
$query = "SHOW TABLES";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<h3>Tabeller funnet i databasen:</h3>";
    echo "<ul>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<li>" . htmlspecialchars($row[0]) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p style='color:orange;'>⚠️ Ingen tabeller funnet ennå. Det er normalt hvis du ikke har kjørt CREATE TABLE enda.</p>";
}

mysqli_close($conn);
?>
