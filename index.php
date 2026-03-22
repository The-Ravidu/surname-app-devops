<?php
include "conn.php";

$message = "";
$list = "";
$stats = "";

/* ADD SURNAME */
if (isset($_POST['add'])) {
    $surname = trim($_POST['surname']);

    if ($surname != "") {
        mysqli_query($conn,
            "INSERT INTO people (surname) VALUES ('$surname')"
        );
    }
}

/* SHOW WOMEN */
if (isset($_POST['women'])) {
    $result = mysqli_query($conn, "SELECT surname FROM people");

    while ($row = mysqli_fetch_assoc($result)) {
        $s = strtolower($row['surname']);

        if (
            str_ends_with($s, "yte") ||
            str_ends_with($s, "aite") ||
            str_ends_with($s, "iene")
        ) {
            $list .= $row['surname'] . "<br>";
        }
    }
}

/* SHOW STATISTICS */
if (isset($_POST['stats'])) {
    $women = 0;
    $men = 0;

    $result = mysqli_query($conn, "SELECT surname FROM people");

    while ($row = mysqli_fetch_assoc($result)) {
        $s = strtolower($row['surname']);

        if (
            str_ends_with($s, "yte") ||
            str_ends_with($s, "aite") ||
            str_ends_with($s, "iene")
        ) {
            $women++;
        } else {
            $men++;
        }
    }

    $stats = "Women: $women <br> Men: $men";
}
?>

<h2>Surname App</h2>

<form method="POST">
    <label>Surname:</label><br>
    <input name="surname"><br><br>

    <button name="add">Add</button>
    <button name="women">Women</button>
    <button name="stats">Statistics</button>
</form>

<hr>

<h3>Result</h3>
<?= $list ?>
<?= $stats ?>
