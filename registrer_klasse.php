<?php
include "db.php";
$melding = ""; // for meldinger om hva som skjer

if (isset($_POST['lagre'])) {
    $kode = $_POST['kode'];
    $navn = $_POST['navn'];
    $studium = $_POST['studium'];

    // sjekk om klassekode finnes fra før
    $sjekk = mysqli_query($conn, "SELECT * FROM klasse WHERE klassekode='$kode'");
    if (mysqli_num_rows($sjekk) > 0) {
        $melding = " Klassekode finnes fra før.";
    } else {
        $sql = "INSERT INTO klasse (klassekode, klassenavn, studiumkode)
                VALUES ('$kode', '$navn', '$studium')";
        if (mysqli_query($conn, $sql)) {
            $melding = " Klasse registrert.";
        } else {
            $melding = " Feil: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Registrer klasse</title></head>
<body>
    <h2>Registrer klasse</h2>

    <?php if ($melding !== "") echo "<p>$melding</p>"; ?>

    <form method="post">
        Klassekode: <input type="text" name="kode" required><br>
        Klassenavn: <input type="text" name="navn" required><br>
        Studiumkode: <input type="text" name="studium" required><br>
        <input type="submit" name="lagre" value="Lagre">
    </form>

    <p><a href="index.php">Tilbake til meny</a></p>
</body>
</html>