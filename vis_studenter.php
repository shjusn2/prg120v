<?php
include "db.php";
$sql = "SELECT s.brukernavn, s.fornavn, s.etternavn, s.klassekode, k.klassenavn
        FROM student s
        JOIN klasse k ON s.klassekode = k.klassekode
        ORDER BY s.brukernavn";
$resultat = mysqli_query($conn, $sql);
$melding = ""; // for meldinger om hva som skjer
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Alle studenter</title></head>
<body>
    <h2>Alle studenter</h2>

    <table border="1" cellpadding="4">
        <tr>
            <th>Brukernavn</th>
            <th>Fornavn</th>
            <th>Etternavn</th>
            <th>Klassekode</th>
            <th>Klassenavn</th>
        </tr>

        <?php
        while ($rad = mysqli_fetch_assoc($resultat)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($rad['brukernavn']) . "</td>";
            echo "<td>" . htmlspecialchars($rad['fornavn']) . "</td>";
            echo "<td>" . htmlspecialchars($rad['etternavn']) . "</td>";
            echo "<td>" . htmlspecialchars($rad['klassekode']) . "</td>";
            echo "<td>" . htmlspecialchars($rad['klassenavn']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <p><a href="index.php">Tilbake til meny</a></p>
</body>
</html>
