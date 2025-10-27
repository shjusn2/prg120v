<?php
// setup_tables.php
echo "<h2>Oppretter tabeller...</h2>";

$host = "b-studentsql-1.usn.no";
$user = "108381";
$pass = "DITT_PASSORD_HER";
$db   = "108381";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("<p style='color:red;'>❌ Kunne ikke koble til databasen: " . mysqli_connect_error() . "</p>");
}

// SQL for tabellene
$sqls = [
    "CREATE TABLE IF NOT EXISTS klasse (
        klassekode CHAR(5) NOT NULL,
        klassenavn VARCHAR(50) NOT NULL,
        studiumkode VARCHAR(50) NOT NULL,
        PRIMARY KEY (klassekode)
    )",
    "CREATE TABLE IF NOT EXISTS student (
        brukernavn CHAR(7) NOT NULL,
        fornavn VARCHAR(50) NOT NULL,
        etternavn VARCHAR(50) NOT NULL,
        klassekode CHAR(5) NOT NULL,
        PRIMARY KEY (brukernavn),
        FOREIGN KEY (klassekode) REFERENCES klasse(klassekode)
    )"
];

foreach ($sqls as $sql) {
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>✅ Tabell opprettet eller finnes allerede.</p>";
    } else {
        echo "<p style='color:red;'>❌ Feil ved oppretting: " . mysqli_error($conn) . "</p>";
    }
}

mysqli_close($conn);
echo "<p style='color:blue;'>Ferdig! Du kan nå slette denne fila eller la den ligge som test.</p>";
?>
