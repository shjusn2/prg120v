<?php
include "db.php";
$melding = ""; // for meldinger om hva som skjer

// hvis vi har valgt sletting
if (isset($_POST['slett'])) {
    $bruker = $_POST['brukernavn'];

    $sql = "DELETE FROM student WHERE brukernavn='$bruker'";
    if (mysqli_query($conn, $sql)) {
        $melding = " Student '$bruker' er slettet.";
    } else {
        $melding = " Feil ved sletting: " . mysqli_error($conn);
    }
}

// hent studenter til dropdown
$studenter = mysqli_query($conn, "SELECT brukernavn, fornavn, etternavn FROM student ORDER BY brukernavn");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Slett student</title>
    <script>
        function bekreft() {
            return confirm("vil du virkelig slette denne studenten?");
        }
    </script>
</head>
<body>
    <h2>Slett student</h2>

    <?php if ($melding !== "") echo "<p>$melding</p>"; ?>

    <form method="post" onsubmit="return bekreft();">
        Velg student:
        <select name="brukernavn" required>
            <option value="">Velg student</option>
            <?php
            while ($rad = mysqli_fetch_assoc($studenter)) {
                $b = $rad['brukernavn'];
                $f = $rad['fornavn'];
                $e = $rad['etternavn'];
                echo "<option value='$b'>$b – $f $e</option>";
            }
            ?>
        </select>

        <input type="submit" name="slett" value="Slett">
    </form>

    <p><a href="index.php">Tilbake til meny</a></p>
</body>
</html>
