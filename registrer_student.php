<?php
include "db.php";
$melding = ""; // for meldinger om hva som skjer

// Når skjema sendes inn
if (isset($_POST['lagre'])) {
    $bruker = $_POST['brukernavn'];
    $fornavn = $_POST['fornavn'];
    $etternavn = $_POST['etternavn'];
    $klassekode = $_POST['klassekode'];

    // sjekk om brukernavn finnes fra før
    $sjekk = mysqli_query($conn, "SELECT * FROM student WHERE brukernavn='$bruker'");
    if (mysqli_num_rows($sjekk) > 0) {
        $melding = " Brukernavn finnes fra før.";
    } else {
        $sql = "INSERT INTO student (brukernavn, fornavn, etternavn, klassekode)
                VALUES ('$bruker', '$fornavn', '$etternavn', '$klassekode')";
        if (mysqli_query($conn, $sql)) {
            $melding = " Student registrert.";
        } else {
            $melding = " Feil: " . mysqli_error($conn);
        }
    }
}

// hent klasseliste til dropdown
$klasseresultat = mysqli_query($conn, "SELECT klassekode, klassenavn FROM klasse ORDER BY klassekode");
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Registrer student</title></head>
<body>
    <h2>Registrer student</h2>

    <?php if ($melding !== "") echo "<p>$melding</p>"; ?>

    <form method="post">
        Brukernavn: <input type="text" name="brukernavn" required><br>
        Fornavn: <input type="text" name="fornavn" required><br>
        Etternavn: <input type="text" name="etternavn" required><br>

        Klasse:
        <select name="klassekode" required>
            <option value="">Velg klasse</option>
            <?php
            // bygger listen 
            while ($rad = mysqli_fetch_assoc($klasseresultat)) {
                $kode = $rad['klassekode'];
                $navn = $rad['klassenavn'];
                echo "<option value='$kode'>$kode – $navn</option>";
            }
            ?>
        </select>
        <br>

        <input type="submit" name="lagre" value="Lagre">
    </form>

    <p><a href="index.php">Tilbake til meny</a></p>
</body>
</html>
