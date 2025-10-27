<?php
include "db.php";
$melding = ""; // for meldinger om hva som skjer

// hvis forsøk på sletting
if (isset($_POST['slett'])) {
    $klassekode = $_POST['klassekode'];

    // sjekk om det finnes studenter i klassen
    $sjekk = mysqli_query($conn, "SELECT COUNT(*) AS antall FROM student WHERE klassekode='$klassekode'");
    $rad = mysqli_fetch_assoc($sjekk);
    $antall = $rad['antall'];

    if ($antall > 0) {
        $melding = " Kan ikke slette klassen '$klassekode' fordi det finnes studenter i den.";
    } else {
        // trygg å slette
        $sql = "DELETE FROM klasse WHERE klassekode='$klassekode'";
        if (mysqli_query($conn, $sql)) {
            $melding = " Klassen '$klassekode' er slettet.";
        } else {
            $melding = " Feil ved sletting: " . mysqli_error($conn);
        }
    }
}

// hent klasser til dropdown
$klasser = mysqli_query($conn, "SELECT klassekode, klassenavn FROM klasse ORDER BY klassekode");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Slett klasse</title>
    <script>
        function bekreft() {
            return confirm("Er du sikker på at du vil slette denne klassen?");
        }
    </script>
</head>
<body>
    <h2>Slett klasse</h2>

    <?php if ($melding !== "") echo "<p>$melding</p>"; ?>

    <form method="post" onsubmit="return bekreft();">
        Velg klasse:
        <select name="klassekode" required>
            <option value="">Velg klasse</option>
            <?php
            while ($rad = mysqli_fetch_assoc($klasser)) {
                $kode = $rad['klassekode'];
                $navn = $rad['klassenavn'];
                echo "<option value='$kode'>$kode – $navn</option>";
            }
            ?>
        </select>

        <input type="submit" name="slett" value="Slett">
    </form>

    <p><a href="index.php">Tilbake til meny</a></p>
</body>
</html>
