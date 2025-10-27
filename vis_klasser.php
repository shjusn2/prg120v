<?php
include "db.php";
$melding = ""; // for meldinger om hva som skjer
$resultat = mysqli_query($conn, "SELECT * FROM klasse ORDER BY klassekode");
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Alle klasser</title></head>
<body>
    <h2>Alle klasser</h2>

    <table border="1" cellpadding="4">
        <tr>
            <th>Klassekode</th>
            <th>Klassenavn</th>
            <th>Studiumkode</th>
        </tr>

        <?php
        while ($rad = mysqli_fetch_assoc($resultat)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($rad['klassekode']) . "</td>";
            echo "<td>" . htmlspecialchars($rad['klassenavn']) . "</td>";
            echo "<td>" . htmlspecialchars($rad['studiumkode']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <p><a href="index.php">Tilbake til meny</a></p>
</body>
</html>
