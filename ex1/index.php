<?php
require_once("Etudiant.php");

$etudiants = array(
    new Etudiant("Ahmed", array(11, 12, 7)),
    new Etudiant("Saif", array(9, 9, 13)),
    new Etudiant("Zaineb", array(4, 12, 10)),
    new Etudiant("Youssef", array(10, 8, 9)),
);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exercice 1</title>
    <link rel="stylesheet" href="../common.css">
</head>
<body>
    <h2>Exercice 1</h2>
    <br>

    <div id="app">
<?php
    foreach ($etudiants as $etudiant) {
        echo "<div class='list-group'>";
        echo "<span class='list-group-item active bold'>" . $etudiant->getNom() . "</span>";
        foreach ($etudiant->getNotes() as $note) {
            if ($note < 10)
                $bg = "bg-red";
            else if ($note > 10)
                $bg = "bg-green";
            else
                $bg = "bg-orange";

            echo "<span class='list-group-item $bg'>$note</span>";
        }
        echo sprintf("<span class='list-group-item bold'>Moyenne: %0.2f</span>", $etudiant->getMoyenne());
        echo "<span class='list-group-item bold'>" . $etudiant->isAdmis() . "</span>";
        echo "</div>";
    }
?>
    </div>
</body>
</html>